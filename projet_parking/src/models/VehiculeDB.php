<?php

class VehiculeDB {
    private $connection;
    private $vehicule;
    private $table = "vehicule";

    public function __construct($connection, $vehicule) {
		$this->connection = $connection;
        $this->vehicule = $vehicule;
    }

    public function save($idProprietaire){
        $requete = $this->connection->prepare("INSERT INTO " . $this->table . "(id, plaque, nom, type, id_proprietaire, photo)
                                        VALUES (0, :plaque, :nom, :type, :id_proprietaire, :photo)");
        $result = $requete->execute(array(
            "plaque" => $this->vehicule->getPlaque(),
            "nom" => $this->vehicule->getNom(),
            "type" => $this->vehicule->getType(),
            "id_proprietaire" => $idProprietaire,
            "photo" => $this->vehicule->getPhoto()
        ));
        $this->connection = null;

        return $result;
    }

    public function update(){
        $requete = $this->Connection->prepare("
            UPDATE " . $this->table . " 
            SET 
                plaque = :plaque,
                nom = :nom, 
                type = :type,
                phone = :phone
            WHERE id = :id 
        ");

        $resultat = $requete->execute(array(
            "id" => $this->id,
            "plaque" => $this->vehicule->getPlaque(),
            "nom" => $this->vehicule->getNom(),
            "type" => $this->vehicule->getType()
        ));
        $this->connection->disconnect();

        return $resultat;
    }
        
    
    public function getAll(){

        $requete = $this->connection->prepare("SELECT id, plaque, nom, type, id_proprietaire FROM " . $this->table);
        $requete->execute();
        $resultats = $requete->fetchAll();
        $this->connection = null;
        return $resultats;
    }

    public function rechercheDetaillee($id) {
        $requete = $this->connection->prepare("SELECT v.plaque, v.nom, v.type, v.photo, p.nom as nom_p, p.email FROM vehicule v 
             JOIN proprietaire p 
             ON p.id = v.id_proprietaire 
             WHERE v.id = :id");
        $requete->execute(array("id" => $id));
        $resultat = $requete->fetch();
        $this->connection = null;
        return $resultat;
    }

    public function getByColumn($column, $value){
        $requete = $this->connection->query("SELECT * FROM " . $this->table ." WHERE ".$column." = '".$value."'");
        $resultat = $requete->fetchAll();        
        return $resultat;
    }
    
    public function getById($id){
        $requete = $this->connection->prepare("SELECT id, plaque, nom, type FROM " . $this->table . "  WHERE id = :id");
        $requete->execute(array("id" => $id));
        $resultat = $requete->fetchObject();
        $this->connection=null;
        return $resultat;
    }
    
    public function deleteById($id){
        try {
            $this->connection->query("DELETE FROM " . $this->table . " WHERE id = ".$id.";");
            $this->connection=null;
        } catch (Exception $e) {
            echo 'Impossible de  supprimer le véhicule : ' . $e->getMessage();
            return -1;
        }
    }

}
