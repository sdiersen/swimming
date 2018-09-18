<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SwimLevels
 *
 * @ORM\Table(name="swim_levels", uniqueConstraints={@ORM\UniqueConstraint(name="progression", columns={"progression"})})
 * @ORM\Entity(repositoryClass="App\Repository\SwimLevelsRepository")
 */
class SwimLevels
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="requirements", type="text", length=65535, nullable=true)
     */
    private $requirements;

    /**
     * @var string|null
     *
     * @ORM\Column(name="age_range", type="string", length=255, nullable=true)
     */
    private $ageRange;

    /**
     * @var int|null
     *
     * @ORM\Column(name="progression", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $progression;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRequirements(): ?string
    {
        return $this->requirements;
    }

    public function setRequirements(?string $requirements): self
    {
        $this->requirements = $requirements;

        return $this;
    }

    public function getAgeRange(): ?string
    {
        return $this->ageRange;
    }

    public function setAgeRange(?string $ageRange): self
    {
        $this->ageRange = $ageRange;

        return $this;
    }

    public function getProgression(): ?int
    {
        return $this->progression;
    }

    public function setProgression(?int $progression): self
    {
        $this->progression = $progression;

        return $this;
    }

}
