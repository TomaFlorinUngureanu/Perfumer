<?php

class PerfumeModel
{
    private $name = null;
    private $brand = null;
    private $quantity = null;
    private $notes = null;
    private $releaseDate = null;

    public const notes = array( "Aldehyde","Amber","Animalic","Aquatic","Balsamic","Beverages","Citric","Earthy",
        "Floral","Fruity","Gourmandy","Grain","Green","Herbacious","Leather","Mineral","Mossy","Musk","Oriental",
        "Powdery","Resinous","Smoky","Spicy","Synthetic","Tea","Textile","Tobbaco","Woody");

    public const seasons = array("Spring", "Summer", "Autumn", "Winter");

    public const occasions = array("Work", "Interview", "Date", "Party", "Social", "OffDuty");

    /**
     * PerfumeModel constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param null $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param null $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param null $notes
     */
    public function setNotes($notes): void
    {
        $this->notes = $notes;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * @param null $releaseDate
     */
    public function setReleaseDate($releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }
}