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
use app\models\Payment;

/**
 * PaymentSearch represents the model behind the search form about `app\models\Payment`.
 */
class PaymentSearch extends Payment
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'preregister_id'], 'integer'],
			[['amount', 'remaining_amount'], 'number'],
			[['payment_type', 'payment_date', 'comments', 'created_at','client_bank','reference_number', 'updated_at'], 'safe'],
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
		$query = Payment::find();

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
				'preregister_id' => $this->preregister_id,
				'amount' => $this->amount,
				'client_bank' => $this->client_bank,
				'reference_number' => $this->reference_number,
				'payment_date' => $this->payment_date,
				'remaining_amount' => $this->remaining_amount,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
			]);

		$query->andFilterWhere(['like', 'payment_type', $this->payment_type])
		->andFilterWhere(['like', 'comments', $this->comments]);

		return $dataProvider;
	}


}
