<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view".
 *
 * @property int $id
 * @property int $idUser
 * @property int $idNews
 * @property string $dateView
 *
 * @property News $news
 * @property Users $user
 */
class View extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'idNews', 'dateView'], 'required'],
            [['idUser', 'idNews'], 'integer'],
            [['dateView'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUser' => 'Id User',
            'idNews' => 'Id News',
            'dateView' => 'Date View',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'idNews']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'idUser']);
    }
}
