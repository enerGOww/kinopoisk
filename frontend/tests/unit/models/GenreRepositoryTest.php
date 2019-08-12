<?php


namespace frontend\tests\unit\models;

use Codeception\Test\Unit;
use common\essence\Film;
use common\fixtures\CommentFixture;
use common\fixtures\FilmFixture;
use common\fixtures\FilmActorFixture;
use common\fixtures\FilmGenreFixture;
use common\fixtures\GenreFixture;
use common\fixtures\ActorFixture;
use common\fixtures\WorldRatingFixture;
use common\fixtures\UserFixture;
use common\fixtures\RejeserFixture;
use common\repositories\GenreRepository;
use common\essence\Genre;
use Yii;

class GenreRepositoryTest extends Unit
{
    protected $tester;

    protected $genreRepository;
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
        $this->genreRepository = Yii::createObject(GenreRepository::class);
    }

    public function testGetDescriptionById()
    {
        $genre1 = Genre::findOne(['id' => $this->tester->grabFixture('genre', 0)]);
        $genre2 = Genre::findOne(['id' => $this->tester->grabFixture('genre', 1)]);
        $genre11 = $this->genreRepository->getDescriptionById(1);
        $genre22 = $this->genreRepository->getDescriptionById(2);
        $this->assertEquals($genre1->description, $genre11);
        $this->assertEquals($genre2->description, $genre22);
    }

    public function testGetGenresForActorRejeserFromFilms()
    {
        {
            $arrGenrePriority = [1];
            $genre = Genre::findOne(['id' => $this->tester->grabFixture('film', 1)]);
            $genre2 = $this->genreRepository->getGenresForActorRejeserFromFilms($arrGenrePriority);
            $this->assertEquals($genre->id, $genre2[0]['id']);
        }
    }

    public function testGetAllGenre()
    {
        $genres = Genre::find()->all();
        $genres2 = $this->genreRepository->getAllGenre();
        $this->assertEquals($genres, $genres2);
    }

    public function testGetFilmsWithGenre()
    {
        $film1 = Film::findOne(['title' => $this->tester->grabFixture('film', 0)]);
        $film2 = Film::findOne(['title' => $this->tester->grabFixture('film', 1)]);
        $films = $this->genreRepository->getFilmsWithGenre(1)->all();
        $this->assertEquals($film1->title, $films[0]['title']);
        $this->assertEquals($film2->title, $films[1]['title']);
    }
}
