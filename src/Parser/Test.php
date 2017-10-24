<?php

namespace Parcer;

use App\Movie;
use Parcer\Entity\Movie as MovieEntity;
use Parcer\Repositories\ModelMovieRepository;
use Parcer\Request\GetMovieResource;

class Test
{
    private $movieRepository, $getMovieResource;

    public function __construct(ModelMovieRepository $movieRepository, GetMovieResource $getMovieResource)
    {
        $this->movieRepository = $movieRepository;
        $this->getMovieResource = $getMovieResource;
    }

    public function getAndInsertMovies()
    {
        $body = $this->getMovieResource->getResourceBody('http://kinokrad.co/zombi-i-mertvecy/');
        $maxPageNumber = $this->getMovieResource->getMoviesMaxPageNumber($body);

        $this->movieRepository->insertMovies($this->getAllPageMovies($body));
    }

    public function getAllPageMovies($body)
    {
        return [
            'titles' => $this->getMovieResource->getMoviesTitle($body),
            'images' => $this->getMovieResource->getMoviesImages($body),
            'year' => $this->getMovieResource->getMoviesYear($body),
            'countries' => $this->getMovieResource->getMoviesCountry($body),
            'genres' => $this->getMovieResource->getMoviesGenre($body),
            'durations' => $this->getMovieResource->getMoviesDuration($body),
            'directors' => $this->getMovieResource->getMoviesDirector($body),
            'starrings' => $this->getMovieResource->getMoviesStarring($body),
            'nextPage' => $this->getMovieResource->getNextMoviesPage($body),
            'description' => $this->getMovieResource->getMoviesDescription($body)
        ];
    }

    public function moviesToEntity($allMovies)
    {
        $movieObj = [];
        for($i = 0; $i < count($allMovies); $i++) {
            $movieObj[] = new MovieEntity(
                $allMovies['titles'][$i],
                $allMovies['images'][$i],
                $allMovies['year'][$i],
                $allMovies['countries'][$i],
                $allMovies['genres'][$i],
                $allMovies['directors'][$i],
                $allMovies['starrings'][$i],
                $allMovies['durations'][$i],
                $allMovies['description'][$i]
            );
        }
        return $movieObj;
    }
}