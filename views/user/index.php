<?php
/**
 * /home/criera/Projects/ceneac_yii/runtime/giiant/a0a12d1bd32eaeeb8b2cff56d511aa22
 *
 * @package default
 */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
 *
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\UserSearch $searchModel
 */
$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;

if (isset($actionColumnTemplates)) {
	$actionColumnTemplate = implode(' ', $actionColumnTemplates);
	$actionColumnTemplateString = $actionColumnTemplate;
} else {
	Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'New', ['create'], ['class' => 'btn btn-success']);
	$actionColumnTemplateString = "{view} {update} {delete}";
}
$actionColumnTemplateString = '<div class="action-buttons">'.$actionColumnTemplateString.'</div>';
?>
<div class="giiant-crud user-index">

    <?php
//             echo $this->render('_search', ['model' =>$searchModel]);
?>


    <?php \yii\widgets\Pjax::begin(['id'=>'pjax-main', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>

    <h1>
    </h1>
    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?php echo Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'Nuevo', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">


            <?php echo
\yii\bootstrap\ButtonDropdown::widget(
	[
		'id' => 'giiant-relations',
		'encodeLabel' => false,
		'label' => '<span class="glyphicon glyphicon-paperclip"></span> ' . 'Relations',
		'dropdown' => [
			'options' => [
				'class' => 'dropdown-menu-right'
			],
			'encodeLabels' => false,
			'items' => [
				[
					'url' => ['instructor/index'],
					'label' => '<i class="glyphicon glyphicon-arrow-right"></i> ' . 'Instructor',
				],
				[
					'url' => ['interest-list/index'],
					'label' => '<i class="glyphicon glyphicon-arrow-right"></i> ' . 'Interest List',
				],
				[
					'url' => ['permission-user/index'],
					'label' => '<i class="glyphicon glyphicon-random text-muted"></i> ' . 'Permission User',
				],
				[
					'url' => ['permission/index'],
					'label' => '<i class="glyphicon glyphicon-arrow-right"></i> ' . 'Permission',
				],
				[
					'url' => ['postulate/index'],
					'label' => '<i class="glyphicon glyphicon-arrow-right"></i> ' . 'Postulate',
				],
				[
					'url' => ['preregistered/index'],
					'label' => '<i class="glyphicon glyphicon-arrow-right"></i> ' . 'Preregistered',
				],
				[
					'url' => ['registered/index'],
					'label' => '<i class="glyphicon glyphicon-arrow-right"></i> ' . 'Registered',
				],
				[
					'url' => ['role-user/index'],
					'label' => '<i class="glyphicon glyphicon-random text-muted"></i> ' . 'Role User',
				],
				[
					'url' => ['role/index'],
					'label' => '<i class="glyphicon glyphicon-arrow-right"></i> ' . 'Role',
				],

			]
		],
		'options' => [
			'class' => 'btn-default'
		]
	]
);
?>
        </div>
    </div>

    <hr />

    <div class="table-responsive">
        <?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'pager' => [
			'class' => yii\widgets\LinkPager::className(),
			'firstPageLabel' => 'First',
			'lastPageLabel' => 'Last',
		],
		'filterModel' => $searchModel,
		'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
		'headerRowOptions' => ['class'=>'x'],
		'columns' => [
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => $actionColumnTemplateString,
				'buttons' => [
					'view' => function ($url, $model, $key) {
						$options = [
							'title' => Yii::t('yii', 'View'),
							'aria-label' => Yii::t('yii', 'View'),
							'data-pjax' => '0',
						];
						return Html::a('<span class="glyphicon glyphicon-file"></span>', $url, $options);
					}


				],
				'urlCreator' => function($action, $model, $key, $index) {
					// using the column name as key, not mapping to 'id' like the standard generator
					$params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
					$params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
					return Url::toRoute($params);
				},
				'contentOptions' => ['nowrap'=>'nowrap']
			],
			'ci',
			'username',
			'name',
			'lastname',
			'email:email',
		],
	]); ?>
    </div>

</div>


<?php \yii\widgets\Pjax::end() ?>
