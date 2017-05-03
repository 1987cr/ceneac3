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

public $courseFullName;
	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'course_id', 'duration', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'], 'integer'],
			[['start_date', 'end_date', 'start_hour', 'end_hour', 'classroom', 'comments', 'created_at', 'updated_at',' name', 'courseFullName'], 'safe'],
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

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
	    if (($pos = strrpos($attribute, '.')) !== false) {
	        $modelAttribute = substr($attribute, $pos + 1);
	    } else {
	        $modelAttribute = $attribute;
	    }

	    $value = $this->$modelAttribute;
	    if (trim($value) === '') {
	        return;
	    }

	    /*
	     * The following line is additionally added for right aliasing
	     * of columns so filtering happen correctly in the self join
	     */
	    // $attribute = "tbl_perso.$attribute";
			// 
	    // if ($partialMatch) {
	    //     $query->andWhere(['like', $attribute, $value]);
	    // } else {
	    //     $query->andWhere([$attribute => $value]);
	    // }
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

		$fecha_ini = $this->start_date;
		if($this->start_date != '') {
			$fecha_ini_f = \DateTime::createFromFormat('d-m-Y', $this->start_date);
			$fecha_ini = $fecha_ini_f->format('Y-m-d');
		}

		$fecha_fin = $this->end_date;
		if($this->end_date != '') {
			$fecha_fin_f = \DateTime::createFromFormat('d-m-Y', $this->end_date);
			$fecha_fin = $fecha_fin_f->format('Y-m-d');
		}

		$query->andFilterWhere([
				'id' => $this->id,
				'course_id' => $this->course_id,
				'duration' => $this->duration,
				'monday' => $this->monday,
				'tuesday' => $this->tuesday,
				'wednesday' => $this->wednesday,
				'thursday' => $this->thursday,
				'friday' => $this->friday,
				'saturday' => $this->saturday,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at
			]);
			$this->addCondition($query, 'courseFullName');

		$query->andFilterWhere(['like', 'start_hour', $this->start_hour])
		->andFilterWhere(['like', 'end_hour', $this->end_hour])
		->andFilterWhere(['like', 'classroom', $this->classroom])
		->andFilterWhere(['like', 'comments', $this->comments])
		->andFilterWhere(['>=', 'start_date', $fecha_ini])
		->andFilterWhere(['<=', 'end_date', $fecha_fin]);

		return $dataProvider;
	}


}
