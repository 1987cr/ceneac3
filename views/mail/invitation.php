<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */


?>
<head>
  <style type="text/css">
      .mail-body{
        padding: 20px;
      }
      .title{
        text-align: center;
      }
      p{
        font-size: 15px;
      }
  </style>
</head>
<body>
  <div class="mail-body">
    <h2 class="title">Abierto curso de  <?php echo $course->name ?> </h2>
    <p>Hola <?php echo $user->name ?> sabemos que te encuentras interesado en nuestro curso de <?php echo $course->name ?>,
    es por ello que queremos informarte que la inscripciones se encuentra abiertas.</p>
    <p> <strong>Fecha de inicio:</strong> <?php echo $startDate ?> <?php echo $startHour ?></p>
  </div>
</body>
