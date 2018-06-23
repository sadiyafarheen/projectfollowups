<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "updates".
 *
 * @property integer $id
 * @property string $update_type
 * @property string $update_text
 * @property string $response
 * @property string $assigned_to
 * @property integer $is_close
 * @property string $due_date
 * @property string $date
 *
 * @property ProjectUpdates[] $projectUpdates
 */
class Updates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'updates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['update_type', 'update_text', 'date'], 'required'],
            [['update_text', 'response', 'assigned_to'], 'string'],
            [['is_close'], 'integer'],
            [['due_date', 'date'], 'safe'],
            [['update_type'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'update_type' => 'Update Type',
            'update_text' => 'Update Text',
            'response' => 'Response',
            'assigned_to' => 'Follow up with',
            'is_close' => 'Is Close',
            'date' => 'Date',
            'due_date' => 'Due Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectUpdates()
    {
        return $this->hasMany(ProjectUpdates::className(), ['update_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryUpdates()
    {
        return $this->hasMany(CategoryUpdates::className(), ['update_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectUpdate()
    {
        return $this->hasOne(ProjectUpdates::className(), ['update_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryUpdate()
    {
        return $this->hasOne(CategoryUpdates::className(), ['update_id' => 'id']);
    }
}
