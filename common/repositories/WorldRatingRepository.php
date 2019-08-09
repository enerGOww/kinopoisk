<?php


namespace common\repositories;

use common\essence\WorldRating;
class WorldRatingRepository
{
    public function getIAllWorldRatings ()
    {
        return WorldRating::find()->all();
    }
}