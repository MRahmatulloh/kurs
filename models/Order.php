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
 */
class Order extends \yii\db\ActiveRecord
{
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
            [['user_id', 'wants_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['uuid', 'wants'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'UUID',
            'user_id' => 'Buyurtmachi',
            'wants' => 'Buyurtma turi',
            'wants_id' => 'Buyurtma',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
