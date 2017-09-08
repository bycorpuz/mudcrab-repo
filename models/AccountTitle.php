<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_title".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $flag
 */
class AccountTitle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_title';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'flag'], 'required'],
            [['name', 'description'], 'unique'],
            
            [['description'], 'string'],
            [['flag'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'flag' => 'Flag',
        ];
    }
}
