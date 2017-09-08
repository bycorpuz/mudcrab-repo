<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TransactionLabor;

/**
 * TransactionDirectLaborSearch represents the model behind the search form of `app\models\TransactionLabor`.
 */
class TransactionDirectLaborSearch extends TransactionLabor
{
    public $firstName ,$middleName, $lastName, $ext_name, $position, $salary;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'account_title_id', 'user_id', 'flag'], 'integer'],
            [['amount'], 'number'],
            [['date_encoded', 'remarks', 'or_number', 'mode'], 'safe'],

            [['firstName', 'middleName', 'lastName', 'ext_name', 'position', 'salary', 'mode_of_payment_id'], 'safe'],
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
        $query = TransactionLabor::find()
        ->joinWith('accountTitle')
        ->joinWith('modeOfPayment')
        ->joinWith('users.userinfo')
        ->joinWith('users.position')
        ->joinWith('users.salary')
        ->where(['transaction_labor.mode' => 'Direct Labor'])
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        $dataProvider->sort->attributes['firstName'] = [
            'asc' => ['user_info.firstName' => SORT_ASC],
            'desc' => ['user_info.firstName' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['middleName'] = [
            'asc' => ['user_info.middleName' => SORT_ASC],
            'desc' => ['user_info.middleName' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['lastName'] = [
            'asc' => ['user_info.lastName' => SORT_ASC],
            'desc' => ['user_info.lastName' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['ext_name'] = [
            'asc' => ['user_info.ext_name' => SORT_ASC],
            'desc' => ['user_info.ext_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['position'] = [
            'asc' => ['position.id' => SORT_ASC],
            'desc' => ['position.id' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['salary'] = [
            'asc' => ['salary.id' => SORT_ASC],
            'desc' => ['salary.id' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['mode_of_payment_id'] = [
            'asc' => ['mode_of_payment.id' => SORT_ASC],
            'desc' => ['mode_of_payment.id' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'account_title_id' => $this->account_title_id,
            'user_id' => $this->user_id,
            'transaction_labor.amount' => $this->amount,
            'date_encoded' => $this->date_encoded,
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'or_number', $this->or_number])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['=', 'firstName', $this->firstName])

            ->andFilterWhere(['=', 'firstName', $this->firstName])
            ->andFilterWhere(['=', 'middleName', $this->middleName])
            ->andFilterWhere(['=', 'lastName', $this->lastName])
            ->andFilterWhere(['=', 'ext_name', $this->ext_name])

            ->andFilterWhere(['=', 'position.id', $this->position])
            ->andFilterWhere(['=', 'salary.id', $this->salary])
            ->andFilterWhere(['=', 'mode_of_payment.id', $this->mode_of_payment_id])
            ->andFilterWhere(['like', 'mode', $this->mode])

        ;

        return $dataProvider;
    }
}
