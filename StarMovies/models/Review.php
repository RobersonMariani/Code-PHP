<?php

class Review
{
    private $id;
    private $rating;
    private $review;
    private $user_id;
    private $movie_id;
    public  $user;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of review
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set the value of review
     *
     * @return  self
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of movie_id
     */
    public function getMovie_id()
    {
        return $this->movie_id;
    }

    /**
     * Set the value of movie_id
     *
     * @return  self
     */
    public function setMovie_id($movie_id)
    {
        $this->movie_id = $movie_id;

        return $this;
    }
}

interface ReviewDAOInterface
{
    public function buildReview($data);
    public function create(Review $review);
    public function getMoviesReview($id);
    public function hasAlreadyReviewed($id, $userId);
    public function getRatingAverage($id);
}
