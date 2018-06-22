<?php

namespace app\models;

/**
 * This is the model class for table "projects".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $title
 * @property string $assigned_to
 * @property string $phase
 * @property string $status
 * @property string $start_date
 * @property string $end_date
 * @property string $custom_field
 * @property string $more_info
 * @property integer $rating
 * @property integer $priority
 * @property integer $is_hide
 * @property integer $is_focus
 * @property integer $sort_order
 * @property integer $percentage_complete
 * @property integer $stake_holder
 *
 * @property Users $user
 * @property Categories $category
 * @property Tasks[] $tasks
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id', 'title'], 'required'],
            [['user_id', 'category_id', 'is_focus', 'sort_order'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['more_info', 'is_hide'], 'string'],
            [['title', 'assigned_to', 'status'], 'string', 'max' => 100],
            [['percentage_complete', 'stake_holder'], 'string', 'max' => 100],
            [['custom_field'], 'string', 'max' => 50],
            [['phase', 'priority', 'rating'], 'string', 'max' => 10],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Category ID',
            'title' => 'Title',
            'assigned_to' => 'Assigned To',
            'phase' => 'Phase/Sprint',
            'status' => 'Status',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'custom_field' => 'Quick Note',
            'more_info' => 'More Info',
            'rating' => 'Custom',
            'priority' => 'Priority',
            'is_focus' => '',
            'is_hide' => 'Hide',
            'sort_order' => 'Sort By',
            'percentage_complete' => '% Completed',
            'stake_holder' => 'Stakeholder',
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
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Ratings::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscussions()
    {
        return $this->hasMany(Discussions::className(), ['project_id' => 'id'])->orderBy('id desc');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPupdates()
    {
        return $this->hasMany(ProjectUpdates::className(), ['project_id' => 'id'])->orderBy('id desc');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCfields()
    {
        return $this->hasMany(CustomFields::className(), ['project_id' => 'id'])->orderBy('id desc');
    }
}
