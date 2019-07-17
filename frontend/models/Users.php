<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $user_id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $gender
 * @property string $brithDay
 * @property int $cityId
 * @property int $nameEducationId
 * @property int $educationLevel
 * @property int $educationTypeId
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property string $createTime
 * @property string $updateTime
 * @property string $hashSession
 * @property int $groups
 *
 * @property UserClientInfo[] $userClientInfos
 * @property EducationType $educationType
 * @property City $city
 * @property Education $nameEducation
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'gender', 'brithDay', 'cityId', 'nameEducationId', 'educationLevel', 'educationTypeId', 'password', 'email', 'phone', 'createTime', 'updateTime', 'hashSession', 'groups'], 'required'],
            [['brithDay', 'createTime', 'updateTime'], 'safe'],
            [['cityId', 'nameEducationId', 'educationLevel', 'educationTypeId', 'groups'], 'integer'],
            [['name', 'surname', 'patronymic', 'password', 'hashSession'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 10],
            [['email'], 'string', 'max' => 30],
            [['phone'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'gender' => 'Gender',
            'brithDay' => 'Brith Day',
            'cityId' => 'City ID',
            'nameEducationId' => 'Name Education ID',
            'educationLevel' => 'Education Level',
            'educationTypeId' => 'Education Type ID',
            'password' => 'Password',
            'email' => 'Email',
            'phone' => 'Phone',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'hashSession' => 'Hash Session',
            'groups' => 'Groups',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserClientInfos()
    {
        return $this->hasMany(UserClientInfo::className(), ['user_id_add' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducationType()
    {
        return $this->hasOne(EducationType::className(), ['idEducationType' => 'educationTypeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'cityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNameEducation()
    {
        return $this->hasOne(Education::className(), ['id' => 'nameEducationId']);
    }
}
