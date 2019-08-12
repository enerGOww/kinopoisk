<?php

namespace common\essence;

use common\traits\ImageUploaderTrait;
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
 * @property string $name
 *
 * @property Comment[] $comments
 * @property FilmActor[] $filmActors
 */
class Actor extends \yii\db\ActiveRecord
{
    use ImageUploaderTrait;
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
            [['year', 'name'], 'safe'],
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
            'name' => 'Name',
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

    public function getAllFilms()
    {
        return $this->hasMany(Genre::className(), ['id' => 'film_id'])
            ->viaTable('film_actor', ['actor_id' => 'id']);
    }
}
