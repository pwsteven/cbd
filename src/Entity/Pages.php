<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PagesRepository")
 */
class Pages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="This field is required")
     */
    private $PageName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="This field is required")
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="This field is required")
     */
    private $seoTitle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="This field is required")
     */
    private $seoDescription;

    /**
     * @ORM\Column(type="text")
     */
    private $pageContent;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHomePage;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $parent;

    /**
     * @ORM\Column(type="smallint")
     */
    private $pageOrder;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pageType;

    /**
     * @ORM\Column(type="boolean")
     */
    private $setLive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateAdded;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $menuTitle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPageName(): ?string
    {
        return $this->PageName;
    }

    public function setPageName(string $PageName): self
    {
        $this->PageName = $PageName;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSeoTitle(): ?string
    {
        return $this->seoTitle;
    }

    public function setSeoTitle(string $seoTitle): self
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seoDescription;
    }

    public function setSeoDescription(string $seoDescription): self
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    public function getPageContent(): ?string
    {
        return $this->pageContent;
    }

    public function setPageContent(string $pageContent): self
    {
        $this->pageContent = $pageContent;

        return $this;
    }

    public function getIsHomePage(): ?bool
    {
        return $this->isHomePage;
    }

    public function setIsHomePage(bool $isHomePage): self
    {
        $this->isHomePage = $isHomePage;

        return $this;
    }

    public function getParent(): ?int
    {
        return $this->parent;
    }

    public function setParent(int $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getPageOrder(): ?int
    {
        return $this->pageOrder;
    }

    public function setPageOrder(int $pageOrder): self
    {
        $this->pageOrder = $pageOrder;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getPageType(): ?string
    {
        return $this->pageType;
    }

    public function setPageType(?string $pageType): self
    {
        $this->pageType = $pageType;

        return $this;
    }

    public function getSetLive(): ?bool
    {
        return $this->setLive;
    }

    public function setSetLive(bool $setLive): self
    {
        $this->setLive = $setLive;

        return $this;
    }

    public function getDateAdded(): ?string
    {
        return $this->dateAdded;
    }

    public function setDateAdded(string $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function getMenuTitle(): ?string
    {
        return $this->menuTitle;
    }

    public function setMenuTitle(string $menuTitle): self
    {
        $this->menuTitle = $menuTitle;

        return $this;
    }

    public function __toString()
    {
        return $this->getPageName();
    }
}
