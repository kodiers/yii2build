<?php

namespace frontend\models;

use Yii;
use common\models\User;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $birthdate
 * @property integer $gender_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Gender $gender
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'gender_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'gender_id'], 'integer'],
            [['first_name', 'last_name'], 'string'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['user_id'], 'unique'],
            [['gender_id'], 'in', 'range' => array_keys($this->getGenderList())],
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'birthdate' => 'Birthdate',
            'gender_id' => 'Gender ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'genderName' => Yii::t('app', 'Gender'),
            'userLink' => Yii::t('app', 'User'),
            'profileIdLink' => Yii::t('app', 'Profile'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['id' => 'gender_id']);
    }
    /**
     * behaviors to control time stamp, don't forget to use statement for expression
     *
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * return Gender name
     */
    public function getGenderName()
    {
        return $this->gender->gender_name;
    }
    /**
     * get list of gender for dropdown
     */
    public static function getGenderList()
    {
        $droptions = Gender::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'gender_name');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /**
     * @get Username
     */
    public function getUsername()
    {
        return $this->user->username;
    }
    /**
     * @get UserID
     */
    public function getUserId()
    {
        return $this->user ? $this->user->id : 'none';
    }
    /**
     * @get UserLink
     */
    public function getUserLink()
    {
        $url = Url::to(['user/view', 'id' => $this->UserId]);
        $options = [];
        return Html::a($this->getUsername(), $url, $options);
    }
    /**
     * @getProfileLInk
     */
    public function getProfileIdLink()
    {
        $url = Url::to(['profile/update', $id = $this->id]);
        $options = [];
        return Html::a($this->id, $url, $options);
    }

    /**
     * Fixes yii/jui/DatePicker format differences for MySQL date type
     */
    public function beforeValidate()
    {
        if ($this->birthdate != null) {
            $new_date_format = date('Y-m-d', strtotime($this->birthdate));
            $this->birthdate = $new_date_format;
        }
        return parent::beforeValidate();
    }
}
