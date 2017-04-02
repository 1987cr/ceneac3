<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') {
/**
 * Do not use this code in your template. Remove it.
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css"/> -->
        <link rel="stylesheet" href="/web/css/vendor/select2.min.css">
        <link rel="stylesheet" href="/web/css/vendor/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="/web/css/vendor/jquery.timepicker.min.css">
        <link rel="stylesheet" href="/web/css/vendor/toastr.min.css">
        <?php $this->head() ?>
    </head>
    <body class="hold-transition <?= \dmstr\helpers\AdminLteHelper::skinClass() ?> sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    <script src="/web/js/vendor/select2.min.js"></script>
    <script src='/web/js/vendor/datepicker.js'></script>
    <script src="/web/js/vendor/bootstrap-datepicker.es.min.js"></script>
    <script src="/web/js/vendor/jquery.timepicker.min.js"></script>
    <script src="/web/js/vendor/toastr.min.js"></script>
    <script src='/web/js/vendor/tinymce.min.js'></script>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
