<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string|null $uuid
 * @property int $user_id
 * @property string|null $wants
 * @property int|null $wants_id
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    public const STATUS_NEW = 1;
    public const STATUS_APPROVED = 2;
    public const WANTS = [
        'course' => 'Kurs',
        'book' => 'Kitob',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
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
            [['uuid', 'user_id', 'wants_id', 'wants'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['uuid', 'wants', 'wants_id'], 'string', 'max' => 255],
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
            'user_id' => 'Buyurtmachi',
            'wants' => 'Buyurtma turi',
            'wants_id' => 'Buyurtma',
            'status' => 'Status',
            'created_at' => 'Yaratilgan vaqti',
            'updated_at' => 'Yangilangan vaqt',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getWantedObject()
    {
        if ($this->wants == 'course') {
            return Course::findOne(['uuid' => $this->wants_id]);
        } elseif ($this->wants == 'book') {
            return Book::findOne(['uuid' => $this->wants_id]);
        }
    }
}
