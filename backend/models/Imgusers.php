<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imgUsers".
 *
 * @property int $id
 * @property string $name
 * @property int $idUsers
 *
 * @property Users $users
 */
class Imgusers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imgUsers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'idUsers'], 'required'],
            [['idUsers'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'idUsers' => 'Id Users',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'idUsers']);
    }
}
