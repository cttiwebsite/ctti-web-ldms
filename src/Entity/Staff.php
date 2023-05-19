<?php

namespace App\Entity;

use App\Repository\StaffRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StaffRepository::class)]
class Staff
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $staff_id = null;

    #[ORM\Column(length: 255)]
    private ?string $staff_first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $staff_middle_name = null;

    #[ORM\Column(length: 255)]
    private ?string $staff_last_name = null;

    #[ORM\Column(length: 255)]
    private ?string $staff_email = null;

    #[ORM\Column(length: 255)]
    private ?string $staff_nrc = null;

    #[ORM\Column(length: 255)]
    private ?string $staff_designation = null;

    #[ORM\ManyToOne(inversedBy: 'staff')]
    private ?Section $staff_faculty = null;

    #[ORM\ManyToOne(inversedBy: 'staff_phone_number')]
    private ?Program $staff_program = null;

    #[ORM\Column(length: 255)]
    private ?string $staff_contact = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStaffId(): ?string
    {
        return $this->staff_id;
    }

    public function setStaffId(string $staff_id): self
    {
        $this->staff_id = $staff_id;

        return $this;
    }

    public function getStaffFirstName(): ?string
    {
        return $this->staff_first_name;
    }

    public function setStaffFirstName(string $staff_first_name): self
    {
        $this->staff_first_name = $staff_first_name;

        return $this;
    }

    public function getStaffMiddleName(): ?string
    {
        return $this->staff_middle_name;
    }

    public function setStaffMiddleName(string $staff_middle_name): self
    {
        $this->staff_middle_name = $staff_middle_name;

        return $this;
    }

    public function getStaffLastName(): ?string
    {
        return $this->staff_last_name;
    }

    public function setStaffLastName(string $staff_last_name): self
    {
        $this->staff_last_name = $staff_last_name;

        return $this;
    }

    public function getStaffEmail(): ?string
    {
        return $this->staff_email;
    }

    public function setStaffEmail(string $staff_email): self
    {
        $this->staff_email = $staff_email;

        return $this;
    }

    public function getStaffNrc(): ?string
    {
        return $this->staff_nrc;
    }

    public function setStaffNrc(string $staff_nrc): self
    {
        $this->staff_nrc = $staff_nrc;

        return $this;
    }

    public function getStaffDesignation(): ?string
    {
        return $this->staff_designation;
    }

    public function setStaffDesignation(string $staff_designation): self
    {
        $this->staff_designation = $staff_designation;

        return $this;
    }

    public function getStaffFaculty(): ?Section
    {
        return $this->staff_faculty;
    }

    public function setStaffFaculty(?Section $staff_faculty): self
    {
        $this->staff_faculty = $staff_faculty;

        return $this;
    }

    public function getStaffProgram(): ?Program
    {
        return $this->staff_program;
    }

    public function setStaffProgram(?Program $staff_program): self
    {
        $this->staff_program = $staff_program;

        return $this;
    }

    public function getStaffContact(): ?string
    {
        return $this->staff_contact;
    }

    public function setStaffContact(string $staff_contact): self
    {
        $this->staff_contact = $staff_contact;

        return $this;
    }
}
