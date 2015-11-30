<?php


namespace App;


class Arc
{
    private $source;
    private $destination;
    private $tache ;
    private $isReel;

    /**
     * Arc constructor.
     * @param $source
     * @param $destination
     * @param $tache
     * @param $isReel
     */
    public function __construct($source, $destination, $tache, $isReel)
    {
        $this->source = $source;
        $this->destination = $destination;
        $this->tache = $tache;
        $this->isReel = $isReel;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @return mixed
     */
    public function getTache()
    {
        return $this->tache;
    }

    /**
     * @return mixed
     */
    public function isReel()
    {
        return $this->isReel;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @param mixed $tache
     */
    public function setTache($tache)
    {
        $this->tache = $tache;
    }

    /**
     * @param mixed $isReel
     */
    public function setIsReel($isReel)
    {
        $this->isReel = $isReel;
    }


}