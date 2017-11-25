<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ApiResource
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

}
