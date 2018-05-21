<?php

class Movie
{
    private $title;
    private $year;

    public function __construct($title, $year)
    {
        $this->title = $title;
        $this->year = $year;
    }

    public function show()
    {
        echo "<b>$this->title</b> se estreno en $this->year<br>";
    }
}

class MovieList
{
    private $list = [];

    public function add(Movie $movie)
    {
        $this->list[] = $movie;
    }

    public function get($index)
    {
        return $this->list[$index];
    }

    public function count()
    {
        return count($this->list);
    }
}

interface iIterator
{
    public function current();

    public function hasNext();

    public function next();

    public function first();

    public function last();
}

class MovieListIterator implements iIterator
{
    private $index;
    private $movieList;

    public function __construct(MovieList $movieList)
    {
        $this->index = 0;
        $this->movieList = $movieList;
    }

    public function current()
    {
        return $this->movieList->get($this->index);
    }

    public function hasNext()
    {
        return ($this->movieList->count() - 1) >= $this->index;
    }

    public function next()
    {
        $element = $this->current();
        $this->index++;

        return $element;

    }

    public function first()
    {
        return $this->movieList->get(0);
    }

    public function last()
    {
        $lastIndex = $this->movieList->count() - 1;
        return $this->movieList->get($lastIndex);
    }

}

// =====================================================================================

$movieList = new MovieList();
$movieList->add(new Movie('La Era del Hielo', 2002));
$movieList->add(new Movie('La Era del Hielo 2', 2006));
$movieList->add(new Movie('La Era del Hielo 3', 2009));
$movieList->add(new Movie('La Era del Hielo 4', 2012));
$movieList->add(new Movie('The Avengers', 2012));
$movieList->add(new Movie('The Avengers 2: Age of Ultron', 2015));

$movieListIterator = new MovieListIterator($movieList);

$lastMovie = $movieListIterator->last();
$lastMovie->show();

$firstMovie = $movieListIterator->first();
$firstMovie->show();

echo "<hr>";

while($movieListIterator->hasNext())
{
    $movie = $movieListIterator->next();
    $movie->show();
}

