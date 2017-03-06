<?php
/**
 * /home/criera/Projects/ceneac_yii/runtime/giiant/e0080b9d6ffa35acb85312bf99a557f2
 *
 * @package default
 */


namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'ci'], 'integer'],
			[['username', 'password', 'auth_key', 'access_token', 'name', 'lastname', 'email', 'phone_mobile', 'phone_home', 'created_at', 'updated_at'], 'safe'],
		];
	}


	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function scenarios() {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}


	/**
	 * Creates data provider instance with search query applied
	 *
	 *
	 * @param array   $params
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = User::find();

		$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere([
				'id' => $this->id,
				'ci' => $this->ci,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
			]);

		$query->andFilterWhere(['like', 'username', $this->username])
		->andFilterWhere(['like', 'password', $this->password])
		->andFilterWhere(['like', 'auth_key', $this->auth_key])
		->andFilterWhere(['like', 'access_token', $this->access_token])
		->andFilterWhere(['like', 'name', $this->name])
		->andFilterWhere(['like', 'lastname', $this->lastname])
		->andFilterWhere(['like', 'email', $this->email])
		->andFilterWhere(['like', 'phone_mobile', $this->phone_mobile])
		->andFilterWhere(['like', 'phone_home', $this->phone_home]);

		return $dataProvider;
	}


}
