<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property int $confirmed_at
 * @property string $unconfirmed_email
 * @property int $blocked_at
 * @property string $registration_ip
 * @property int $created_at
 * @property int $updated_at
 * @property int $flags
 * @property int $last_login_at
 * @property string $profile_pic
 * @property int $status
 *
 * @property UserInfo $userInfo
 */
class Users extends \yii\db\ActiveRecord
{

    public $password_hash2;
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password_hash', 'password_hash2'], 'required'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'last_login_at', 'status', 'id', 'position_id', 'salary_id'], 'integer'],
            [['unconfirmed_email'], 'string', 'max' => 255],
            [['password_hash','password_reset_token'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],

            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['profile_pic'], 'unique', 'targetAttribute' => ['profile_pic']],
            [['profile_pic'], 'string', 'max' => 300],

            ['password_hash2', 'compare', 'compareAttribute' => 'password_hash', 'message' => "Passwords don't match"],
            ['password_hash', 'string', 'min' => 6],
            ['password_hash2', 'string', 'min' => 6],
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
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password',
            'password_hash2' => 'Confirm Password',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flags' => 'Flags',
            'last_login_at' => 'Last Login At',
            'profile_pic' => 'Profile Pic',
            'status' => 'Status',
            'file' => 'Profile Picture',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserinfo()
    {
        return $this->hasOne(UsersInformation::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }

    public function getSalary()
    {
        return $this->hasOne(Salary::className(), ['id' => 'salary_id']);
    }
}
