<?php

namespace app\models;

use app\components\SelectListTrait;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "modules".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $course_id
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Course $course
 * @property Lesson[] $lessons
 */
class Module extends \yii\db\ActiveRecord
{
    use SelectListTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modules';
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
            [['name', 'course_id'], 'required'],
            [['description'], 'string'],
            [['course_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::class, 'targetAttribute' => ['course_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nomi',
            'description' => 'Izoh',
            'course_id' => 'Kurs',
            'status' => 'Status',
            'created_at' => 'Yaratilgan vaqti',
            'updated_at' => 'Yangilangan vaqti',
            'created_by' => 'Kim yaratdi?',
            'updated_by' => 'Kim yangiladi?',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::class, ['id' => 'course_id']);
    }

    /**
     * Gets query for [[Lessons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLessons()
    {
        return $this->hasMany(Lesson::class, ['module_id' => 'id']);
    }
}
