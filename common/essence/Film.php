<?php

namespace common\essence;

use Yii;
use yii\helpers\ArrayHelper;
use common\traits\ImageUploaderTrait;

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
 * @property double $rating
 * @property string $image
 * @property string $trailer_link
 * @property string $year
 *
 * @property Comment[] $comments
 * @property Rejeser $rejeser
 * @property WorldRating $worldRating
 * @property FilmActor[] $filmActors
 * @property FilmGenre[] $filmGenres
 */
class Film extends \yii\db\ActiveRecord
{
    use ImageUploaderTrait;
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
            [['rejeser_id', 'world_rating_id', 'size'], 'integer'],
            [['rating'], 'double'],
            [['title', 'country', 'slogan', 'image', 'trailer_link', 'year'], 'string', 'max' => 255],
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
            'year' => 'Year',
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

    public function getGenre()
    {
        return $this->hasMany(Genre::className(), ['id' => 'genre_id'])
            ->viaTable('film_genre', ['film_id' => 'id']);
    }

    public function getSelectedGenre()
    {
        $selectedIds = $this->getGenre()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedIds, 'id');
    }
    public function saveGenre($genre)
    {
        if (is_array($genre))
        {
            $this->clearCurrentGenre();
            foreach($genre as $genre_id)
            {
                $genre = Genre::findOne($genre_id);
                $this->link('genre', $genre);
            }
        }
    }
    public function clearCurrentGenre()
    {
        FilmGenre::deleteAll(['film_id'=>$this->id]);
    }

    public function getActor()
    {
        return $this->hasMany(Actor::className(), ['id' => 'actor_id'])
            ->viaTable('film_actor', ['film_id' => 'id']);
    }

    public function getSelectedActor()
    {
        $selectedIds = $this->getActor()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedIds, 'id');
    }
    public function saveActor($actor)
    {
        if (is_array($actor))
        {
            $this->clearCurrentActor();
            foreach($actor as $actor_id)
            {
                $actor = Actor::findOne($actor_id);
                $this->link('actor', $actor);
            }
        }
    }
    public function clearCurrentActor()
    {
        FilmActor::deleteAll(['film_id'=>$this->id]);
    }

    public function saveRejeser($rejeser)
    {
        $this->rejeser_id = $rejeser;
        return $this->save(false);
    }

    public function saveWorldRating($worldRating)
    {
        $this->world_rating_id = $worldRating;
        return $this->save(false);
    }

}
