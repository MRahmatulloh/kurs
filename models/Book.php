<?php

namespace app\models;

use app\components\SelectListTrait;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string|null $uuid
 * @property string $name
 * @property string $filename
 * @property string $photo
 * @property string|null $description
 * @property int $author_id
 * @property double $price
 * @property int|null $status
 *
 * @property Author $author
 */
class Book extends \yii\db\ActiveRecord
{
    use SelectListTrait;

    public $file;
    public $image;

    public $filePath;
    public $photoPath;

    public function __construct($config = [])
    {
        $this->filePath = Yii::getAlias('@app') . '/files/books/';
        $this->photoPath = Yii::getAlias('@app') . '/web/img/books/';
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['author_id', 'status'], 'integer'],
            [['uuid', 'name', 'filename', 'photo'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
            [['image'], 'file', 'extensions' => 'jpg, jpeg, png, bmp', 'maxFiles' => 1, 'maxSize' => 4 * 1024 * 1024],
            [['file'], 'file', 'extensions' => 'pdf, doc, docx', 'maxFiles' => 1, 'maxSize' => 15 * 1024 * 1024],
            [['file'], 'required', 'on' => 'create'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => '№',
            'price' => 'Narxi',
            'name' => 'Nomi',
            'file' => 'Fayl',
            'filename' => 'Fayl',
            'image' => 'Rasm',
            'photo' => 'Rasm',
            'description' => 'Izoh',
            'author_id' => 'Muallif',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    public function getPhotoFilePath()
    {
        return $this->photoPath . $this->photo;
    }

    public function getFilePath()
    {
        return $this->filePath . $this->filename;
    }

    public function isPurchased()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }
        if (Yii::$app->user->identity->isRoleUser('admin')) {
            return true;
        }

        return Order::find()->where(['wants_id' => $this->uuid, 'user_id' => Yii::$app->user->identity->id, 'status' => Order::STATUS_APPROVED])->exists();
    }
}
