<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reponses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    #[ORM\Column(length: 255)]
    private ?string $reponse = null;

    #[ORM\Column]
    private ?int $reponse_expected = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'reponses')]
    private Collection $users;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $date_responded = null;

    #[ORM\ManyToOne(inversedBy: 'reponse')]
    private ?History $history = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getReponseExpected(): ?int
    {
        return $this->reponse_expected;
    }

    public function setReponseExpected(int $reponse_expected): self
    {
        $this->reponse_expected = $reponse_expected;

        return $this;
    }

    public function getQuestion(): ?question
    {
        return $this->question;
    }

    public function setQuestion(?question $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addReponse($this);
        }

        return $this;
    }
    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeReponse($this);
        }
        return $this;
    }

    public function getDateResponded(): ?\DateTimeImmutable
    {
        return $this->date_responded;
    }

    public function setDateResponded(?\DateTimeImmutable $date_responded): self
    {
        $this->date_responded = $date_responded;

        return $this;
    }

    public function getHistory(): ?History
    {
        return $this->history;
    }

    public function setHistory(?History $history): self
    {
        $this->history = $history;

        return $this;
    }

}
