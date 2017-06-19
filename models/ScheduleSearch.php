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
			[['course_id','id', 'duration', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'], 'integer'],
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
		$fi1 = ''; // Fecha de Inicio - Inicio
		$fi2 = ''; // Fecha de Inicio - Fin

		if($fecha_ini != '') {
			list($fi1_s, $fi2_s) = explode(' a ', $fecha_ini);
			$fi1 = \DateTime::createFromFormat('d-m-Y', $fi1_s)->format('Y-m-d');
			$fi2 = \DateTime::createFromFormat('d-m-Y', $fi2_s)->format('Y-m-d');
		}

		$fecha_fin = $this->end_date;
		$ff1 = ''; // Fecha de Finalización - Inicio
		$ff2 = ''; // Fecha de Finalización - Fin

		if($fecha_fin  != '') {
			list($ff1_s, $ff2_s) = explode(' a ', $fecha_fin);
			$ff1 = \DateTime::createFromFormat('d-m-Y', $ff1_s)->format('Y-m-d');
			$ff2 = \DateTime::createFromFormat('d-m-Y', $ff2_s)->format('Y-m-d');
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

		$query->andFilterWhere(['like', 'start_hour', $this->start_hour])
		->andFilterWhere(['like', 'end_hour', $this->end_hour])
		->andFilterWhere(['like', 'classroom', $this->classroom])
		->andFilterWhere(['like', 'comments', $this->comments])
		->andFilterWhere(['>=', 'start_date', $fi1])
		->andFilterWhere(['<=', 'start_date', $fi2])
		->andFilterWhere(['>=', 'end_date', $ff1])
		->andFilterWhere(['<=', 'end_date', $ff2]);

		return $dataProvider;
	}


}
