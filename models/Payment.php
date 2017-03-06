<?php

namespace app\models;

use Yii;
use \app\models\base\Payment as BasePayment;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "payments".
 */
class Payment extends BasePayment
{

public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
             parent::rules(),
             [
                  # custom validation rules
             ]
        );
    }
}
