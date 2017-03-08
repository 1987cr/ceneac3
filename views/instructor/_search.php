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
 * @var app\models\InstructorSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="instructor-search">

    <?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

    		<?php echo $form->field($model, 'id') ?>

		<?php echo $form->field($model, 'user_id') ?>

		<?php echo $form->field($model, 'schedule_id') ?>

		<?php echo $form->field($model, 'created_at') ?>

		<?php echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
