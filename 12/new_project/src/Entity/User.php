<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class User
 * @package App\Entity
 * @ORM\Entity()
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @Assert\Length(max="10", min="3", minMessage="Imie musi mieć przynajmniej 3 znaki")
     * @ORM\Column(type="string")
     * @var string
     */
    private $name;

    /**
     *
     * @Assert\NotBlank(message="Nazwisko nie może być puste")
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $surname;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     * @Assert\Country()
     * @var string|null
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @var Category|null
     */
    private $category;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

}