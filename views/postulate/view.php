<?php
/**
 * /home/criera/Projects/ceneac_yii/runtime/giiant/d4b4964a63cc95065fa0ae19074007ee
 *
 * @package default
 */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 *
 * @var yii\web\View $this
 * @var app\models\Postulate $model
 */
$copyParams = $model->attributes;

$this->title = 'Postulate';
$this->params['breadcrumbs'][] = ['label' => 'Postulates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud postulate-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?php echo \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?php echo 'Postulate' ?>
        <small>
            <?php echo $model->id ?>
        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?php echo Html::a(
	'<span class="glyphicon glyphicon-pencil"></span> ' . 'Edit',
	[ 'update', 'id' => $model->id],
	['class' => 'btn btn-info']) ?>

            <?php echo Html::a(
	'<span class="glyphicon glyphicon-copy"></span> ' . 'Copy',
	['create', 'id' => $model->id, 'Postulate'=>$copyParams],
	['class' => 'btn btn-success']) ?>

            <?php echo Html::a(
	'<span class="glyphicon glyphicon-plus"></span> ' . 'New',
	['create'],
	['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">
            <?php echo Html::a('<span class="glyphicon glyphicon-list"></span> '
	. 'Full list', ['index'], ['class'=>'btn btn-default']) ?>
        </div>

    </div>

    <hr />

    <?php $this->beginBlock('app\models\Postulate'); ?>


    <?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
			[
				'format' => 'html',
				'attribute' => 'user_id',
				'value' => ($model->getUser()->one() ?
					Html::a('<i class="glyphicon glyphicon-list"></i>', ['user/index']).' '.
					Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> '.$model->getUser()->one()->name, ['user/view', 'id' => $model->getUser()->one()->id, ]).' '.
					Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'Postulate'=>['user_id' => $model->user_id]])
					:
					'<span class="label label-warning">?</span>'),
			],
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
			[
				'format' => 'html',
				'attribute' => 'schedule_id',
				'value' => ($model->getSchedule()->one() ?
					Html::a('<i class="glyphicon glyphicon-list"></i>', ['schedule/index']).' '.
					Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> '.$model->getSchedule()->one()->id, ['schedule/view', 'id' => $model->getSchedule()->one()->id, ]).' '.
					Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'Postulate'=>['schedule_id' => $model->schedule_id]])
					:
					'<span class="label label-warning">?</span>'),
			],
		],
	]); ?>


    <hr/>

    <?php echo Html::a('<span class="glyphicon glyphicon-trash"></span> ' . 'Delete', ['delete', 'id' => $model->id],
	[
		'class' => 'btn btn-danger',
		'data-confirm' => '' . 'Are you sure to delete this item?' . '',
		'data-method' => 'post',
	]); ?>
    <?php $this->endBlock(); ?>



    <?php echo Tabs::widget(
	[
		'id' => 'relation-tabs',
		'encodeLabels' => false,
		'items' => [
			[
				'label'   => '<b class=""># '.$model->id.'</b>',
				'content' => $this->blocks['app\models\Postulate'],
				'active'  => true,
			],
		]
	]
);
?>
</div>
