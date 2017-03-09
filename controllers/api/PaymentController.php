<?php
/**
 * /home/criera/Projects/ceneac_yii/runtime/giiant/f197ab8e55d1e29a2dea883e84983544
 *
 * @package default
 */


namespace app\controllers\api;

/**
 * This is the class for REST controller "PaymentController".
 */
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class PaymentController extends \yii\rest\ActiveController
{
	public $modelClass = 'app\models\Payment';
}
