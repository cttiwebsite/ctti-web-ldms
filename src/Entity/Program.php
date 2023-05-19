<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $program_code = null;

    #[ORM\Column(length: 255)]
    private ?string $program_name = null;

    #[ORM\Column(length: 255)]
    private ?string $program_duration = null;

    #[ORM\Column(length: 255)]
    private ?string $program_certification = null;

    #[ORM\Column(length: 255)]
    private ?string $program_type = null;

    #[ORM\OneToMany(mappedBy: 'student_program_of_study', targetEntity: Student::class)]
    private Collection $students;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'programs')]
    private ?Section $section = null;

    #[ORM\OneToMany(mappedBy: 'staff_program', targetEntity: Staff::class)]
    private Collection $staff_phone_number;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->staff_phone_number = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgramCode(): ?string
    {
        return $this->program_code;
    }

    public function setProgramCode(string $program_code): self
    {
        $this->program_code = $program_code;

        return $this;
    }

    public function getProgramName(): ?string
    {
        return $this->program_name;
    }

    public function setProgramName(string $program_name): self
    {
        $this->program_name = $program_name;

        return $this;
    }

    public function getProgramDuration(): ?string
    {
        return $this->program_duration;
    }

    public function setProgramDuration(string $program_duration): self
    {
        $this->program_duration = $program_duration;

        return $this;
    }

    public function getProgramCertification(): ?string
    {
        return $this->program_certification;
    }

    public function setProgramCertification(string $program_certification): self
    {
        $this->program_certification = $program_certification;

        return $this;
    }

    public function getProgramType(): ?string
    {
        return $this->program_type;
    }

    public function setProgramType(string $program_type): self
    {
        $this->program_type = $program_type;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
            $student->setStudentProgramOfStudy($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getStudentProgramOfStudy() === $this) {
                $student->setStudentProgramOfStudy(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function __toString() 
    {
        return $this->program_name;
    }

    /**
     * @return Collection<int, Staff>
     */
    public function getStaffPhoneNumber(): Collection
    {
        return $this->staff_phone_number;
    }

    public function addStaffPhoneNumber(Staff $staffPhoneNumber): self
    {
        if (!$this->staff_phone_number->contains($staffPhoneNumber)) {
            $this->staff_phone_number->add($staffPhoneNumber);
            $staffPhoneNumber->setStaffProgram($this);
        }

        return $this;
    }

    public function removeStaffPhoneNumber(Staff $staffPhoneNumber): self
    {
        if ($this->staff_phone_number->removeElement($staffPhoneNumber)) {
            // set the owning side to null (unless already changed)
            if ($staffPhoneNumber->getStaffProgram() === $this) {
                $staffPhoneNumber->setStaffProgram(null);
            }
        }

        return $this;
    }
}
