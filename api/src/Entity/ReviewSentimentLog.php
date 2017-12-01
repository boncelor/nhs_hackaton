<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class ReviewSentimentLog
{
    /**
     * @var int The sentiment log Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Review", inversedBy="review_sentiment_logs")
     * @ORM\JoinColumn(name="review_id", referencedColumnName="id")
     */
    public $review;

    /**
     * @var float Score
     *
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    public $score;

    /**
     * @var string The sentiment of this log
     *
     * @ORM\Column(type="text")
     */
    public $sentiment;

    public function __construct(Review $review, int $score, string $sentiment) {
        $this->setReview($review);
        $this->setScore($score);
        $this->setSentiment($sentiment);
    }

    public function setReview(Review $review){
        $this->review = $review;
        return $this;
    }

    public function getReview(){
        return $this->review;
    }

    public function setScore(int $score){
        $this->score = $score;
        return $this;
    }

    public function getScore(){
        return $this->review;
    }

    public function setSentiment(string $sentiment) {
        $this->sentiment = $sentiment;
        return $this;
    }

    public function getSentiment() {
        return $this->sentiment;
    }
}
