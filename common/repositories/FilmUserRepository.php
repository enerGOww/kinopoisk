<?php


namespace common\repositories;

use yii\db\ActiveRecord;
use common\essence\FilmUser;
class FilmUserRepository
{
    private $innerRecord;

    public function __construct(FilmUser $innerRecord)
    {
        $this->innerRecord = $innerRecord;
    }

    public function findByIDs($filmId, $userId)
    {
        $object = $this->_findBy($this->innerRecord, ['film_id' => $filmId, 'user_id' => $userId]);
        return $object;
    }

    protected function _findBy(ActiveRecord $record, array $condition)
    {
        $object = $record::find()->where($condition)->limit(1)->one();
        return $object;
    }
}