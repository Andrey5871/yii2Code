<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property int $region_id
 * @property string $name
 *
 * @property Education[] $educations
 * @property Universitet[] $universitets
 * @property UserClientInfo[] $userClientInfos
 * @property Users[] $users
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'name'], 'required'],
            [['region_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Region ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducations()
    {
        return $this->hasMany(Education::className(), ['cityId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUniversitets()
    {
        return $this->hasMany(Universitet::className(), ['idCity' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserClientInfos()
    {
        return $this->hasMany(UserClientInfo::className(), ['cityId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['cityId' => 'id']);
    }
}
