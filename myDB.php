<?php

class myDB
{
    private $db;

    /**
     * @param $db
     */
    public function __construct()
    {
        $this->db = new PDO("mysql:host=127.0.0.1;dbname=favoritelinks;charset=UTF8", "root", "");
    }


    function displayLinks()
    {
        $stmt = $this->db->prepare("SELECT * FROM links");
        $stmt->execute();
        return $stmt;
    }

    function getAllCategories()
    {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt;
    }

    function getCategorie($idCategorie)
    {
        $stmt = $this->db->prepare("SELECT * FROM links WHERE fkCategory = :id ORDER BY linkNom");
        $stmt->bindValue(':id', $idCategorie);
        $stmt->execute();
        return $stmt;
    }

    function checkCategorieEmpty($idCategorie)
    {
        $stmt = $this->db->prepare("SELECT * FROM links INNER JOIN categories c on links.fkCategory = c.idCategory WHERE idCategory = :id");
        $stmt->bindValue(':id', $idCategorie);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return True;
        } else {
            return False;
        }
    }

    function addCategory($nom, $url, $category){
        $stmt = $this->db->prepare("INSERT INTO favoritelinks.links (linkNom, linkUrl, fkCategory) VALUES (:nom, :url, :fkCategory)");
        $stmt->bindValue(':fkCategory', $category);
        $stmt->bindValue(':url', $url);
        $stmt->bindValue(':nom', $nom);
        $stmt->execute();
    }

}