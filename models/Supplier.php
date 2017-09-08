<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $email
 * @property string $c_num
 * @property string $tin
 * @property string $account_name
 * @property string $account_number
 * @property int $is_company
 * @property int $flag
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'address', 'c_num', 'is_company', 'flag'], 'required'],
            [['description'], 'string'],
            [['name', 'description', 'email', 'c_num', 'tin', 'account_name', 'account_number'], 'unique'],
            ['email', 'email'],
            
            [['is_company', 'flag'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['address', 'email', 'account_name', 'account_number'], 'string', 'max' => 255],
            [['c_num', 'tin'], 'string', 'max' => 50],
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
            'address' => 'Address',
            'email' => 'Email',
            'c_num' => 'C Num',
            'tin' => 'Tin',
            'account_name' => 'Account Name',
            'account_number' => 'Account Number',
            'is_company' => 'Is Company',
            'flag' => 'Flag',
        ];
    }
}
