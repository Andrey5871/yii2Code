<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $minDesc
 * @property string $description
 * @property string $img
 * @property string $dateCreate
 * @property string $dateUpdate
 * @property int $idUser
 *
 * @property Users $user
 * @property View[] $views
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'minDesc', 'description', 'idUser'], 'required'],
            [['description'], 'string'],
            [['dateCreate', 'dateUpdate'], 'safe'],
            [['idUser'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['minDesc', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'minDesc' => 'Min Desc',
            'description' => 'Description',
            'img' => 'Img',
            'dateCreate' => 'Date Create',
            'dateUpdate' => 'Date Update',
            'idUser' => 'Id User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViews()
    {
        return $this->hasMany(View::className(), ['idNews' => 'id']);
    }
}
