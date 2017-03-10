<?php

namespace app\models;

use Yii;
use \app\models\base\Backup as BaseBackup;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "backups".
 */
class Backup extends BaseBackup
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
