<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $passId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassId(): ?int
    {
        return $this->passId;
    }

    public function setPassId(int $passId): self
    {
        $this->passId = $passId;

        return $this;
    }
}
