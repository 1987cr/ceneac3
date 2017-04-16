<?php
/**
 * /home/criera/Projects/ceneac_yii/runtime/giiant/fcd70a9bfdf8de75128d795dfc948a74
 *
 * @package default
 */


use yii\helpers\Html;

/**
 *
 * @var yii\web\View $this
 * @var app\models\Schedule $model
 */
$this->title = 'Editar Cronograma';
$this->params['breadcrumbs'][] = ['label' => 'Cronograma', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="giiant-crud schedule-update">

    <h1>
      <?php
      list($fecha,$fakeHora) = explode(' ', $model->start_date);
      list($year,$month,$day) = explode('-', $fecha);
      $courseName = $model->getCourse()->one()->name;
      echo $courseName.' '.$day.'-'.$month.'-'.$year.' '.$model->start_hour ?>
    </h1>

    <div class="crud-navigation">
        <?php echo Html::a('<span class="glyphicon glyphicon-file"></span> ' . 'Detalle', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
