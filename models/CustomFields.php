<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "custom_fields".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $project_id
 * @property string $field_label
 * @property string $field_value
 * @property integer $checkbox
 * @property integer $is_active
 * @property integer $dashboard
 * @property string $date
 *
 * @property Users $user
 * @property Projects $project
 */
class CustomFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'custom_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'project_id', 'field_label', 'field_value', 'date'], 'required'],
            [['user_id', 'project_id', 'checkbox', 'is_active', 'dashboard'], 'integer'],
            [['field_value'], 'string'],
            [['date'], 'safe'],
            [['field_label'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
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
            'project_id' => 'Project ID',
            'field_label' => 'Field Label',
            'field_value' => 'Field Value',
            'checkbox' => 'Checkbox',
            'is_active' => 'Is Active',
            'dashboard' => 'Dashboard',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }
}
