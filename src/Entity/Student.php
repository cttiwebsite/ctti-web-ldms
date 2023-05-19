<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $student_id = null;

    #[ORM\Column(length: 255)]
    private ?string $student_first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $student_last_name = null;

    #[ORM\Column(length: 255)]
    private ?string $student_middle_name = null;

    #[ORM\Column(length: 255)]
    private ?string $student_nrc = null;

    #[ORM\Column(length: 255)]
    private ?string $student_email = null;

    #[ORM\Column(length: 255)]
    private ?string $student_sponsor = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    private ?Program $student_program_of_study = null;

    #[ORM\Column(length: 255)]
    private ?string $student_gender = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $student_date_of_birth = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $student_disability = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    private ?Section $student_section = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentId(): ?string
    {
        return $this->student_id;
    }

    public function setStudentId(string $student_id): self
    {
        $this->student_id = $student_id;

        return $this;
    }

    public function getStudentFirstName(): ?string
    {
        return $this->student_first_name;
    }

    public function setStudentFirstName(string $student_first_name): self
    {
        $this->student_first_name = $student_first_name;

        return $this;
    }

    public function getStudentLastName(): ?string
    {
        return $this->student_last_name;
    }

    public function setStudentLastName(string $student_last_name): self
    {
        $this->student_last_name = $student_last_name;

        return $this;
    }

    public function getStudentMiddleName(): ?string
    {
        return $this->student_middle_name;
    }

    public function setStudentMiddleName(string $student_middle_name): self
    {
        $this->student_middle_name = $student_middle_name;

        return $this;
    }

    public function getStudentNrc(): ?string
    {
        return $this->student_nrc;
    }

    public function setStudentNrc(string $student_nrc): self
    {
        $this->student_nrc = $student_nrc;

        return $this;
    }

    public function getStudentEmail(): ?string
    {
        return $this->student_email;
    }

    public function setStudentEmail(string $student_email): self
    {
        $this->student_email = $student_email;

        return $this;
    }

    public function getStudentSponsor(): ?string
    {
        return $this->student_sponsor;
    }

    public function setStudentSponsor(string $student_sponsor): self
    {
        $this->student_sponsor = $student_sponsor;

        return $this;
    }

    public function getStudentProgramOfStudy(): ?Program
    {
        return $this->student_program_of_study;
    }

    public function setStudentProgramOfStudy(?Program $student_program_of_study): self
    {
        $this->student_program_of_study = $student_program_of_study;

        return $this;
    }

    public function getStudentGender(): ?string
    {
        return $this->student_gender;
    }

    public function setStudentGender(string $student_gender): self
    {
        $this->student_gender = $student_gender;

        return $this;
    }

    public function getStudentDateOfBirth(): ?\DateTimeInterface
    {
        return $this->student_date_of_birth;
    }

    public function setStudentDateOfBirth(\DateTimeInterface $student_date_of_birth): self
    {
        $this->student_date_of_birth = $student_date_of_birth;

        return $this;
    }

    public function getStudentDisability(): ?string
    {
        return $this->student_disability;
    }

    public function setStudentDisability(?string $student_disability): self
    {
        $this->student_disability = $student_disability;

        return $this;
    }

    public function getStudentSection(): ?Section
    {
        return $this->student_section;
    }

    public function setStudentSection(?Section $student_section): self
    {
        $this->student_section = $student_section;

        return $this;
    }

    public function __toString() 
    {
        return $this->student_date_of_birth;
    }
}
