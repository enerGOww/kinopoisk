<?php

use Codeception\Test\Unit;
use common\fixtures\CommentFixture;
use common\fixtures\FilmFixture;
use common\fixtures\FilmActorFixture;
use common\fixtures\FilmGenreFixture;
use common\fixtures\GenreFixture;
use common\fixtures\ActorFixture;
use common\fixtures\WorldRatingFixture;
use common\fixtures\UserFixture;
use common\fixtures\RejeserFixture;
use frontend\tests\UnitTester;
use common\repositories\FilmRepository;
use common\essence\Film;
class FilmRepositoryTest extends Unit
{
    /* @var UnitTester */
    protected $tester;

    protected $filmRepository;
    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ],
            'film' => [
                'class' => FilmFixture::class,
                'dataFile' => codecept_data_dir() . 'film.php'
            ],
            'comment' => [
                'class' => CommentFixture::class,
                'dataFile' => codecept_data_dir() . 'comment.php'
            ],
            'genre' => [
                'class' => GenreFixture::class,
                'dataFile' => codecept_data_dir() . 'genre.php'
            ],
            'world_rating' => [
                'class' => WorldRatingFixture::class,
                'dataFile' => codecept_data_dir() . 'world_rating.php'
            ],
            'film_actor' => [
                'class' => FilmActorFixture::class,
                'dataFile' => codecept_data_dir() . 'film_actor.php'
            ],

            'film_genre' => [
                'class' => FilmGenreFixture::class,
                'dataFile' => codecept_data_dir() . 'film_genre.php'
            ],

            'actor' => [
                'class' => ActorFixture::class,
                'dataFile' => codecept_data_dir() . 'actor.php'
            ],

            'rejeser' => [
                'class' => RejeserFixture::class,
                'dataFile' => codecept_data_dir() . 'rejeser.php'
            ],
        ]);
        $this->filmRepository = Yii::createObject(FilmRepository::class);
    }

    public function testGetFilmsLikeThisWithPriority()
    {
        $arrFilmPriority = [1];
        $film = Film::findOne(['id' => $this->tester->grabFixture('film', 1)]);
        $film2 = $this->filmRepository->getFilmsLikeThisWithPriority($arrFilmPriority);
        $this->assertEquals($film->id, $film2[0]['id']);
    }
}