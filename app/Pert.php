<?php


namespace App;


class Pert
{
    public $etats;
    public $arcFictifs;
    public $arcReals;
    public $etatInitial;
    public $etatFinal;

    /**
     * Pert constructor.
     * @param $etats
     * @param $arcFictifs
     * @param $arcReals
     * @param $etatInitial
     * @param $etatFinal
     */
    public function __construct($etats, $arcFictifs, $arcReals, $etatInitial, $etatFinal)
    {
        $this->etats = $etats;
        $this->arcFictifs = $arcFictifs;
        $this->arcReals = $arcReals;
        $this->etatInitial = $etatInitial;
        $this->etatFinal = $etatFinal;
    }



    /**
     * @return mixed
     */
    public function getEtats()
    {
        return $this->etats;
    }

    /**
     * @return mixed
     */
    public function getArcFictifs()
    {
        return $this->arcFictifs;
    }

    /**
     * @return mixed
     */
    public function getArcReals()
    {
        return $this->arcReals;
    }

    /**
     * @return mixed
     */
    public function getEtatInitial()
    {
        return $this->etatInitial;
    }

    /**
     * @return mixed
     */
    public function getEtatFinal()
    {
        return $this->etatFinal;
    }

    /**
     * @param mixed $etats
     */
    public function setEtats($etats)
    {
        $this->etats = $etats;
    }

    /**
     * @param mixed $arcFictifs
     */
    public function setArcFictifs($arcFictifs)
    {
        $this->arcFictifs = $arcFictifs;
    }

    /**
     * @param mixed $arcReals
     */
    public function setArcReals($arcReals)
    {
        $this->arcReals = $arcReals;
    }

    /**
     * @param mixed $etatInitial
     */
    public function setEtatInitial($etatInitial)
    {
        $this->etatInitial = $etatInitial;
    }

    /**
     * @param mixed $etatFinal
     */
    public function setEtatFinal($etatFinal)
    {
        $this->etatFinal = $etatFinal;
    }

    public function calculAuPlusTot(){
        $init = $this->getEtatInitial();
        $init->setAuPlusTot(0);
        for($i= 1; $i< count($this->getArcReals());$i++){
            $arc = $this->getArcReals()[$i];
            if($arc->getSource() == $init){
                $this->calculPlusTot($arc->getDestination(),$arc);
            }
        }

        $max = 0;
        for($i= 1 ;$i <= count($this->etats);$i++){
            $tem = array();
            $tem[$i] = $this->etats[$i]->getAuPlusTot();
            if($max < max($tem)){
                $max = max($tem);
            }

        }
        $this->etatFinal->setAuPlusTot($max);

    }

    public function calculPlusTot($etat,$arc){
        $taches = Tache::all();
        foreach($taches as $tache){
            $duree[$tache->code] = ((((abs(strtotime($tache->start_date)-strtotime($tache->end_date))/60)/60)/24));
        }
        if($arc->isReel()){
            if($arc->getSource()->getAuPlusTot() + $duree[$arc->getTache()->code] > $etat->getAuPlusTot()){

                $etat->setAuPlusTot($arc->getSource()->getAuPlusTot() + $duree[$arc->getTache()->code]);
                for($i= 1; $i< count($this->getArcReals()); $i++){
                    $arc = $this->getArcReals()[$i];
                    if($arc.getSource() == $etat){
                        $this->calculateAuPlusTard($arc->getDestination(),$arc);
                    }
                }
            }
        }
    }


    public function calculatePlusTard(){

        $etatFin = $this->getEtatFinal();
        $etatFin->setAuPlusTard($etatFin->getAuPlusTot());
        for($i = 1 ; $i <= count($this->getArcReals());$i++){
            $arc = $this->getArcReals()[$i];
            if($arc->getDestination() == $etatFin){
                $this->calculateAuPlusTard($arc->getSource(),$arc);
            }
        }



    }

    public function calculateAuPlusTard($etat, $arc){

        $taches = Tache::all();
        foreach($taches as $tache){
            $duree[$tache->code] = ((((abs(strtotime($tache->start_date)-strtotime($tache->end_date))/60)/60)/24));
        }

        if($arc->isReel()){

            if($arc->getDestination()->getAuPlusTard() - $duree[$arc->getTache()->code] <
                $etat->getAuPlusTard() || $etat->getAuPlusTard() == -1){
                $etat->setAuPlusTard($arc->getDestination()->getAuPlusTard() - $duree[$arc->getTache()->code] );

            }

            for($i= 1 ; $i<= count($this->getArcReals());$i++){
                $arc = $this->getArcReals()[$i];
                if($arc->getDestination() == $etat){
                    $this->calculateAuPlusTard($arc->getSource(),$arc);
                }

            }

        }





    }

}