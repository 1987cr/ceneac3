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
 * @var app\models\Payment $model
 */
$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud payment-create">

    <h1>
        <?php echo 'Payment' ?>
        <small>
                        <?php echo $model->id ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?php echo             Html::a(
	'Cancel',
	\yii\helpers\Url::previous(),
	['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
