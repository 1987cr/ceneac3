<?php
/**
 * /home/criera/Projects/ceneac_yii/runtime/giiant/eeda5c365686c9888dbc13dbc58f89a1
 *
 * @package default
 */


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 *
 * @var yii\web\View $this
 * @var app\models\ScheduleSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="schedule-search">

    <?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

    		<?php echo $form->field($model, 'id') ?>

		<?php echo $form->field($model, 'course_id') ?>

		<?php echo $form->field($model, 'start_date') ?>

		<?php echo $form->field($model, 'end_date') ?>

		<?php echo $form->field($model, 'duration') ?>

		<?php // echo $form->field($model, 'start_hour') ?>

		<?php // echo $form->field($model, 'end_hour') ?>

		<?php // echo $form->field($model, 'classroom') ?>

		<?php // echo $form->field($model, 'monday') ?>

		<?php // echo $form->field($model, 'tuesday') ?>

		<?php // echo $form->field($model, 'wednesday') ?>

		<?php // echo $form->field($model, 'thursday') ?>

		<?php // echo $form->field($model, 'friday') ?>

		<?php // echo $form->field($model, 'saturday') ?>

		<?php // echo $form->field($model, 'comments') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
