<?php

namespace Parcer\Request;


use GuzzleHttp\Client;

class GetMovieResource
{
    public function getResourceBody($path){
        $client = new Client();
        $resource = $client->request('GET', $path);
        $body = $resource->getBody()->getContents();
        return $body;
    }

    public function getMoviesTitle($subject){
        preg_match_all('/<h2><a href=".*?">(.*?)<\/a><\/h2>/msi', $subject, $match);
        return $match[1];
    }

    public function getMoviesImages($subject){
        preg_match_all('/postr" src="(.*?)"/msi', $subject, $match);
        return $match[1];
    }

    public function getMoviesYear($subject){
        preg_match_all('/>Год.*?\/span>:.*?>(.*?)</msi', $subject, $match);
        return $match[1];
    }

    public function getMoviesCountry($subject){
        preg_match_all('/>Страна.*?\/span>:.*?>(.*?)</msi', $subject, $match);
        return $match[1];
    }

    public function getMoviesGenre($subject){
        preg_match_all('/>Жанр.*?\/span>:.*?>(.*?)<\/span>/msi', $subject, $match);
        $genres = $match;
        $movies_genre[][] = '';

        for($i = 0; $i < count($genres[1]); $i++)
        {
            preg_match_all('/<a.*?>(.*?)<\/a>/msi', $genres[1][$i], $match);

            $count = 0;

            foreach ($match[1] as $matches) {
                $movies_genre[$i][$count] = $matches;
                $count++;
            }
        }

        return $movies_genre;
    }

    public function getMoviesDuration($subject){
        preg_match_all('/>Длительность.*?\/span>:.*?>(.*?)<\/span>/msi', $subject, $match);
        return $match[1];
    }

    public function getMoviesDirector($subject){
        preg_match_all('/>Режиссер.*?\/span>:.*?>(.*?)</msi', $subject, $match);
        return $match[1];
    }

    public function getMoviesStarring($subject){
        preg_match_all('/"janrshort".*?>В ролях.*?\/span>.*?>(.*?)<\/span></msi', $subject, $match);
        return $match[1];
    }

    public function getNextMoviesPage($subject){
        preg_match_all('/navcent".*?<\/div>.*?href="(.*?)"/msi', $subject, $match);

        $filtered = array_filter($match);
        if(!empty($filtered)) {
            return $match[1];
        }
        else{
            return false;
        }
    }

    public function getMoviesMaxPageNumber($subject)
    {
        preg_match_all('/navcent".*?<a.*?>(.*?)<\/div>/msi', $subject, $match);
        $pages = $match;

        preg_match_all('/<a.*?>(.*?)<\/a>/msi', $pages[1][0], $match);
        $maxPageNumber = $match;

        return $maxPageNumber[1][
            (count($maxPageNumber[1]) - 1)
        ];
    }

    public function getMoviesDescription($subject)
    {
        preg_match_all('/shorttext">\n(.*?)\n/msi', $subject, $match);
        return $match[1];
    }
}