<?php

class PerfumeModel
{
    private $name = null;
    private $brand = null;
    private $quantity = null;
    private $notes = null;
    private $releaseDate = null;
    private $perfumeId = null;
    private $occasion = null;
    private $season = null;
    private $price = null;
    private $picture = null;
    private $gender = null;

    public function setModel($specificFragranceArray)
    {
        $this->setName($specificFragranceArray['NUME']);
        $this->setBrand($specificFragranceArray['BRAND']);
        $this->setNotes($specificFragranceArray['NOTE']);
        $this->setOccasion($specificFragranceArray['OCAZIE']);
        $this->setPerfumeId($specificFragranceArray['ID']);
        $this->setQuantity($specificFragranceArray['CANTITATE']);
        $this->setPicture($specificFragranceArray['POZA']);
        $this->setReleaseDate($specificFragranceArray['DATA_LANSARE']);
        $this->setSeason($specificFragranceArray['SEZON']);
        $this->setPrice($specificFragranceArray['PRET']);
        $this->setGender($specificFragranceArray['SEX']);
    }

    /**
     * @return null
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param null $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }


    /**
     * @return null
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param null $picture
     */
    public function setPicture($picture): void
    {
        $this->picture = $picture;
    }



    /**
     * @return null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param null $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }



    public const notes = array("Aldehyde","Amber","Animalic","Aquatic","Balsamic","Beverages","Citric","Earthy",
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
    public function getPerfumeId()
    {
        return $this->perfumeId;
    }

    /**
     * @param null $perfumeId
     */
    public function setPerfumeId($perfumeId): void
    {
        $this->perfumeId = $perfumeId;
    }

    /**
     * @return null
     */
    public function getOccasion()
    {
        return $this->occasion;
    }

    /**
     * @param null $occasion
     */
    public function setOccasion($occasion): void
    {
        $this->occasion = $occasion;
    }

    /**
     * @return null
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param null $season
     */
    public function setSeason($season): void
    {
        $this->season = $season;
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