<?php
/**
 * /home/criera/Projects/ceneac_yii/runtime/giiant/358b0e44f1c1670b558e36588c267e47
 *
 * @package default
 */


// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\controllers\base;

use app\models\Backup;
use app\models\BackupSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;
use Ifsnop\Mysqldump as IMysqldump;

/**
 * BackupController implements the CRUD actions for Backup model.
 */
class BackupController extends Controller
{


	/**
	 *
	 * @var boolean whether to enable CSRF validation for the actions in this controller.
	 * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
	 */
	public $enableCsrfValidation = false;


	/**
	 * Lists all Backup models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new BackupSearch;
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
	 * Displays a single Backup model.
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
	 * Creates a new Backup model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Backup;

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
	 * Updates an existing Backup model.
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
	 * Deletes an existing Backup model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		try {
			$model = $this->findModel($id);
			unlink($model->filename);
			$model->delete();
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
	 * Finds the Backup model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @throws HttpException if the model cannot be found
	 * @param integer $id
	 * @return Backup the loaded model
	 */
	protected function findModel($id) {
		if (($model = Backup::findOne($id)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}

	public function actionBackup() 
  {
		try {
				$filename = \Yii::getAlias('@app').'/backups/dump'.date("Y-m-d-H:i:s").'.sql';
				$dump = new IMysqldump\Mysqldump('mysql:host=localhost:3306;dbname=ceneac5', 'root', 'root');
				$dump->start($filename);

		    $model = new Backup();
				$model->filename = $filename;

				if($model->validate()){
					$model->save(false); 
				}else{
					return $model->errors;
				}

		} catch (\Exception $e) {
		    echo 'mysqldump-php error: ' . $e->getMessage();
		}
    return;
  }

  //TO-DO
  public function actionDownloadDump() {
  	if(file_exists('/home/criera/Projects/ceneac_yii/backups/dump2017-03-10-03:35:13.sql')) {
  		\Yii::$app->response->sendFile('/home/criera/Projects/ceneac_yii/backups/dump2017-03-10-03:35:13.sql');
  	}
  }
}
