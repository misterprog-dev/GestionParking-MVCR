<?php

class ProprietaireDB {
    private $connection;
    private $proprietaire;
    private $table = "proprietaire";

    public function __construct($connection, $proprietaire) {
		$this->connection = $connection;
        $this->proprietaire = $proprietaire;
    }

    public function save(){
        try {
            // On crypte le mot de passe
            $motDePasseCrypte = password_hash($this->proprietaire->getPassword(), PASSWORD_DEFAULT); 

            $requete = $this->connection->prepare("INSERT INTO " . $this->table . "(id, nom, prenom, email, tel, password)
                                        VALUES (0, :nom, :prenom, :email, :tel, :password)");
            $requete->execute(array(
                "nom" => $this->proprietaire->getNom(),
                "prenom" => $this->proprietaire->getPrenom(),
                "email" => $this->proprietaire->getEmail(),
                "tel" => $this->proprietaire->getTel(),
                "password" => $motDePasseCrypte
            ));

            $this->connection = null;
            $_SESSION['inscriptionSuccess'] = 'Le proprietaire a été enregistré avec succès !';

        } catch (Exception $ex) {
            $_SESSION['errors_save'] = 'Impossible d\'enregistrer les données, veuillez contacter le support !'.$ex;
        }
    }

    /* public function update(){
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
    } */
        
    
    public function getAll(){
        $requete = $this->connection->prepare("SELECT * FROM " . $this->table);
        $requete->execute();
        $resultats = $requete->fetchAll();
        $this->connection = null;
        return $resultats;
    }
    
    public function getByColumn($column, $value){
        $requete = $this->connection->query("SELECT * FROM " . $this->table ." WHERE ".$column." = '".$value."'");
        $resultat = $requete->fetchAll();        
        return $resultat;
    }
}
