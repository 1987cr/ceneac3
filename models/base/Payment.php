<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "payments".
 *
 * @property integer $id
 * @property integer $preregister_id
 * @property double $amount
 * @property string $payment_type
 * @property integer $movements
 * @property string $payment_date
 * @property double $remaining_amount
 * @property string $comments
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\Preregisters $preregister
 * @property string $aliasModel
 */
abstract class Payment extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const PAYMENT_TYPE_D = 'D';
    const PAYMENT_TYPE_C = 'C';
    const PAYMENT_TYPE_E = 'E';
    const PAYMENT_TYPE_H = 'H';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments';
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
            [['preregister_id', 'amount', 'payment_type', 'movements', 'payment_date', 'remaining_amount', 'comments'], 'required'],
            [['preregister_id', 'movements'], 'integer'],
            [['amount', 'remaining_amount'], 'number'],
            [['payment_type', 'comments'], 'string'],
            [['payment_date'], 'safe'],
            [['preregister_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Preregistered::className(), 'targetAttribute' => ['preregister_id' => 'id']],
            ['payment_type', 'in', 'range' => [
                    self::PAYMENT_TYPE_D,
                    self::PAYMENT_TYPE_C,
                    self::PAYMENT_TYPE_E,
                    self::PAYMENT_TYPE_H,
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'preregister_id' => 'Preregister ID',
            'amount' => 'Amount',
            'payment_type' => 'Payment Type',
            'movements' => 'Movements',
            'payment_date' => 'Payment Date',
            'remaining_amount' => 'Remaining Amount',
            'comments' => 'Comments',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreregister()
    {
        return $this->hasOne(\app\models\Preregistered::className(), ['id' => 'preregister_id']);
    }




    /**
     * get column payment_type enum value label
     * @param string $value
     * @return string
     */
    public static function getPaymentTypeValueLabel($value){
        $labels = self::optsPaymentType();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column payment_type ENUM value labels
     * @return array
     */
    public static function optsPaymentType()
    {
        return [
            self::PAYMENT_TYPE_D => self::PAYMENT_TYPE_D,
            self::PAYMENT_TYPE_C => self::PAYMENT_TYPE_C,
            self::PAYMENT_TYPE_E => self::PAYMENT_TYPE_E,
            self::PAYMENT_TYPE_H => self::PAYMENT_TYPE_H,
        ];
    }

    public function getUserName()
    {
        $preregister = $this->hasOne(\app\models\Preregistered::className(), ['id' => 'preregister_id'])->one();

        $user = \app\models\User::find()
                        ->where(['id' => $preregister->user_id])
                        ->one();

        return $user;
    }

}
