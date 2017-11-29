<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"},"post"={"method"="POST"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     attributes={
 *          "filters"={"friendly.filter","review.tag_filter"},
 *          "normalization_context"={"groups"={"read"}},
 *          "denormalization_context"={"groups"={"write"}},
 *          "order"={"createdAt": "DESC"}
 * })
 * @ORM\Entity
 */
class Review
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @Groups({"read"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string A nice comment
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     *
     * @Groups({"read", "write"})
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
     *
     * @Groups({"read", "write"})
     */
    public $tag;

    /**
     * @var date The date of the review
     *
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read"})
     */
    public $createdAt;

    /**
     * @var string The sentiment of the review
     *
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read"})
     */
    public $sentiment;

    /**
     * @var integer The likes
     *
     * @ORM\Column(type="integer", options={"default":0})
     * @Groups({"read"})
     */
    public $likes=0;

    /**
     * @var string The flags
     *
     * @ORM\Column(type="integer", options={"default":0})
     * @Groups({"read"})
     */
    public $flags=0;

    public function getId()
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
