<?php


namespace common\repositories;

use common\essence\Actor;
class ActorRepository
{
    public function getAllActors()
    {
        return Actor::find()->all();
    }
}