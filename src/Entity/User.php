<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;


    // ------------------------------
    // GETTER ID
    // ------------------------------
    public function getId(): ?int
    {
        return $this->id;
    }

    // ------------------------------
    // EMAIL (IDENTIFIER)
    // ------------------------------
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function getUsername(): string
    {
        return $this->email;
    }


    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    // Obligatoire pour Symfony 6+
    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    // ------------------------------
    // PASSWORD
    // ------------------------------
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    // ------------------------------
    // ROLES
    // ------------------------------
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER'; // rôle par défaut
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    // ------------------------------
    // ERASE CREDENTIALS
    // ------------------------------
    public function eraseCredentials(): void
    {
        // Si tu veux supprimer un mot de passe en clair après l’authentification
    }



    // ------------------------------
    // NOM
    // ------------------------------
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    // ------------------------------
    // PRENOM
    // ------------------------------
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    // ------------------------------
    // TELEPHONE
    // ------------------------------
    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }
}
