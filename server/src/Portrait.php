<?php

namespace Richardkrikler\Artlocator;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="portraits")
 */
class Portrait
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $portraitId;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string")
     */
    private string $description;

    /**
     * @ORM\Column(type="string")
     */
    private string $year;

    /**
     * @ORM\Column(type="integer")
     */
    private int $museumId;

    /**
     * @ORM\Column(type="blob", columnDefinition="BLOB NULL")
     */
    private $image;

    /**
     * @param int $portraitId
     * @param string $name
     * @param string $description
     * @param string $year
     * @param int $museumId
     * @param $image
     */
    public function __construct(int $portraitId, string $name, string $description, string $year, int $museumId, $image)
    {
        $this->portraitId = $portraitId;
        $this->name = $name;
        $this->description = $description;
        $this->year = $year;
        $this->museumId = $museumId;
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getPortraitId(): int
    {
        return $this->portraitId;
    }

    /**
     * @param int $portraitId
     */
    public function setPortraitId(int $portraitId): void
    {
        $this->portraitId = $portraitId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getYear(): string
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function getMuseumId(): int
    {
        return $this->museumId;
    }

    /**
     * @param int $museumId
     */
    public function setMuseumId(int $museumId): void
    {
        $this->museumId = $museumId;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }
}