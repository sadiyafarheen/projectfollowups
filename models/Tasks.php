<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $project_id
 * @property string $title
 * @property string $assigned_to
 * @property string $phase
 * @property string $status
 * @property string $start_date
 * @property string $end_date
 * @property string $custom_field
 * @property string $more_info
 * @property integer $rating
 *
 * @property Projects $project
 * @property Users $user
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'project_id', 'title'], 'required'],
            [['user_id', 'project_id'], 'integer'],
            [['rating'], 'safe'],
            [['start_date', 'end_date'], 'safe'],
            [['more_info'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['assigned_to', 'status', 'custom_field'], 'string', 'max' => 100],
            [['phase'], 'string', 'max' => 10],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
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
            'project_id' => 'Project ID',
            'title' => 'Task',
            'assigned_to' => 'Assigned To',
            'phase' => 'Phase',
            'status' => 'Status',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'custom_field' => 'Custom Field',
            'more_info' => 'More Info',
            'rating' => 'Rating',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
