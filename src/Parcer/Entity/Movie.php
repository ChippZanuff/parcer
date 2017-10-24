<?php

namespace Parcer\Entity;


use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $name, $year, $country, $genre, $director, $starring, $duration, $description, $image;

    public function __construct($name, $image, $year, $country, $genre, $director, $starring, $duration, $description)
    {
        $this->name = $name;
        $this->year = $year;
        $this->country = $country;
        $this->director = $director;
        $this->starring = $starring;
        $this->duration = $duration;
        $this->description = $description;
        $this->image = $image;
        $this->genre = $genre;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @return string
     */
    public function getStarring()
    {
        return $this->starring;
    }

    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }
}