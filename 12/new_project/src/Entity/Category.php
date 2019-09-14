<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Category
 * @package App\Entity
 * @ORM\Entity()
 * @UniqueEntity(fields={"name"})
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     * @ORM\Column(type="string")
     * @var
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="category")
     * @var User[]|Collection
     */
    private $users;

    public function __construct(string  $name)
    {
        $this->users = new ArrayCollection();
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return User[]|Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function addUser(User $user)
    {
        $user->setCategory($this);
        $this->users->add($user);
    }
}