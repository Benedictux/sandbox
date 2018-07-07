<?php
/**
 * Created by BChar
 * Date: 03/07/2018
 * Time: 22:47
 */
namespace App\Entity;

// ------------------------------------------------------------------------------------------------------------------ //
// Imports.                                                                                                           //
// ------------------------------------------------------------------------------------------------------------------ //
use Doctrine\ORM\Mapping as ORM;

// ------------------------------------------------------------------------------------------------------------------ //
// Object.                                                                                                            //
// ------------------------------------------------------------------------------------------------------------------ //
/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaRepository")
 */
class Media
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $attachment;

    public function getId()
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

    public function getAttachment()
    {
        return $this->attachment;
    }

    public function setAttachment($attachment): self
    {
        $this->attachment = $attachment;

        return $this;
    }
}