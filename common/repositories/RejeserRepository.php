<?php


namespace common\repositories;

use common\essence\Rejeser;
class RejeserRepository
{
    public  function getAllRejesers()
    {
        return Rejeser::find()->all();
    }
}