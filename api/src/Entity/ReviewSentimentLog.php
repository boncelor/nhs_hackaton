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
}
