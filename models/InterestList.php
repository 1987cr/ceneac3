<?php

namespace app\models;

use Yii;
use \app\models\base\InterestList as BaseInterestList;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "interest_lists".
 */
class InterestList extends BaseInterestList
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
