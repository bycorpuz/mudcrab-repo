<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salary".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $sg
 * @property double $amount
 * @property int $flag
 */
class Salary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'sg', 'flag'], 'required'],
            [['description'], 'unique'],

            [['description'], 'string'],
            [['amount'], 'number'],
            [['flag'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['sg'], 'string', 'max' => 10],
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
            'sg' => 'Grade',
            'amount' => 'Amount',
            'flag' => 'Flag',
        ];
    }
}
