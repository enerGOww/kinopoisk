<?php

namespace common\essence;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $text
 * @property int $rejeser_id
 * @property int $film_id
 * @property int $actor_id
 *
 * @property Actor $actor
 * @property Film $film
 * @property Rejeser $rejeser
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rejeser_id', 'film_id', 'actor_id'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['actor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Actor::className(), 'targetAttribute' => ['actor_id' => 'id']],
            [['film_id'], 'exist', 'skipOnError' => true, 'targetClass' => Film::className(), 'targetAttribute' => ['film_id' => 'id']],
            [['rejeser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rejeser::className(), 'targetAttribute' => ['rejeser_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'rejeser_id' => 'Rejeser ID',
            'film_id' => 'Film ID',
            'actor_id' => 'Actor ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActor()
    {
        return $this->hasOne(Actor::className(), ['id' => 'actor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilm()
    {
        return $this->hasOne(Film::className(), ['id' => 'film_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRejeser()
    {
        return $this->hasOne(Rejeser::className(), ['id' => 'rejeser_id']);
    }
}
