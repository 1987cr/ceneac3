<?php
/**
 * /home/criera/Projects/ceneac_yii/runtime/giiant/fccccf4deb34aed738291a9c38e87215
 *
 * @package default
 */


use yii\helpers\Html;

/**
 *
 * @var yii\web\View $this
 * @var app\models\Preregistered $model
 */
$this->title = 'Crear';
$this->params['breadcrumbs'][] = ['label' => 'Preinscritos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud preregistered-create">

    <h1>
        <?php echo 'Preinscritos' ?>
        <small>
                        <?php echo $model->id ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?php echo             Html::a(
	'Cancelar',
	\yii\helpers\Url::previous(),
	['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
