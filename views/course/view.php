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
use kartik\export\ExportMenu;

/**
 *
 * @var yii\web\View $this
 * @var app\models\Course $model
 */
$copyParams = $model->attributes;

$this->title = 'Course';
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud course-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?php echo \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?php echo 'Course' ?>
        <small>
            <?php echo $model->name ?>
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
	['create', 'id' => $model->id, 'Course'=>$copyParams],
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

<?php $this->beginBlock('InterestLists'); ?>
<div style='position: relative'>
<div style='position:absolute; right: 0px; top: 0px;'>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-list"></span> ' . 'List All' . ' Interest Lists',
	['interest-list/index'],
	['class'=>'btn text-muted btn-xs']
) ?>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-plus"></span> ' . 'New' . ' Interest List',
	['interest-list/create', 'InterestList' => ['course_id' => $model->id]],
	['class'=>'btn btn-success btn-xs']
); ?>
</div>
</div>
<?php Pjax::begin(['id'=>'pjax-InterestLists', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-InterestLists ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>
<!-- Export  -->
  <?php
  $dataProvider = new \yii\data\ActiveDataProvider([
      'query' => $model->getInterestLists(),
    ]);
    $columns = [
   ['class' => 'kartik\grid\SerialColumn'],
   'id',
   'course_id'
  ];
  echo ExportMenu::widget([
      'dataProvider' => $dataProvider,
      'columns' => $columns,
      'fontAwesome' => true,
      'target' => 'ExportMenu::TARGET_BLANK',
      'showConfirmAlert' => false,
      'filename' => 'CENEAC_Iteresados_'.getdate()['mday'].'-'.getdate()['mon'].'-'.getdate()['year'],
  ]);
  ?>
<!-- end Export -->
<?php
 echo
'<div class="table-responsive">'
	. \yii\grid\GridView::widget([
		'layout' => '{summary}{pager}<br/>{items}{pager}',
		'dataProvider' => new \yii\data\ActiveDataProvider([
				'query' => $model->getInterestLists(),
				'pagination' => [
					'pageSize' => 20,
					'pageParam'=>'page-interestlists',
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
					$params[0] = 'interest-list' . '/' . $action;
					$params['InterestList'] = ['course_id' => $model->primaryKey()[0]];
					return $params;
				},
				'buttons'    => [

				],
				'controller' => 'interest-list'
			],
			'id',
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'user_id',
				'value' => function ($model) {
					if ($rel = $model->getUser()->one()) {
						return Html::a($rel->name.' '.$rel->lastname, ['user/view', 'id' => $rel->id, ], ['data-pjax' => 0]).' - '.$rel->ci;
					} else {
						return '';
					}
				},
				'format' => 'raw',
			],
		]
	])
	. '</div>'
?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('Schedules'); ?>
<div style='position: relative'>
<div style='position:absolute; right: 0px; top: 0px;'>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-list"></span> ' . 'List All' . ' Schedules',
	['schedule/index'],
	['class'=>'btn text-muted btn-xs']
) ?>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-plus"></span> ' . 'New' . ' Schedule',
	['schedule/create', 'Schedule' => ['course_id' => $model->id]],
	['class'=>'btn btn-success btn-xs']
); ?>
</div>
</div>
<?php Pjax::begin(['id'=>'pjax-Schedules', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-Schedules ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>
<?php echo
'<div class="table-responsive">'
	. \yii\grid\GridView::widget([
		'layout' => '{summary}{pager}<br/>{items}{pager}',
		'dataProvider' => new \yii\data\ActiveDataProvider([
				'query' => $model->getSchedules(),
				'pagination' => [
					'pageSize' => 20,
					'pageParam'=>'page-schedules',
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
					$params[0] = 'schedule' . '/' . $action;
					$params['Schedule'] = ['course_id' => $model->primaryKey()[0]];
					return $params;
				},
				'buttons'    => [

				],
				'controller' => 'schedule'
			],
			'id',
			'start_date',
			'end_date',
			'duration',
			'start_hour',
			'end_hour',
			'classroom',
		]
	])
	. '</div>'
?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>

<?php $this->beginBlock('app\models\Course'); ?>
    <?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'name',
			'description:ntext',
			'duration',
			'costos',
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
			[
				'format' => 'html',
				'attribute' => 'category_id',
				'value' => ($model->getCategory()->one() ?
					Html::a('<i class="glyphicon glyphicon-list"></i>', ['category/index']).' '.
					Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> '.$model->getCategory()->one()->name, ['category/view', 'id' => $model->getCategory()->one()->id, ]).' '.
					Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'Course'=>['category_id' => $model->category_id]])
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
				'content' => $this->blocks['InterestLists'],
				'label'   => '<small>Interesados <span class="badge badge-default">'.count($model->getInterestLists()->asArray()->all()).'</span></small>',
				'active'  => false,
			],
			[
				'content' => $this->blocks['Schedules'],
				'label'   => '<small>Entradas del Cronograma <span class="badge badge-default">'.count($model->getSchedules()->asArray()->all()).'</span></small>',
				'active'  => false,
			],
			[
				'label'   => '<b class="">Detalles</b>',
				'content' => $this->blocks['app\models\Course'],
				'active'  => true,
			],
		]
	]
);
?>
</div>
