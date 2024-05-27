<?php

namespace Model;

class Database
{
    // connection à la base de données
    private $host = "localhost";
    private $db_name = "vente_de_patisserie_1";
    private $username = "root";
    private $password = "";
    private $connection = null;

    // getter pour la connetion
    //public: Cela signifie que la méthode peut être appelée depuis n'importe où, c'est-à-dire depuis l'intérieur de la classe comme de l'extérieur.
    public function bddConnect()
    {
        try {
            //new \PDO(): Crée une nouvelle instance de la classe PDO pour se connecter à une base de données.
            //$this->username, $this->password: Ces paramètres fournissent le nom d'utilisateur et le mot de passe pour la connexion à la base de données.
            $pdo = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);

// setAttribute: Cette méthode de PDO configure des attributs sur l'objet PDO.
// \PDO::ATTR_ERRMODE: Cet attribut détermine le mode de rapport des erreurs.
// \PDO::ERRMODE_EXCEPTION: Cette constante spécifie que PDO doit lancer des exceptions en cas d'erreur. Cela permet de gérer les erreurs de manière plus flexible et propre.
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Cela assigne l'instance PDO créée à une propriété de l'objet appelée connetion (probablement une faute de frappe, ce devrait être connection).
            $this->connection = $pdo;

        } catch (\PDOException $exception) {
            echo "Erreur de connetion : " . $exception->getMessage();
        }
 //catch (\PDOException $exception): Capture les exceptions de type PDOException qui peuvent être lancées lors de la tentative de connexion.
// echo "Erreur de connetion : " . $exception->getMessage();: Affiche un message d'erreur comprenant le message de l'exception, ce qui peut aider à déboguer les problèmes de connexion.

        return $this->connection;
    }
}
//La méthode retourne l'objet de connexion PDO, qu'il soit nouvellement créé ou déjà existant.