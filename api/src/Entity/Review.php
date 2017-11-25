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
     * @var string The tagged comment
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $tag;

    /**
     * @var date The date of the review
     *
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    public $createdAt;

    /**
     * @var string The sentiment of the review
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $sentiment;

    public function getId(): int
    {
        return $this->id;
    }
}
