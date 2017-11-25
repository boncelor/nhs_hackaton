<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Filter\FriendlyReviewFilter;

/**
 *
 * @ApiResource(attributes={"filters"={"friendly.filter"}})
 * @ORM\Entity
 */
class Review
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string A nice comment
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $comment;

    /**
     * @ORM\OneToMany(targetEntity="ReviewSentimentLog", mappedBy="review", cascade={"ALL"})
     */
    public $review_sentiment_logs;

    /**
     * @var string The tagged comment
     *
     * @ORM\Column(type="text")
     */
    public $tag;

    /**
     * @var date The date of the review
     *
     * @ORM\Column(type="date", nullable=true)
     */
    public $createdAt;

    /**
     * @var string The sentiment of the review
     *
     * @ORM\Column(type="text", nullable=true)
     */
    public $sentiment;

    /**
     * @var integer The likes
     *
     * @ORM\Column(type="integer")
     */
    public $likes=0;

    /**
     * @var string The flags
     *
     * @ORM\Column(type="integer")
     */
    public $flags=0;

    public function getId(): int
    {
        return $this->id;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment){
        $this->comment = $comment;
        return $this;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getSentiment(){
        return $this->sentiment;
    }

    public function setSentiment($sentiment)
    {
        $this->sentiment = $sentiment;
        return $this;
    }

    public function getLikes(){
        return $this->likes;
    }
    public function increaseLikes(){
        $this->likes++;
    }

    public function getFlags(){
        return $this->flags;
    }
    public function increaseFlags(){
        $this->flags++;
    }


}
