<?php


namespace common\repositories;

use common\essence\WorldRating;
class WorldRatingRepository
{
    public function getAllWorldRatings ()
    {
        return WorldRating::find()->all();
    }
}