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
 * @var app\models\Role $model
 */
$copyParams = $model->attributes;

$this->title = 'Role';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud role-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?php echo \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?php echo 'Role' ?>
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
	['create', 'id' => $model->id, 'Role'=>$copyParams],
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

    <?php $this->beginBlock('app\models\Role'); ?>


    <?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'name',
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



<?php $this->beginBlock('Permissions'); ?>
<div style='position: relative'>
<div style='position:absolute; right: 0px; top: 0px;'>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-list"></span> ' . 'List All' . ' Permissions',
	['permission/index'],
	['class'=>'btn text-muted btn-xs']
) ?>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-plus"></span> ' . 'New' . ' Permission',
	['permission/create', 'Permission' => ['id' => $model->id]],
	['class'=>'btn btn-success btn-xs']
); ?>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-link"></span> ' . 'Attach' . ' Permission', ['permission-role/create', 'PermissionRole'=>['role_id'=>$model->id]],
	['class'=>'btn btn-info btn-xs']
) ?>
</div>
</div>
<?php Pjax::begin(['id'=>'pjax-Permissions', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-Permissions ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>
<?php echo
'<div class="table-responsive">'
	. \yii\grid\GridView::widget([
		'layout' => '{summary}{pager}<br/>{items}{pager}',
		'dataProvider' => new \yii\data\ActiveDataProvider([
				'query' => $model->getPermissionRoles(),
				'pagination' => [
					'pageSize' => 20,
					'pageParam'=>'page-permissionroles',
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
				'template'   => '{view} {delete}',
				'contentOptions' => ['nowrap'=>'nowrap'],
				'urlCreator' => function ($action, $model, $key, $index) {
					// using the column name as key, not mapping to 'id' like the standard generator
					$params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
					$params[0] = 'permission-role' . '/' . $action;
					$params['PermissionRole'] = ['role_id' => $model->primaryKey()[0]];
					return $params;
				},
				'buttons'    => [
					'delete' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
								'class' => 'text-danger',
								'title'         => 'Remove',
								'data-confirm'  => 'Are you sure you want to delete the related item?',
								'data-method' => 'post',
								'data-pjax' => '0',
							]);
					},
					'view' => function ($url, $model) {
						return Html::a(
							'<span class="glyphicon glyphicon-cog"></span>',
							$url,
							[
								'data-title'  => 'View Pivot Record',
								'data-toggle' => 'tooltip',
								'data-pjax'   => '0',
								'class'       => 'text-muted',
							]
						);
					},
				],
				'controller' => 'permission-role'
			],
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'permission_id',
				'value' => function ($model) {
					if ($rel = $model->getPermission()->one()) {
						return Html::a($rel->name, ['permission/view', 'id' => $rel->id, ], ['data-pjax' => 0]);
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


<?php $this->beginBlock('Users'); ?>
<div style='position: relative'>
<div style='position:absolute; right: 0px; top: 0px;'>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-list"></span> ' . 'List All' . ' Users',
	['user/index'],
	['class'=>'btn text-muted btn-xs']
) ?>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-plus"></span> ' . 'New' . ' User',
	['user/create', 'User' => ['id' => $model->id]],
	['class'=>'btn btn-success btn-xs']
); ?>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-link"></span> ' . 'Attach' . ' User', ['role-user/create', 'RoleUser'=>['role_id'=>$model->id]],
	['class'=>'btn btn-info btn-xs']
) ?>
</div>
</div>
<?php Pjax::begin(['id'=>'pjax-Users', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-Users ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>
<?php echo
'<div class="table-responsive">'
	. \yii\grid\GridView::widget([
		'layout' => '{summary}{pager}<br/>{items}{pager}',
		'dataProvider' => new \yii\data\ActiveDataProvider([
				'query' => $model->getRoleUsers(),
				'pagination' => [
					'pageSize' => 20,
					'pageParam'=>'page-roleusers',
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
				'template'   => '{view} {delete}',
				'contentOptions' => ['nowrap'=>'nowrap'],
				'urlCreator' => function ($action, $model, $key, $index) {
					// using the column name as key, not mapping to 'id' like the standard generator
					$params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
					$params[0] = 'role-user' . '/' . $action;
					$params['RoleUser'] = ['role_id' => $model->primaryKey()[0]];
					return $params;
				},
				'buttons'    => [
					'delete' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
								'class' => 'text-danger',
								'title'         => 'Remove',
								'data-confirm'  => 'Are you sure you want to delete the related item?',
								'data-method' => 'post',
								'data-pjax' => '0',
							]);
					},
					'view' => function ($url, $model) {
						return Html::a(
							'<span class="glyphicon glyphicon-cog"></span>',
							$url,
							[
								'data-title'  => 'View Pivot Record',
								'data-toggle' => 'tooltip',
								'data-pjax'   => '0',
								'class'       => 'text-muted',
							]
						);
					},
				],
				'controller' => 'role-user'
			],
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'user_id',
				'value' => function ($model) {
					if ($rel = $model->getUser()->one()) {
						return Html::a($rel->name, ['user/view', 'id' => $rel->id, ], ['data-pjax' => 0]);
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


    <?php echo Tabs::widget(
	[
		'id' => 'relation-tabs',
		'encodeLabels' => false,
		'items' => [
			[
				'label'   => '<b class=""># '.$model->id.'</b>',
				'content' => $this->blocks['app\models\Role'],
				'active'  => true,
			],
			[
				'content' => $this->blocks['Permissions'],
				'label'   => '<small>Permissions <span class="badge badge-default">'.count($model->getPermissions()->asArray()->all()).'</span></small>',
				'active'  => false,
			],
			[
				'content' => $this->blocks['Users'],
				'label'   => '<small>Users <span class="badge badge-default">'.count($model->getUsers()->asArray()->all()).'</span></small>',
				'active'  => false,
			],
		]
	]
);
?>
</div>
