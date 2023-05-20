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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date = null;

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

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }
}
