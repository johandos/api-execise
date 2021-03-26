<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="beers")
 */
class Beers {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     *
     */
    private $name;
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;
    /**
     * @ORM\Column(name="tagline", type="string", length=100)
     * @Assert\NotBlank()
     *
     */
    private $tagline;
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     *
     */
    private $image;
    /**
     * @ORM\Column(name="first_brewed", type="string", length=100)
     * @Assert\NotBlank()
     *
     */
    private $firstBrewed;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    /**
     * @return mixed
     */
    public function getTagline()
    {
        return $this->tagline;
    }
    /**
     * @param mixed $tagline
     */
    public function setTagline($tagline)
    {
        $this->tagline = $tagline;
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
    public function setImage($image)
    {
        $this->image = $image;
    }
    /**
     * @return mixed
     */
    public function getFirstBrewed()
    {
        return $this->firstBrewed;
    }
    /**
     * @param mixed $firstBrewed
     */
    public function setFirstBrewed($firstBrewed)
    {
        $this->firstBrewed = $firstBrewed;
    }
}