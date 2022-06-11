<?php

namespace Richardkrikler\Artlocator;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="museums")
 */
class Museum
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $museumId;

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
    private string $country;

    /**
     * @ORM\Column(type="string")
     */
    private string $city;

    /**
     * @ORM\Column(type="string")
     */
    private string $url;

    /**
     * @ORM\Column(type="blob", columnDefinition="BLOB NULL")
     */
    private $image;

    /**
     * @param int $museumId
     * @param string $name
     * @param string $description
     * @param string $country
     * @param string $city
     * @param string $url
     * @param $image
     */
    public function __construct(int $museumId, string $name, string $description, string $country, string $city, string $url, $image)
    {
        $this->museumId = $museumId;
        $this->name = $name;
        $this->description = $description;
        $this->country = $country;
        $this->city = $city;
        $this->url = $url;
        $this->image = $image;
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
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
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }
}