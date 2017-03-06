<?php

namespace app\models;

use Yii;
use \app\models\base\PermissionRole as BasePermissionRole;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "permission_roles".
 */
class PermissionRole extends BasePermissionRole
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
