<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "instructors".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $schedule_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\Schedules $schedule
 * @property \app\models\User $user
 * @property string $aliasModel
 */
abstract class Instructor extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instructors';
    }


    /**
     * @inheritdoc
     */
    // public function behaviors()
    // {
    //     return [
    //         [
    //             'class' => TimestampBehavior::className(),
    //         ],
    //     ];
    // }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'schedule_id'], 'required'],
            [['user_id', 'schedule_id'], 'integer'],
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

    public function getScheduleName()
    {
        $schedule = $this->hasOne(\app\models\Schedule::className(), ['id' => 'schedule_id'])->one();

        $course = \app\models\Course::find()
                        ->where(['id' => $schedule->course_id])
                        ->one();

        return $course;
    }

}
