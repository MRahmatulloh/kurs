<?php

namespace app\models;

use app\components\SelectListTrait;
use mdm\admin\models\form\ChangePassword;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $photo
 * @property string $phone
 * @property string $role
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $last_login_at
 *
 * @property Auth[] $auths
 * @property Book[] $books
 * @property Course[] $courses
 * @property Order[] $orders
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    use SelectListTrait;

    public $image;

    public const ROLES = [
        'pupil' => 'O\'quvchi',
        'teacher' => 'O\'qituvchi',
        'admin' => 'Administrator',
    ];
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'name', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'required'],
            [['status', 'created_at', 'updated_at', 'last_login_at'], 'integer'],
            ['email', 'email'],
            ['email', 'unique'],
            ['role', 'default', 'value' => 'pupil'],
            ['role', 'in', 'range' => ['pupil', 'teacher', 'admin']],
            ['status', 'in', 'range' => [User::STATUS_ACTIVE, User::STATUS_ACTIVE]],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'photo', 'phone', 'role'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'jpg, jpeg, png, bmp', 'maxFiles' => 1, 'maxSize' => 4 * 1024 * 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Foydalanuvchi',
            'name' => 'Ism, familiyasi',
            'photo' => 'Rasm',
            'phone' => 'Telefon',
            'role' => 'Rol',
            'username' => 'Login',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'last_login_at' => 'Oxirgi kirgan vaqti',
            'status' => 'Status',
            'created_at' => 'Yaratilgan vaqti',
            'updated_at' => 'Yangilangan vaqt',
        ];
    }

    /**
     * Gets query for [[Auths]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuths()
    {
        return $this->hasMany(Auth::class, ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => User::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return User|null
     */
    public static function findByUsername(string $username): ?User
    {
        return static::findOne(['username' => $username, 'status' => User::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return User|null
     */
    public static function findByEmail(string $email): ?User
    {
        return static::findOne(['email' => $email, 'status' => User::STATUS_ACTIVE]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function can($permission)
    {
        return Yii::$app->user->can($permission) || Yii::$app->user->can('admin');
    }

    public function isRoleUser($roleName)
    {
        return Yii::$app->authManager->checkAccess($this->getId(), $roleName);
    }

    public function getOrders()
    {
        return $this->hasMany(Order::class, ['user_id' => 'id']);
    }

    public function isPurchasedCourse()
    {

        if (Yii::$app->user->identity->isRoleUser('admin')) {
            return true;
        }

        return Order::find()->where(['wants_id' => '3ffb626c-07b2-4928-a5eb-4ee1e78c1f2c', 'user_id' => Yii::$app->user->identity->id, 'status' => Order::STATUS_APPROVED])->exists();
    }

    public function getPhotoFilePath()
    {
        return Yii::getAlias('@app') . '/web/img/users/' . $this->photo;
    }

}
