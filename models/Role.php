<?php

namespace app\models;

use Yii;
use \app\models\base\Role as BaseRole;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "roles".
 */
class Role extends BaseRole
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
