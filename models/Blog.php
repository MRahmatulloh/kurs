<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "blogs".
 *
 * @property int $id
 * @property string|null $uuid
 * @property string $title
 * @property string|null $text
 * @property string|null $photo
 * @property int|null $status
 */
class Blog extends \yii\db\ActiveRecord
{
    public $image;

    public $photoPath;

    public function __construct($config = [])
    {
        $this->photoPath = Yii::getAlias('@app') . '/web/img/blogs/';
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blogs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['status'], 'integer'],
            [['image'], 'file', 'extensions' => 'jpg, jpeg, png, bmp', 'maxFiles' => 1, 'maxSize' => 4 * 1024 * 1024],
            [['uuid', 'title', 'photo'], 'string', 'max' => 255],
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
            'title' => 'Sarlavha',
            'text' => 'Matn',
            'photo' => 'Rasm',
            'image' => 'Rasm',
            'status' => 'Status',
        ];
    }

    public function getPhotoFilePath()
    {
        return $this->photoPath . $this->photo;
    }
}
