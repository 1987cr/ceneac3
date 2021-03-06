<?php
/**
 * /home/criera/Projects/ceneac_yii/runtime/giiant/358b0e44f1c1670b558e36588c267e47
 *
 * @package default
 */


// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\controllers\base;

use app\models\Postulate;
use app\models\Instructor;
use app\models\PostulateSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;

/**
 * PostulateController implements the CRUD actions for Postulate model.
 */
class PostulateController extends Controller
{


	/**
	 *
	 * @var boolean whether to enable CSRF validation for the actions in this controller.
	 * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
	 */
	public $enableCsrfValidation = false;


	/**
	 * Lists all Postulate models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new PostulateSearch;
		$dataProvider = $searchModel->search($_GET);

		Tabs::clearLocalStorage();

		Url::remember();
		\Yii::$app->session['__crudReturnUrl'] = null;

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
			]);
	}


	/**
	 * Displays a single Postulate model.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		\Yii::$app->session['__crudReturnUrl'] = Url::previous();
		Url::remember();
		Tabs::rememberActiveState();

		return $this->render('view', [
			'model' => $this->findModel($id),
			]);
	}


	/**
	 * Creates a new Postulate model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Postulate;

		try {
			if ($model->load($_POST) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			} elseif (!\Yii::$app->request->isPost) {
				$model->load($_GET);
			}
		} catch (\Exception $e) {
			$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
			$model->addError('_exception', $msg);
		}
		return $this->render('create', ['model' => $model]);
	}


	/**
	 * Updates an existing Postulate model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
				]);
		}
	}


	/**
	 * Deletes an existing Postulate model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		try {
			$this->findModel($id)->delete();
		} catch (\Exception $e) {
			$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
			\Yii::$app->getSession()->addFlash('error', $msg);
			return $this->redirect(Url::previous());
		}


		// TODO: improve detection
		$isPivot = strstr('$id', ',');
		if ($isPivot == true) {
			return $this->redirect(Url::previous());
		} elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
			Url::remember(null);
			$url = \Yii::$app->session['__crudReturnUrl'];
			\Yii::$app->session['__crudReturnUrl'] = null;

			return $this->redirect($url);
		} else {
			return $this->redirect(['index']);
		}
	}


	/**
	 * Finds the Postulate model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @throws HttpException if the model cannot be found
	 * @param integer $id
	 * @return Postulate the loaded model
	 */
	protected function findModel($id) {
		if (($model = Postulate::findOne($id)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}

	public function actionAprobarPostulados()
	{
		$pk = \Yii::$app->request->post('row_id');

		if (!$pk) {
			return;
		}

		foreach ($pk as $key => $value)
		{
			$postulado = Postulate::findOne((int)$value);
			$user_id = $postulado->user_id;
			$schedule_id = $postulado->schedule_id;
			$postulado->delete();

			$instructor = Instructor::find()
			->where(['user_id' => $user_id])
			->where(['schedule_id' => $schedule_id])
			->one();

			if($instructor == null) {
				$has = new Instructor();
				$has->user_id = $user_id;
				$has->schedule_id = $schedule_id;
				$has->save();
			}
		}

		return;
	}

	public function actionMultipleDelete() {
		$pk = \Yii::$app->request->post('row_id');

		if (!$pk) {
			return;
		}
		$res = '';
		
		foreach ($pk as $key => $value) {
			try {
				$this->findModel($value)->delete();
				$res.= 'deleted,';
			} catch (\Exception $e) {
				$res.= 'error,';
			}
		}
		
		return rtrim($res, ",");
	}
}
