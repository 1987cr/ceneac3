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
 * @var app\models\Preregistered $model
 */
$copyParams = $model->attributes;

$this->title = 'Preinscrito';
$this->params['breadcrumbs'][] = ['label' => 'Preinscritos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Detalle';
?>
<div class="giiant-crud preregistered-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?php echo \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?php echo $model->getUser()->one()->name.' '.$model->getUser()->one()->lastname.' | '.$model->getUser()->one()->ci ?>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?php echo Html::a(
	'<span class="glyphicon glyphicon-pencil"></span> ' . 'Editar',
	[ 'update', 'id' => $model->id],
	['class' => 'btn btn-info']) ?>

            <?php echo Html::a(
	'<span class="glyphicon glyphicon-copy"></span> ' . 'Copiar',
	['create', 'id' => $model->id, 'Preregistered'=>$copyParams],
	['class' => 'btn btn-success']) ?>

            <?php echo Html::a(
	'<span class="glyphicon glyphicon-plus"></span> ' . 'Nuevo',
	['create'],
	['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">
            <?php echo Html::a('<span class="glyphicon glyphicon-list"></span> '
	. 'Full list', ['index'], ['class'=>'btn btn-default']) ?>
        </div>

    </div>

    <hr />

    <?php $this->beginBlock('app\models\Preregistered'); ?>


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
					Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'Preregistered'=>['user_id' => $model->user_id]])
					:
					'<span class="label label-warning">?</span>'),
			],
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
			[
				'format' => 'html',
				'attribute' => 'schedule_id',
				'value' => ($model->getSchedule()->one() ?
					Html::a('<i class="glyphicon glyphicon-list"></i>', ['schedule/index']).' '.
					Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> '.$model->getScheduleName()->name, ['schedule/view', 'id' => $model->getSchedule()->one()->id, ])." ".explode(' ', $model->getSchedule()->one()->start_date)[0].' '.
					Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'Preregistered'=>['schedule_id' => $model->schedule_id]])
					:
					'<span class="label label-warning">?</span>'),
			],
      [
        'format' => 'html',
        'attribute' => 'preregister_date',
        'value' => (explode(' ', $model->preregister_date)[0])
      ],
      [
          'class' => yii\grid\DataColumn::className(),
          'format' => 'raw',
          'attribute' => 'status',
          'value' => function ($model) {
            if($model->status == 1){
              return  '<i class="fa fa-check">';
            }else {
              return  '<i class="fa fa-times">';
            }
          },
      ],
			'comments:ntext',
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



<?php $this->beginBlock('Payments'); ?>
<div style='position: relative'>
<div style='position:absolute; right: 0px; top: 0px;'>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-list"></span> ' . 'List All' . ' Payments',
	['payment/index'],
	['class'=>'btn text-muted btn-xs']
) ?>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-plus"></span> ' . 'New' . ' Payment',
	['payment/create', 'Payment' => ['preregister_id' => $model->id]],
	['class'=>'btn btn-success btn-xs']
); ?>
</div>
</div>
<?php Pjax::begin(['id'=>'pjax-Payments', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-Payments ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>
<?php echo
'<div class="table-responsive">'
	. \yii\grid\GridView::widget([
		'layout' => '{summary}{pager}<br/>{items}{pager}',
		'dataProvider' => new \yii\data\ActiveDataProvider([
				'query' => $model->getPayments(),
				'pagination' => [
					'pageSize' => 20,
					'pageParam'=>'page-payments',
				]
			]),
		'pager'        => [
			'class'          => yii\widgets\LinkPager::className(),
			'firstPageLabel' => 'First',
			'lastPageLabel'  => 'Last'
		],
		'columns' => [
			[
				'class'      => 'yii\grid\ActionColumn',
				'template'   => '{view} {update}',
				'contentOptions' => ['nowrap'=>'nowrap'],
				'urlCreator' => function ($action, $model, $key, $index) {
					// using the column name as key, not mapping to 'id' like the standard generator
					$params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
					$params[0] = 'payment' . '/' . $action;
					$params['Payment'] = ['preregister_id' => $model->primaryKey()[0]];
					return $params;
				},
				'buttons'    => [

				],
				'controller' => 'payment'
			],
      [
        'class' => yii\grid\DataColumn::className(),
        'attribute' => 'amount',
        'value' => function ($model) {
          return $model->amount.' Bfs.';
        },
        'format' => 'raw',
      ],
			'payment_type',
			'payment_date',
      [
        'class' => yii\grid\DataColumn::className(),
        'attribute' => 'remaining_amount',
        'value' => function ($model) {
          return $model->amount.' Bfs.';
        },
        'format' => 'raw',
      ],
			'comments:ntext',
		]
	])
	. '</div>'
?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


    <?php echo Tabs::widget(
	[
		'id' => 'relation-tabs',
		'encodeLabels' => false,
		'items' => [
			[
				'label'   => '<b class=""># '.$model->id.'</b>',
				'content' => $this->blocks['app\models\Preregistered'],
				'active'  => true,
			],
			[
				'content' => $this->blocks['Payments'],
				'label'   => '<small>Payments <span class="badge badge-default">'.count($model->getPayments()->asArray()->all()).'</span></small>',
				'active'  => false,
			],
		]
	]
);
?>
</div>
