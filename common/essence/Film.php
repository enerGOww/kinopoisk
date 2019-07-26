<?php

namespace common\essence;

use Yii;

/**
 * This is the model class for table "film".
 *
 * @property int $id
 * @property string $title
 * @property string $country
 * @property string $slogan
 * @property int $rejeser_id
 * @property int $world_rating_id
 * @property int $size
 * @property int $rating
 * @property string $image
 * @property string $trailer_link
 *
 * @property Comment[] $comments
 * @property Rejeser $rejeser
 * @property WorldRating $worldRating
 * @property FilmActor[] $filmActors
 * @property FilmGenre[] $filmGenres
 */
class Film extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'film';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rejeser_id', 'world_rating_id', 'size', 'rating'], 'integer'],
            [['title', 'country', 'slogan', 'image', 'trailer_link'], 'string', 'max' => 255],
            [['rejeser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rejeser::className(), 'targetAttribute' => ['rejeser_id' => 'id']],
            [['world_rating_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorldRating::className(), 'targetAttribute' => ['world_rating_id' => 'id']],
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
            'country' => 'Country',
            'slogan' => 'Slogan',
            'rejeser_id' => 'Rejeser ID',
            'world_rating_id' => 'World Rating ID',
            'size' => 'Size',
            'rating' => 'Rating',
            'image' => 'Image',
            'trailer_link' => 'Trailer Link',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['film_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRejeser()
    {
        return $this->hasOne(Rejeser::className(), ['id' => 'rejeser_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorldRating()
    {
        return $this->hasOne(WorldRating::className(), ['id' => 'world_rating_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilmActors()
    {
        return $this->hasMany(FilmActor::className(), ['film_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilmGenres()
    {
        return $this->hasMany(FilmGenre::className(), ['film_id' => 'id']);
    }
}
