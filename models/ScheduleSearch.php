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
use app\models\Schedule;

/**
 * ScheduleSearch represents the model behind the search form about `app\models\Schedule`.
 */
class ScheduleSearch extends Schedule
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'course_id', 'duration', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'], 'integer'],
			[['start_date', 'end_date', 'start_hour', 'end_hour', 'classroom', 'comments', 'created_at', 'updated_at'], 'safe'],
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
		$query = Schedule::find();

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
				'course_id' => $this->course_id,
				'start_date' => $this->start_date,
				'end_date' => $this->end_date,
				'duration' => $this->duration,
				'monday' => $this->monday,
				'tuesday' => $this->tuesday,
				'wednesday' => $this->wednesday,
				'thursday' => $this->thursday,
				'friday' => $this->friday,
				'saturday' => $this->saturday,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
			]);

		$query->andFilterWhere(['like', 'start_hour', $this->start_hour])
		->andFilterWhere(['like', 'end_hour', $this->end_hour])
		->andFilterWhere(['like', 'classroom', $this->classroom])
		->andFilterWhere(['like', 'comments', $this->comments]);

		return $dataProvider;
	}


}
