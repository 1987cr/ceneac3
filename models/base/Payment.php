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
 * @property string $payment_date
 * @property double $remaining_amount
 * @property string $comments
 * @property string $client_bank
 * @property string $reference_number
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
    const PAYMENT_TYPE_DEPOSITO = 'DEPOSITO';
    const PAYMENT_TYPE_DEBITO = 'DEBITO';
    const PAYMENT_TYPE_CREDITO = 'CREDITO';
    const PAYMENT_TYPE_EFECTIVO = 'EFECTIVO';
    const PAYMENT_TYPE_TRANSFERENCIA = 'TRANSFERENCIA';
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
            [['preregister_id', 'amount', 'payment_type', 'payment_date', 'remaining_amount', 'comments'], 'required'],
            [['preregister_id'], 'integer'],
            [['amount', 'remaining_amount'], 'number'],
            [['payment_type', 'comments', 'client_bank', 'reference_number'], 'string'],
            [['payment_date'], 'safe'],
            [['preregister_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Preregistered::className(), 'targetAttribute' => ['preregister_id' => 'id']],
            ['payment_type', 'in', 'range' => [
                    self::PAYMENT_TYPE_DEPOSITO,
                    self::PAYMENT_TYPE_DEBITO,
                    self::PAYMENT_TYPE_CREDITO,
                    self::PAYMENT_TYPE_EFECTIVO,
                    self::PAYMENT_TYPE_TRANSFERENCIA,
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
            'preregister_id' => 'Preinscrito',
            'amount' => 'Cantidad',
            'payment_type' => 'Tipo de pago',
            'client_bank' => 'Banco Cliente',
            'reference_number' => 'Numero de referencia',
            'payment_date' => 'Fecha de pago',
            'remaining_amount' => 'Monto restante',
            'comments' => 'Comentarios',
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
            self::PAYMENT_TYPE_DEBITO => self::PAYMENT_TYPE_DEBITO,
            self::PAYMENT_TYPE_DEPOSITO => self::PAYMENT_TYPE_DEPOSITO,
            self::PAYMENT_TYPE_CREDITO => self::PAYMENT_TYPE_CREDITO,
            self::PAYMENT_TYPE_EFECTIVO => self::PAYMENT_TYPE_EFECTIVO,
            self::PAYMENT_TYPE_TRANSFERENCIA => self::PAYMENT_TYPE_TRANSFERENCIA,
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
