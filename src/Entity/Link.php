<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LinkRepository::class)
 * @ORM\Table(name="links")
 */
class Link
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="long_link", type="string", length=255, unique=true)
     * @Assert\Regex("/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,4}\b([-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)/")
     */
    private $long_link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $short_link;

    /**
     * @ORM\Column(type="date")
     */
    private $create_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLongLink(): ?string
    {
        return $this->long_link;
    }

    public function setLongLink(string $long_link): self
    {
        $this->long_link = $long_link;

        return $this;
    }

    public function getShortLink(): ?string
    {
        return $this->short_link;
    }

    public function setShortLink(string $short_link): self
    {
        $this->short_link = $short_link;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->create_date;
    }

    public function setCreateDate(\DateTimeInterface $create_date): self
    {
        $this->create_date = $create_date;

        return $this;
    }
}
