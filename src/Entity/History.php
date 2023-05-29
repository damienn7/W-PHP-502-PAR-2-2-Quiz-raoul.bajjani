<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoryRepository::class)]
class History
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_reponse = null;

    #[ORM\OneToMany(mappedBy: 'history', targetEntity: Reponse::class)]
    private Collection $reponse;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'histories')]
    private Collection $user;

    #[ORM\Column(length: 255)]
    private ?string $score = null;

    #[ORM\Column]
    private ?bool $is_finished = null;

    #[ORM\Column]
    private ?bool $is_started = null;

    public function __construct()
    {
        $this->reponse = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReponse(): ?\DateTimeImmutable
    {
        return $this->date_reponse;
    }

    public function setDateReponse(\DateTimeImmutable $date_reponse): self
    {
        $this->date_reponse = $date_reponse;

        return $this;
    }

    /**
     * @return Collection<int, Reponse>
     */
    public function getReponse(): Collection
    {
        return $this->reponse;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponse->contains($reponse)) {
            $this->reponse->add($reponse);
            $reponse->setHistory($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponse->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getHistory() === $this) {
                $reponse->setHistory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function isIsFinished(): ?bool
    {
        return $this->is_finished;
    }

    public function setIsFinished(bool $is_finished): self
    {
        $this->is_finished = $is_finished;

        return $this;
    }

    public function isIsStarted(): ?bool
    {
        return $this->is_started;
    }

    public function setIsStarted(bool $is_started): self
    {
        $this->is_started = $is_started;

        return $this;
    }
}
