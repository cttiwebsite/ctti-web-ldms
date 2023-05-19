<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $section_code = null;

    #[ORM\Column(length: 255)]
    private ?string $section_name = null;

    #[ORM\OneToMany(mappedBy: 'student_section', targetEntity: Student::class)]
    private Collection $students;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: Program::class)]
    private Collection $programs;

    #[ORM\OneToMany(mappedBy: 'staff_faculty', targetEntity: Staff::class)]
    private Collection $staff;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->programs = new ArrayCollection();
        $this->staff = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSectionCode(): ?string
    {
        return $this->section_code;
    }

    public function setSectionCode(string $section_code): self
    {
        $this->section_code = $section_code;

        return $this;
    }

    public function getSectionName(): ?string
    {
        return $this->section_name;
    }

    public function setSectionName(string $section_name): self
    {
        $this->section_name = $section_name;

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
            $student->setStudentSection($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getStudentSection() === $this) {
                $student->setStudentSection(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Program>
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->programs->contains($program)) {
            $this->programs->add($program);
            $program->setSection($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        if ($this->programs->removeElement($program)) {
            // set the owning side to null (unless already changed)
            if ($program->getSection() === $this) {
                $program->setSection(null);
            }
        }

        return $this;
    }

    public function __toString() 
    {
        return $this->section_name;
    }

    /**
     * @return Collection<int, Staff>
     */
    public function getStaff(): Collection
    {
        return $this->staff;
    }

    public function addStaff(Staff $staff): self
    {
        if (!$this->staff->contains($staff)) {
            $this->staff->add($staff);
            $staff->setStaffFaculty($this);
        }

        return $this;
    }

    public function removeStaff(Staff $staff): self
    {
        if ($this->staff->removeElement($staff)) {
            // set the owning side to null (unless already changed)
            if ($staff->getStaffFaculty() === $this) {
                $staff->setStaffFaculty(null);
            }
        }

        return $this;
    }
}
