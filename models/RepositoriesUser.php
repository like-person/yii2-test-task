<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "repositories_user".
 *
 * @property int $user_id
 * @property string $login
 */
class RepositoriesUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'repositories_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login'], 'required'],
            [['login'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'login' => 'Login',
        ];
    }
}
