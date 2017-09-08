<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
* @property int $user_id
 * @property string $firstName
 * @property string $middleName
 * @property string $lastName
 * @property string $ext_name
 * @property string $sex
 * @property string $c_num
 * @property string $bday
 * @property string $address
 * @property string $tin
 * @property string $account_name
 * @property string $account_number
 *
 */
class UsersInformation extends \yii\db\ActiveRecord
{   
    public $username, $password, $email, $id, $position, $salary;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'middleName', 'lastName', 'sex', 'bday', 'c_num', 'address', 'position', 'salary'], 'required'],
            [['firstName', 'middleName', 'lastName', 'address'], 'string'],
            [['ext_name', 'sex'], 'string', 'max' => 10],
            [['c_num', 'tin'], 'string', 'max' => 50],
            [['account_name', 'account_number'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            [['password'], 'required'],
            [['password'], 'string', 'max' => 100],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'ext_name' => 'Ext Name',
            'sex' => 'Sex',
            'c_num' => 'Contact Number',
            'bday' => 'Birthday',
            'address' => 'Address',
            'tin' => 'TIN',
            'account_name' => 'Account Name',
            'account_number' => 'Account Number',
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
