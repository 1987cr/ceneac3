<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "courses".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $duration
 * @property integer $costos
 * @property integer $category_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\Categories $category
 * @property \app\models\InterestLists[] $interestLists
 * @property \app\models\Schedules[] $schedules
 * @property string $aliasModel
 */
abstract class Course extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courses';
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
            [['name', 'description', 'duration', 'costos', 'category_id'], 'required'],
            [['description'], 'string'],
            [['duration', 'category_id'], 'integer'],
            [['name', 'costos'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Category::className(), 'targetAttribute' => ['category_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'description' => 'Descripción',
            'duration' => 'Duración (horas)',
            'costos' => 'Costos',
            'category_id' => 'Categoría',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(\app\models\Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterestLists()
    {
        return $this->hasMany(\app\models\InterestList::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(\app\models\Schedule::className(), ['course_id' => 'id']);
    }




}
