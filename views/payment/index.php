<?php
/**
 * /home/criera/Projects/ceneac_yii/runtime/giiant/a0a12d1bd32eaeeb8b2cff56d511aa22
 *
 * @package default
 */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/**
 *
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\PaymentSearch $searchModel
 */
$this->title = 'Pagos';
$this->params['breadcrumbs'][] = $this->title;

if (isset($actionColumnTemplates)) {
	$actionColumnTemplate = implode(' ', $actionColumnTemplates);
	$actionColumnTemplateString = $actionColumnTemplate;
} else {
	Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'Nuevo', ['create'], ['class' => 'btn btn-success']);
	$actionColumnTemplateString = "{view} {update} {delete}";
}
$actionColumnTemplateString = '<div class="action-buttons">'.$actionColumnTemplateString.'</div>';
?>
<div class="giiant-crud payment-index">

    <?php
//             echo $this->render('_search', ['model' =>$searchModel]);
?>


    <?php \yii\widgets\Pjax::begin(['id'=>'pjax-main', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>

    <h1>
    </h1>
    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?php echo Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'Nuevo', ['create'], ['class' => 'btn btn-success']) ?>
						<input type="button" class="btn btn-danger" value="Borrar" id="PaymentMultipleDelete" >
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
					'url' => ['preregistered/index'],
					'label' => '<i class="glyphicon glyphicon-arrow-left"></i> ' . 'Preregistered',
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
        <?php
				echo ExportMenu::widget([
		        'dataProvider' => $dataProvider,
		        'columns' => [
		        	['class' => 'yii\grid\SerialColumn'],
							[
								'class' => yii\grid\DataColumn::className(),
								'attribute' => 'preregister_id',
								'value' => function ($model) {
									if ($rel = $model->getPreregister()->one()) {
										// return var_dump($model->getUserName());
										$user = $model->getUserName();
										return Html::a($user->name.' '.$user->lastname, ['preregistered/view', 'id' => $rel->id, ], ['data-pjax' => 0]).' - '.$user->ci;
									} else {
										return '';
									}
								},
								'format' => 'raw',
							],
							'amount',
							[
								'attribute'=>'payment_type',
								'value' => function ($model) {
									return app\models\Payment::getPaymentTypeValueLabel($model->payment_type);
								}
							],
							'client_bank',
							'reference_number',
							[
									'class' => yii\grid\DataColumn::className(),
									'format' => 'raw',
									'attribute' => 'payment_date',
									'value' => function ($model) {
										list($fecha,$fakeHora) = explode(' ', $model->payment_date);
										list($year,$month,$day) = explode('-', $fecha);
										return $day.'-'.$month.'-'.$year;
									},
							],
							'remaining_amount',
							'comments:ntext',
		        ],
		        'fontAwesome' => true,
						'target' => 'ExportMenu::TARGET_BLANK',
						'showConfirmAlert' => false,
						'filename' => 'CENEAC_Pagos_'.getdate()['mday'].'-'.getdate()['mon'].'-'.getdate()['year'],
		    ]);

		 echo GridView::widget([
		'dataProvider' => $dataProvider,
		'pager' => [
			'class' => yii\widgets\LinkPager::className(),
			'firstPageLabel' => 'First',
			'lastPageLabel' => 'Last',
		],
		'options' => ['id' => 'pjax'],
		'filterModel' => $searchModel,
		'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
		'headerRowOptions' => ['class'=>'x'],
		'columns' => [
			['class' => 'yii\grid\CheckboxColumn'],
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
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'preregister_id',
				'value' => function ($model) {
					if ($rel = $model->getPreregister()->one()) {
						// return var_dump($model->getUserName());
						$user = $model->getUserName();
						return Html::a($user->name.' '.$user->lastname, ['preregistered/view', 'id' => $rel->id, ], ['data-pjax' => 0]).' - '.$user->ci;
					} else {
						return '';
					}
				},
				'format' => 'raw',
			],
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'amount',
				'value' => function ($model) {
					return $model->amount.' Bfs.';
				},
				'format' => 'raw',
			],
			[
				'attribute'=>'payment_type',
				'value' => function ($model) {
					return app\models\Payment::getPaymentTypeValueLabel($model->payment_type);
				}


			],
			[
					'class' => yii\grid\DataColumn::className(),
					'format' => 'raw',
					'attribute' => 'payment_date',
					'value' => function ($model) {
						list($fecha,$fakeHora) = explode(' ', $model->payment_date);
						list($year,$month,$day) = explode('-', $fecha);
						return $day.'-'.$month.'-'.$year;
					},
			],
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'remaining_amount',
				'value' => function ($model) {
					return $model->remaining_amount.' Bfs.';
				},
				'format' => 'raw',
			],
			'comments:ntext',
		],
	]); ?>
    </div>

</div>

<?php \yii\widgets\Pjax::end() ?>
