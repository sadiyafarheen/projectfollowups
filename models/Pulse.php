<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pulse".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $project_id
 * @property string $how_you_feel
 * @property string $about_project_health
 * @property string $any_notes
 * @property string $action_taken
 * @property integer $is_agenda
 * @property string $date
 */
class Pulse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pulse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'project_id', 'how_you_feel', 'about_project_health', 'any_notes', 'action_taken', 'is_agenda'], 'required'],
            [['user_id', 'project_id', 'is_agenda'], 'integer'],
            [['how_you_feel', 'about_project_health', 'any_notes', 'action_taken'], 'string'],
            [['date'], 'safe'],
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
            'how_you_feel' => 'How You Feel',
            'about_project_health' => 'About Project Health',
            'any_notes' => 'Any Notes',
            'action_taken' => 'Action Taken',
            'is_agenda' => 'Is Agenda',
            'date' => 'Date',
        ];
    }
}
