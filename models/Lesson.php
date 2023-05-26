<?php

namespace app\models;

use app\components\SelectListTrait;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "lessons".
 *
 * @property int $id
 * @property string|null $uuid
 * @property string $name
 * @property string $filename
 * @property string|null $description
 * @property int $module_id
 * @property string|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Module $module
 * @property View[] $views
 * @property User $createdBy
 * @property User $updatedBy
 */
class Lesson extends \yii\db\ActiveRecord
{
    use SelectListTrait;

    public const STATUSES = [
        'active' => 'Faol',
        'inactive' => 'Faol emas',
        'demo' => 'Demo',
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_DEMO = 'demo';

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lessons';
    }

    /**
     * {@inheritdoc}
     */
    public static function getTitle()
    {
        return 'Dars';
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
            [['name', 'module_id', 'file'], 'required', 'on' => 'create', 'message' => '{attribute} bo\'sh bo\'lishi mumkin emas'],
            [['name', 'module_id'], 'required', 'on' => 'update', 'message' => '{attribute} bo\'sh bo\'lishi mumkin emas'],
            [['description', 'status'], 'string'],
            [['module_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['uuid', 'name', 'filename'], 'string', 'max' => 255],
            [['module_id'], 'exist', 'skipOnError' => true, 'targetClass' => Module::class, 'targetAttribute' => ['module_id' => 'id']],
            [['file'], 'file', 'extensions' => 'mp4, 3gp, mov, avi', 'maxFiles' => 1, 'maxSize' => 150 * 1024 * 1024],
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
            'filename' => 'Fayl',
            'file' => 'Fayl',
            'description' => 'Izoh',
            'module_id' => 'Modul',
            'status' => 'Status',
            'created_at' => 'Yaratilgan vaqti',
            'updated_at' => 'Yangilangan vaqti',
            'created_by' => 'Kim yaratdi?',
            'updated_by' => 'Kim yangiladi?',
        ];
    }

    /**
     * Gets query for [[Module]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Module::class, ['id' => 'module_id']);
    }

    /**
     * Gets query for [[Views]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getViews()
    {
        return $this->hasMany(View::class, ['lesson_id' => 'id']);
    }

    public function getFilePath()
    {
        return Yii::getAlias('@app') . '/files/lessons/' . $this->filename;
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
