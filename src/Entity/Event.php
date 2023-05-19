<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $event_name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $event_start = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $event_end = null;

    #[ORM\Column(length: 255)]
    private ?string $event_location = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $event_host = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventName(): ?string
    {
        return $this->event_name;
    }

    public function setEventName(string $event_name): self
    {
        $this->event_name = $event_name;

        return $this;
    }

    public function getEventStart(): ?\DateTimeInterface
    {
        return $this->event_start;
    }

    public function setEventStart(\DateTimeInterface $event_start): self
    {
        $this->event_start = $event_start;

        return $this;
    }

    public function getEventEnd(): ?\DateTimeInterface
    {
        return $this->event_end;
    }

    public function setEventEnd(\DateTimeInterface $event_end): self
    {
        $this->event_end = $event_end;

        return $this;
    }

    public function getEventLocation(): ?string
    {
        return $this->event_location;
    }

    public function setEventLocation(string $event_location): self
    {
        $this->event_location = $event_location;

        return $this;
    }

    public function getEventHost(): ?string
    {
        return $this->event_host;
    }

    public function setEventHost(?string $event_host): self
    {
        $this->event_host = $event_host;

        return $this;
    }
}
