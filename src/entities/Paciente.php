<?php

namespace src\entities;

// classe paciente
class Paciente {

    private ?int $id; //interrogacao para demonstrar que o id e implementado por outro lugar
    private string $name;
    private \DateTimeInterface $birthDate;
    private string $gender;
    private int $telephone;
    private string $address;

    public function __construct(?int $id, string $name, \DateTimeInterface $birthDate, string $gender, int $telephone, string $address) {
        $this->id = $id;
        $this->name = $name;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->telephone = $telephone;
        $this->address = $address;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getBirthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }
}
?>