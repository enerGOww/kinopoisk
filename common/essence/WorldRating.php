<?php

namespace common\essence;

use common\traits\ImageUploaderTrait;
use Yii;

/**
 * This is the model class for table "world_rating".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 *
 * @property Film[] $films
 */
class WorldRating extends \yii\db\ActiveRecord
{
    use ImageUploaderTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'world_rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'image'], 'string', 'max' => 255],
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
            'image' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilms()
    {
        return $this->hasMany(Film::className(), ['world_rating_id' => 'id']);
    }
}
