<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity_log".
 *
 * @property int $id
 * @property string $module
 * @property string $action
 * @property int $user_id
 * @property int $user_id_log
 * @property string $date
 */
class ActivityLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action', 'user_id', 'user_id_log'], 'required'],
            [['action'], 'string'],
            [['user_id', 'user_id_log'], 'integer'],
            [['date'], 'safe'],
            [['module'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module' => 'Module',
            'action' => 'Action',
            'user_id' => 'User ID',
            'user_id_log' => 'User Id Log',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
