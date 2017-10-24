<?php

namespace Parcer\Repositories;

use App\Genre;
use App\Movie;
use App\MoviesGenre;

class ModelMovieRepository
{
    public function findAllMovies(){
        $movies = Movie::all();
        $genre_ids[] = [];

        foreach ($movies as $movie) {
            $genres = MoviesGenre::where('movie_id', $movie->id)->get();

            foreach ($genres as $i=>$genre_id) {
                $genre_ids[$i] = $genre_id->id;
            }
        }

        return $movies;
    }

    public function findMovie($id){
        $movie = Movie::find($id);
        $movieGenres = MoviesGenre::where('movie_id', $id)->get();
        $genres_name = [];

        foreach ($movieGenres as $movieGenre) {
            $genre_id = $movieGenre->id;
            $genre = Genre::where('genre_id', $genre_id)->get()->first();
            $genres_name = $genre->name;
        }

        if($movie !== null){
            $movie->setGenres($genres_name);
        }
        return $movie;
    }

    public function insertMovies($allMovies){
        $movies = $this->createMovies($allMovies);

        $genres[] = [];

        foreach ($movies as $movie) {
            $genres[] = $movie->getGenres();
        }

        for($i = 0; $i < count($movies); $i++) {
            $movieGenres = $genres[$i];

            foreach ($movieGenres as $movieGenre) {
                $genre = Genre::where('name', $movieGenre)->first();

                printf($genre->id . ' ' . $movies[$i]->id . ' ', PHP_EOL);

                MoviesGenre::create([
                    'movie_id' => $movies[$i]->id,
                    'genre_id' => $genre->id
                ]);
            }
        }
    }

    public function deleteMovie($id){
        $movieGenres = MoviesGenre::where('movie_id', $id)->get();
        foreach ($movieGenres as $movieGenre) {
            $movieGenre->delete();
        }

        $this->findMovie($id)->delete();
    }

    public function updateMovie($id){

    }

    private function createMovies($allMovies)
    {
        $movies = [];

        for($i = 0; $i < count($allMovies); $i++) {
            $model = Movie::create([
                'name' => $allMovies['titles'][$i],
                'image' => $allMovies['images'][$i],
                'year' => $allMovies['year'][$i],
                'country' => $allMovies['countries'][$i],
                'director' => $allMovies['directors'][$i],
                'starring' => $allMovies['starrings'][$i],
                'duration' => $allMovies['durations'][$i],
                'description' => $allMovies['description'][$i]
            ]);
            $model->setGenres($allMovies['genres'][$i]);
            $movies[] = $model;
        }
        return $movies;
    }
}