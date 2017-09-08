<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "_configuration".
 *
 * @property int $id
 * @property string $companyName
 * @property string $siteName
 * @property string $description
 * @property string $favicon
 * @property string $logo
 */
class Configuration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '_configuration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'companyName', 'siteName', 'description', 'favicon', 'logo'], 'required'],
            [['id'], 'integer'],
            [['companyName', 'siteName', 'description', 'favicon', 'logo'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companyName' => 'Company Name',
            'siteName' => 'Site Name',
            'description' => 'Description',
            'favicon' => 'Favicon',
            'logo' => 'Logo',
        ];
    }
}
