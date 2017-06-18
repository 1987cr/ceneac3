<?php
/**
 * /home/criera/Projects/CENEAC/ceneac_yii/runtime/giiant/eeda5c365686c9888dbc13dbc58f89a1
 *
 * @package default
 */


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 *
 * @var yii\web\View $this
 * @var app\models\UserSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

    		<?php echo $form->field($model, 'id') ?>

		<?php echo $form->field($model, 'username') ?>

		<?php echo $form->field($model, 'password') ?>

		<?php echo $form->field($model, 'auth_key') ?>

		<?php echo $form->field($model, 'access_token') ?>

		<?php // echo $form->field($model, 'name') ?>

		<?php // echo $form->field($model, 'lastname') ?>

		<?php // echo $form->field($model, 'email') ?>

		<?php // echo $form->field($model, 'ci') ?>

		<?php // echo $form->field($model, 'phone_mobile') ?>

		<?php // echo $form->field($model, 'phone_home') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
