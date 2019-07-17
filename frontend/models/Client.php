<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_client_info".
 *
 * @property int $client_id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $brithDay
 * @property string $gender
 * @property int $cityId
 * @property int $nameEducationId
 * @property int $educationLevel
 * @property int $educationTypeId
 * @property string $email
 * @property string $phone
 * @property int $user_id_add
 * @property string $createTime
 * @property string $updateTime
 * @property int $statusId
 * @property string $sumOrder
 * @property string $sumUsers
 *
 * @property Users $userIdAdd
 * @property EducationType $educationType
 * @property City $city
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_client_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'brithDay', 'gender', 'cityId', 'nameEducationId', 'educationLevel', 'educationTypeId', 'phone', 'user_id_add', 'createTime', 'updateTime', 'statusId', 'sumOrder', 'sumUsers'], 'required'],
            [['brithDay', 'createTime', 'updateTime'], 'safe'],
            [['cityId', 'nameEducationId', 'educationLevel', 'educationTypeId', 'user_id_add', 'statusId'], 'integer'],
            [['sumOrder', 'sumUsers'], 'number'],
            [['name', 'surname', 'patronymic', 'email'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 20],
            [['phone'], 'string', 'max' => 32]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'client_id' => 'Client ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'brithDay' => 'Brith Day',
            'gender' => 'Gender',
            'cityId' => 'City ID',
            'nameEducationId' => 'Name Education ID',
            'educationLevel' => 'Education Level',
            'educationTypeId' => 'Education Type ID',
            'email' => 'Email',
            'phone' => 'Phone',
            'user_id_add' => 'User Id Add',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'statusId' => 'Status ID',
            'sumOrder' => 'Sum Order',
            'sumUsers' => 'Sum Users',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdAdd()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id_add']);
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
}
