<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserReponse
 *
 * @ORM\Table(name="user_reponse", indexes={@ORM\Index(name="id_reponse", columns={"id_reponse"}), @ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class UserReponse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \App\Entity\Reponse
     *
     * @ORM\ManyToOne(targetEntity="Reponse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reponse", referencedColumnName="id")
     * })
     */
    private $idReponse;

    /**
     * @var \App\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReponse(): ?Reponse
    {
        return $this->idReponse;
    }

    public function setIdReponse(?Reponse $idReponse): self
    {
        $this->idReponse = $idReponse;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
