<?php

namespace app\models;

use app\components\SelectListTrait;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "courses".
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $description
 * @property float|null $price
 * @property int $author_id
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Author $author
 * @property Module[] $modules
 */
class Course extends \yii\db\ActiveRecord
{
    use SelectListTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
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

    /**4
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uuid', 'name'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['author_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['uuid', 'name'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
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
            'name' => 'Nomi',
            'description' => 'Izoh',
            'price' => 'Narxi',
            'author_id' => 'Muallif',
            'status' => 'Status',
            'created_at' => 'Yaratilgan vaqti',
            'updated_at' => 'Yangilangan vaqti',
            'created_by' => 'Kim yaratdi?',
            'updated_by' => 'Kim yangiladi?',
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

    /**
     * Gets query for [[Modules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModules()
    {
        return $this->hasMany(Module::class, ['course_id' => 'id']);
    }
}
