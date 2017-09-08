<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsersInformation;

/**
 * UsersInformationSearch represents the model behind the search form of `app\models\UsersInformation`.
 */
class UsersInformationSearch extends UsersInformation
{
    public $status;
    public $email;
    public $username;

    public $position;
    public $salary;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['firstName', 'middleName', 'lastName', 'ext_name', 'sex', 'c_num', 'bday','address', 'tin', 'account_name', 'account_number'], 'safe'],
            [['status', 'position', 'salary', 'email', 'username'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UsersInformation::find()->joinWith('users.position')->joinWith('users.salary')->where(['!=','user.id',1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => ['defaultOrder' => ['user_id' => SORT_DESC]],
        ]);

        $dataProvider->sort->attributes['status'] = [
            'asc' => ['user.status' => SORT_ASC],
            'desc' => ['user.status' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['email'] = [
            'asc' => ['user.email' => SORT_ASC],
            'desc' => ['user.email' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['position'] = [
            'asc' => ['position.id' => SORT_ASC],
            'desc' => ['position.id' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['salary'] = [
            'asc' => ['salary.id' => SORT_ASC],
            'desc' => ['salary.id' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'middleName', $this->middleName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])

            ->andFilterWhere(['like', 'ext_name', $this->ext_name])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'c_num', $this->c_num])
            ->andFilterWhere(['like', 'bday', $this->bday])
            ->andFilterWhere(['like', 'address', $this->address])

            ->andFilterWhere(['=', 'user.status', $this->status])
            ->andFilterWhere(['like', 'user.username', $this->username])
            ->andFilterWhere(['like', 'user.email', $this->email])

            ->andFilterWhere(['=', 'position.id', $this->position])
            ->andFilterWhere(['=', 'salary.id', $this->salary])

            ->andFilterWhere(['like', 'tin', $this->tin])
            ->andFilterWhere(['like', 'account_name', $this->account_name])
            ->andFilterWhere(['like', 'account_number', $this->account_number])
            
            ;

        return $dataProvider;
    }
}
