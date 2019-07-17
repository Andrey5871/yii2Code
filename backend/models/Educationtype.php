<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "educationType".
 *
 * @property int $idEducationType
 * @property string $name
 *
 * @property UserClientInfo[] $userClientInfos
 * @property Users[] $users
 */
class Educationtype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'educationType';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEducationType' => 'Id Education Type',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserClientInfos()
    {
        return $this->hasMany(UserClientInfo::className(), ['educationTypeId' => 'idEducationType']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['educationTypeId' => 'idEducationType']);
    }
}
