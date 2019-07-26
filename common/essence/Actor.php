<?php

namespace common\essence;

use Yii;

/**
 * This is the model class for table "actor".
 *
 * @property int $id
 * @property string $year
 * @property string $place
 * @property int $height
 * @property string $reward
 * @property string $image
 *
 * @property Comment[] $comments
 * @property FilmActor[] $filmActors
 */
class Actor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'actor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year'], 'safe'],
            [['height'], 'integer'],
            [['place', 'reward', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Year',
            'place' => 'Place',
            'height' => 'Height',
            'reward' => 'Reward',
            'image' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['actor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilmActors()
    {
        return $this->hasMany(FilmActor::className(), ['actor_id' => 'id']);
    }
}
