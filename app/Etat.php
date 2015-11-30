<?php

namespace App;


class Etat
{
    private $nom;
    private $auPlusTot;
    private $auPlusTard;

    /**
     * Etat constructor.
     * @param $auPlusTot
     * @param $auPlusTard
     * @param $nom
     */
    public function __construct($auPlusTot, $auPlusTard, $nom)
    {
        $this->auPlusTot = $auPlusTot;
        $this->auPlusTard = $auPlusTard;
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getAuPlusTot()
    {
        return $this->auPlusTot;
    }

    /**
     * @return mixed
     */
    public function getAuPlusTard()
    {
        return $this->auPlusTard;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @param mixed $auPlusTot
     */
    public function setAuPlusTot($auPlusTot)
    {
        $this->auPlusTot = $auPlusTot;
    }

    /**
     * @param mixed $auPlusTard
     */
    public function setAuPlusTard($auPlusTard)
    {
        $this->auPlusTard = $auPlusTard;
    }




}