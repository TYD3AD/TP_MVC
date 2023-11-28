<?php

namespace models;

use models\base\SQL;
use models\classes\Client;


class ClientsModele extends SQL
{
    public function __construct()
    {
        parent::__construct('client', 'id');
    }

    /**
     * Liste les clients présents en base de données
     * @param int $limit
     * @param int $page
     * @return Client[]
     */
    public function liste(int $limit = PHP_INT_MAX, int $page = 0): array
    {
        $query = "SELECT * FROM client LIMIT :limit,:offset;";

        $stmt = SQL::getPdo()->prepare($query);
        $stmt->execute([":limit" => $limit * $page, ":offset" => $limit]);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, Client::class);
    }

    /**
     * Retourne une liste de client correspondant au critère de recherche
     * @param string $keyword
     * @param int $limit
     * @param int $page
     * @return Client[]
     */
    public function recherche(string $keyword = "", int $limit = PHP_INT_MAX, int $page = 0): array
    {
        $query = "SELECT * FROM client WHERE nom LIKE :nom OR prenom like :prenom OR email like :email LIMIT :limit,:offset;";

        $stmt = SQL::getPdo()->prepare($query);
        $stmt->execute([
            ":nom" => "%$keyword%",
            ":prenom" => "%$keyword%",
            ":email" => "%$keyword%",
            ":limit" => $limit * $page,
            ":offset" => $limit
        ]);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, Client::class);
    }

    /**
     * Ajoute un nouveau client en base de données
     * @param Client $unClient
     * @return bool|string
     */
    public function creerClient(Client $unClient): bool|string
    {
        $query = "INSERT INTO client (id, nom, prenom, email, telephone) VALUES (null, ?, ?, ?, ?)";
        $stmt = SQL::getPdo()->prepare($query);
        $stmt->execute([$unClient->getNom(), $unClient->getPrenom(), $unClient->getEmail(), $unClient->getTelephone()]);

        return $this->getPdo()->lastInsertId();
    }

    public function getByClientId($clientId): Client
    {
        $query = "SELECT * FROM client WHERE id = ?";
        $stmt = SQL::getPdo()->prepare($query);
        $stmt->execute([$clientId]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Client::class);
        return $stmt->fetch();
    }

    public function nbPagesTotal($nbLignesParPage)
    {
        $query = "SELECT COUNT(id) AS nblignes FROM client;";
        $stmt = SQL::getPdo()->prepare($query);
        $stmt->execute();
        $nblignes = $stmt->fetch();

        $nbpages = ceil($nblignes['nblignes'] / $nbLignesParPage); // Utilisation de la fonction ceil pour arrondir vers le haut si nécessaire

        return $nbpages;
    }

    public function infos($id)
    {
        $query = "SELECT * FROM client WHERE id = ?";
        $stmt = SQL::getPdo()->prepare($query);
        $stmt->execute([$id]);
        $infos = $stmt->fetchObject(\stdClass::class);
        return $infos;
    }

    public function produits($id)
    {
        $query = "SELECT * FROM produit p INNER JOIN commander c ON p.id=c.idProduit INNER JOIN client cl ON c.idClient=cl.id WHERE cl.id = ?";
        $stmt = SQL::getPdo()->prepare($query);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, \stdClass::class);
        $stmt->execute([$id]);
        $produits = $stmt->fetchAll();

        return $produits;
    }

    public function adresses($id)
    {
        $query = "SELECT a.* FROM adresse a INNER JOIN client c ON a.clientID=c.id WHERE c.id = ?";
        $stmt = SQL::getPdo()->prepare($query);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, \stdClass::class);
        $stmt->execute([$id]);
        $adresses = $stmt->fetchAll();

        return $adresses;
    }

    public function supprimerAdresse($id)
    {
        $query = "DELETE FROM adresse WHERE id = ?";
        $stmt = SQL::getPdo()->prepare($query);
        $stmt->execute([$id]);
    }

    public function commander($id, $nom, $description, $prix)
    {
        try {
            $query = "INSERT INTO produit (id, nom, description, prix) VALUES (null, ?, ?, ?)";
            $stmt = SQL::getPdo()->prepare($query);
            $stmt->execute([$nom, $description, $prix]);
            $idProduit = $this->getPdo()->lastInsertId();

            $query = "INSERT INTO commander (idProduit, idClient, date) VALUES (?, ?, NOW())";
            $stmt = SQL::getPdo()->prepare($query);
            $stmt->execute([$idProduit, $id]);

            return true;
        } catch (\Exception $e) {
            
            return $e->getMessage();

        }
    }

    public function adresse($id, $nom, $rue, $codePostal, $ville)
    {
        try {
            $query = "INSERT INTO adresse (id, nom, rue, codePostal, ville, clientId) VALUES (null, ?, ?, ?, ?, ?)";
            $stmt = SQL::getPdo()->prepare($query);
            $stmt->execute([$nom, $rue, $codePostal, $ville, $id]);
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();

        }
    }

}
