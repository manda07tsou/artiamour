<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;



/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @Vich\Uploadable()
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $matter;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $filename;

    /**
     * @var File
     * @Vich\UploadableField(mapping="product_image" , fileNameProperty="filename")
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="text")
     */
    private $colors;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function getFormatedPrice(): ?string
    {
        return number_format(floatval($this->price), 0, '.','.');
    }

    public function setPrice(string $price): self
    {
        $this->price = str_replace(' ', '', $price);
        return $this;
    }

    public function getMatter(): ?string
    {
        return $this->matter;
    }

    public function setMatter(string $matter): self
    {
        $this->matter = $matter;

        return $this;
    }

    public function setImage(File $image){
        $this->image = $image;

        if($this->image instanceof UploadedFile){
            $this->setUpdated_at(new \DateTimeImmutable());
        }
    }

    public function getImage(){
        return $this->image;
    }

    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    public function setUpdated_at(?\DatetimeImmutable $updated_at):self
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getColors(): ?string
    {
        return $this->colors;
    }

    public function setColors(string $colors): self
    {
        $this->colors = $colors;

        return $this;
    }

    public function getSlug():string
    {
        $slugify = new Slugify();
        return $slugify->slugify($this->name);
    }
}
