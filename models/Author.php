<?php

namespace app\models;

use app\components\SelectListTrait;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $user_id
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $last_login
 *
 * @property User $user
 */
class Author extends \yii\db\ActiveRecord
{
    use SelectListTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
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
            [['name'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'last_login'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['phone', 'email'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ism, familiyasi',
            'phone' => 'Phone',
            'email' => 'Email',
            'user_id' => 'Bog\'langan foydalanuvchi',
            'status' => 'Status',
            'created_at' => 'Yaratilgan vaqti',
            'updated_at' => 'Yangilangan vaqti',
            'created_by' => 'Kim yaratdi?',
            'updated_by' => 'Kim yangiladi?',
            'last_login' => 'Oxirgi kirgan vaqti',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
