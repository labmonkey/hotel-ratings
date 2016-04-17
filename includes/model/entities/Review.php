<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 */
class Review
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $rating;

    /**
     * @var string
     */
    private $message;

    /**
     * @var boolean
     */
    private $moderated;

    /**
     * @var \User
     */
    private $reviewer;

    /**
     * @var \Hotel
     */
    private $hotel;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     * @return Review
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Review
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set moderated
     *
     * @param boolean $moderated
     * @return Review
     */
    public function setModerated($moderated)
    {
        $this->moderated = $moderated;

        return $this;
    }

    /**
     * Get moderated
     *
     * @return boolean 
     */
    public function getModerated()
    {
        return $this->moderated;
    }

    /**
     * Set reviewer
     *
     * @param \User $reviewer
     * @return Review
     */
    public function setReviewer(\User $reviewer = null)
    {
        $this->reviewer = $reviewer;

        return $this;
    }

    /**
     * Get reviewer
     *
     * @return \User 
     */
    public function getReviewer()
    {
        return $this->reviewer;
    }

    /**
     * Set hotel
     *
     * @param \Hotel $hotel
     * @return Review
     */
    public function setHotel(\Hotel $hotel = null)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \Hotel 
     */
    public function getHotel()
    {
        return $this->hotel;
    }
}
