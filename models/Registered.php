<?php

namespace app\models;

use Yii;
use \app\models\base\Registered as BaseRegistered;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "registers".
 */
class Registered extends BaseRegistered
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
