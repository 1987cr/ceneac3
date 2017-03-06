<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "registers".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $schedule_id
 * @property integer $asistence
 * @property integer $asistence_number
 * @property string $personal_bill
 * @property string $comments
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\Schedules $schedule
 * @property \app\models\User $user
 * @property string $aliasModel
 */
abstract class Registered extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registers';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'schedule_id', 'asistence', 'asistence_number', 'personal_bill', 'comments'], 'required'],
            [['user_id', 'schedule_id', 'asistence', 'asistence_number'], 'integer'],
            [['personal_bill', 'comments'], 'string'],
            [['schedule_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Schedule::className(), 'targetAttribute' => ['schedule_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\User::className(), 'targetAttribute' => ['user_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'schedule_id' => 'Schedule ID',
            'asistence' => 'Asistence',
            'asistence_number' => 'Asistence Number',
            'personal_bill' => 'Personal Bill',
            'comments' => 'Comments',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedule()
    {
        return $this->hasOne(\app\models\Schedule::className(), ['id' => 'schedule_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }




}
