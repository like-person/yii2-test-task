<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "repositories".
 *
 * @property int $id
 * @property string $url
 * @property int $user_id
 * @property string $update_datetime
 * @property int $history
 * @property string $added_datetime
 */
class Repositories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'repositories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'user_id'], 'required'],
            [['user_id', 'history'], 'integer'],
            [['update_datetime', 'added_datetime'], 'safe'],
            [['url'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'user_id' => 'User ID',
            'update_datetime' => 'Update Datetime',
            'history' => 'History',
            'added_datetime' => 'Added Datetime',
        ];
    }
}
