<?php

namespace common\essence;

use Yii;

/**
 * This is the model class for table "genre".
 *
 * @property int $id
 * @property string $description
 *
 * @property FilmGenre[] $filmGenres
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilmGenres()
    {
        return $this->hasMany(FilmGenre::className(), ['genre_id' => 'id']);
    }

    public function getFilm()
    {
        return $this->hasMany(Film::className(), ['id' => 'film_id'])
            ->viaTable('film_genre', ['genre_id' => 'id']);
    }
}
