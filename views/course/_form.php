<?php
/**
 * /home/criera/Projects/ceneac_yii/runtime/giiant/4b7e79a8340461fe629a6ac612644d03
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
 * @var app\models\Course $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin([
		'id' => 'Course',
		'layout' => 'horizontal',
		'enableClientValidation' => true,
		'errorSummaryCssClass' => 'error-summary alert alert-error'
	]
);
?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>


<!-- attribute name -->
			<?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!-- attribute description -->
			<?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<!-- attribute duration -->
			<?php echo $form->field($model, 'duration')->textInput() ?>

<!-- attribute costos -->
			<?php echo $form->field($model, 'costos')->textInput() ?>

<!-- attribute category_id -->
			<?php echo // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
$form->field($model, 'category_id')->dropDownList(
	\yii\helpers\ArrayHelper::map(app\models\Category::find()->all(), 'id', 'name'),
	[
		'prompt' => 'Select',
		'disabled' => (isset($relAttributes) && isset($relAttributes['category_id'])),
	]
); ?>
        </p>
        <?php $this->endBlock(); ?>

        <?php echo
Tabs::widget(
	[
		'encodeLabels' => false,
		'items' => [
			[
				'label'   => 'Course',
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
