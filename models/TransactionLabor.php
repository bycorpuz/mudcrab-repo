<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction_direct_labor".
 *
 * @property int $id
 * @property int $account_title_id
 * @property int $user_id
 * @property double $amount
 * @property string $remarks
 * @property string $mode
 * @property string $date_encoded
 * @property string $or_number
 * @property int $flag
 */
class TransactionLabor extends \yii\db\ActiveRecord
{
    public $firstName ,$middleName, $lastName, $ext_name, $position, $salary;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_labor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_title_id', 'amount', 'or_number', 'flag', 'mode', 'mode_of_payment_id'], 'required'],
            [['account_title_id', 'user_id', 'flag'], 'integer'],
            [['amount'], 'number'],
            [['remarks'], 'string'],
            [['date_encoded'], 'safe'],
            [['or_number'], 'string', 'max' => 100],

            [['or_number'], 'unique'],
            [['firstName', 'middleName', 'lastName', 'ext_name', 'position', 'salary', 'mode_of_payment_id'], 'safe'],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_title_id' => 'Account Title ID',
            'user_id' => 'User ID',
            'amount' => 'Amount',
            'remarks' => 'Remarks',
            'date_encoded' => 'Date Encoded',
            'or_number' => 'Or Number',
            'flag' => 'Flag',
            'mode' => 'Mode',
            'mode_of_payment_id' => 'Mode of Payment',
        ];
    }

    public function getAccountTitle()
    {
        return $this->hasOne(AccountTitle::className(), ['id' => 'account_title_id']);
    }

    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }

    public function getSalary()
    {
        return $this->hasOne(Salary::className(), ['id' => 'salary_id']);
    }

    public function getModeOfPayment()
    {
        return $this->hasOne(ModeOfPayment::className(), ['id' => 'mode_of_payment_id']);
    }
}
