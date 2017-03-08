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
 * @var app\models\Instructor $model
 */
$this->title = 'Instructor' . " " . $model->id . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Instructor', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="giiant-crud instructor-update">

    <h1>
        <?php echo 'Instructor' ?>
        <small>
                        <?php echo $model->id ?>
        </small>
    </h1>

    <div class="crud-navigation">
        <?php echo Html::a('<span class="glyphicon glyphicon-file"></span> ' . 'View', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
