<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "site_params".
 *
 * @property int $param_id
 * @property string $name
 * @property string $value
 */
class SiteParams extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site_params';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['name'], 'string', 'max' => 128],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'param_id' => 'Param ID',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }
}
