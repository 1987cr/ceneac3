<?php

namespace app\models;

use Yii;
use \app\models\base\Instructor as BaseInstructor;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "instructors".
 */
class Instructor extends BaseInstructor
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
