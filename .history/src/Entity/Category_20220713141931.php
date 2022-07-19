<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Post::class, orphanRemoval: true)]
    private $id_post;

    public function __construct()
    {
        $this->id_post = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name_category): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getIdPost(): Collection
    {
        return $this->id_post;
    }

    public function addIdPost(Post $idPost): self
    {
        if (!$this->id_post->contains($idPost)) {
            $this->id_post[] = $idPost;
            $idPost->setCategory($this);
        }

        return $this;
    }

    public function removeIdPost(Post $idPost): self
    {
        if ($this->id_post->removeElement($idPost)) {
            // set the owning side to null (unless already changed)
            if ($idPost->getCategory() === $this) {
                $idPost->setCategory(null);
            }
        }

        return $this;
    }
}
