<?php
/**
 * /home/criera/Projects/CENEAC/ceneac_yii/runtime/giiant/4b7e79a8340461fe629a6ac612644d03
 *
 * @package default
 */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
 *
 * @var yii\web\View $this
 * @var app\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
		'id' => 'User',
		'layout' => 'horizontal',
		'enableClientValidation' => true,
		'errorSummaryCssClass' => 'error-summary alert alert-error'
	]
);
?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>


<!-- attribute username -->
			<?php echo $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

<!-- attribute password -->
			<?php echo $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

<!-- attribute name -->
			<?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!-- attribute lastname -->
			<?php echo $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

<!-- attribute email -->
			<?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<!-- attribute ci -->
			<?php echo $form->field($model, 'ci')->textInput() ?>

<!-- attribute auth_key -->
			<?php echo $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

<!-- attribute access_token -->
			<?php echo $form->field($model, 'access_token')->textInput(['maxlength' => true]) ?>

<!-- attribute phone_mobile -->
			<?php echo $form->field($model, 'phone_mobile')->textInput(['maxlength' => true]) ?>

<!-- attribute phone_home -->
			<?php echo $form->field($model, 'phone_home')->textInput(['maxlength' => true]) ?>
        </p>
        <?php $this->endBlock(); ?>

        <?php echo
Tabs::widget(
	[
		'encodeLabels' => false,
		'items' => [
			[
				'label'   => 'Participante',
				'content' => $this->blocks['main'],
				'active'  => true,
			],
		]
	]
);
?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?php echo Html::submitButton(
	'<span class="glyphicon glyphicon-check"></span> ' .
	($model->isNewRecord ? 'Create' : 'Save'),
	[
		'id' => 'save-' . $model->formName(),
		'class' => 'btn btn-success'
	]
);
?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
