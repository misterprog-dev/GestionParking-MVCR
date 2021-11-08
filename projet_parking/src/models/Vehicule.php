<?php

class Vehicule{
    private $plaque;
    private $nom;
    private $type;
    private $photo;

    public function __construct($plaque, $nom, $type, $photo)
    {
        $this->plaque = $plaque;
        $this->nom = $nom;
        $this->type = $type;
        $this->photo = $photo;
    }

    /**
     * Get the value of plaque
     */ 
    public function getPlaque()
    {
        return $this->plaque;
    }

    /**
     * Set the value of plaque
     *
     * @return  self
     */ 
    public function setPlaque($plaque)
    {
        $this->plaque = $plaque;

        return $this;
    }
    
    
    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }


    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of photo
     */ 
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @return  self
     */ 
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }
}
    