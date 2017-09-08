<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_log".
 *
 * @property int $id
 * @property int $user_id
 * @property string $login_date
 * @property string $logout_date
 * @property string $remarks
 */
class UserLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'remarks'], 'required'],
            [['user_id'], 'integer'],
            [['login_date', 'logout_date'], 'safe'],
            [['remarks'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'login_date' => 'Login Date',
            'logout_date' => 'Logout Date',
            'remarks' => 'Remarks',
        ];
    }
}
