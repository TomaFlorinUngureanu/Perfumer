<?php

class CommandModel
{
    private $id;
    private $accountEmail;
    private $items;
    private $startedDate;
    private $price;
    private $status;

    /**
     * CommandModel constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAccountEmail()
    {
        return $this->accountEmail;
    }

    /**
     * @param mixed $accountEmail
     */
    public function setAccountEmail($accountEmail): void
    {
        $this->accountEmail = $accountEmail;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems($items): void
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function getStartedDate()
    {
        return $this->startedDate;
    }

    /**
     * @param mixed $startedDate
     */
    public function setStartedDate($startedDate): void
    {
        $this->startedDate = $startedDate;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }



}