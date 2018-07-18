<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pulse_updates".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $pulse_id
 * @property integer $update_id
 *
 * @property Updates $update
 * @property Pulse $pulse
 * @property User $user
 */
class PulseUpdates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pulse_updates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'pulse_id', 'update_id'], 'required'],
            [['user_id', 'pulse_id', 'update_id'], 'integer'],
            [['update_id'], 'exist', 'skipOnError' => true, 'targetClass' => Updates::className(), 'targetAttribute' => ['update_id' => 'id']],
            [['pulse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pulse::className(), 'targetAttribute' => ['pulse_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'pulse_id' => 'Pulse ID',
            'update_id' => 'Update ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdate()
    {
        return $this->hasOne(Updates::className(), ['id' => 'update_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPulse()
    {
        return $this->hasOne(Pulse::className(), ['id' => 'pulse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
