<?php
namespace App\Entity;
use App\Repository\AboutRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
class About
{
    #[ORM\Column(length:255)]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email_address = null;

    #[ORM\Column(length: 255)]
    private ?string $phone_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fax_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $mission_statement = null;

    #[ORM\Column(length: 255)]
    private ?string $vision = null;

    #[ORM\Column(length: 255)]
    private ?string $motto = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $history = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailAddress(): ?string
    {
        return $this->email_address;
    }

    public function setEmailAddress(string $email_address): self
    {
        $this->email_address = $email_address;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getFaxNumber(): ?string
    {
        return $this->fax_number;
    }

    public function setFaxNumber(?string $fax_number): self
    {
        $this->fax_number = $fax_number;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMissionStatement(): ?string
    {
        return $this->mission_statement;
    }

    public function setMissionStatement(string $mission_statement): self
    {
        $this->mission_statement = $mission_statement;

        return $this;
    }

    public function getVision(): ?string
    {
        return $this->vision;
    }

    public function setVision(string $vision): self
    {
        $this->vision = $vision;

        return $this;
    }

    public function getMotto(): ?string
    {
        return $this->motto;
    }

    public function setMotto(string $motto): self
    {
        $this->motto = $motto;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(string $history): self
    {
        $this->history = $history;

        return $this;
    }
}
