<?php

namespace App\Models;

use CodeIgniter\Model;
use \PDO;

class HomeModel extends Model
{
    // On est obligé de définir la table par défaut pour CodeIgniter, pour passer par PDO
    protected $table = "fichefrais";

    // Variables PDO
    // Base de données
    protected static $bdd;
    protected static $bddName;
    protected static $bddHost = "mysql:host=localhost;dbname=gsbv2;charset=utf8";
    protected static $bddLogin = "root";
    protected static $bddPassword = "password";
    // Tables utilisées
    protected static $visiteur = "visiteur";
    protected static $ficheFrais = "fichefrais";

    public static function connexionBDD()
    {
        $bdd = new PDO(HomeModel::$bddHost, HomeModel::$bddLogin, HomeModel::$bddPassword);
        self::$bdd = $bdd;

        return $bdd;
    }

    public static function verifLogin($login)
    {
        $reponse = self::$bdd->prepare('SELECT * FROM gsbv2.visiteur WHERE login = ?');
        $reponse->execute(array($login));
        if ($reponse->rowCount() < 1)
        {
            $login = "";
        }
        return $login;
    }

    public static function verifPassword($mdp)
    {
        $reponse = self::$bdd->prepare('SELECT * FROM gsbv2.visiteur WHERE mdp = ?');
        $reponse->execute(array($mdp));
        if ($reponse->rowCount() < 1)
        {
            $mdp = "";
        }
        return $mdp;
    }

    public static function getIdUtilisateur($login)
    {
        // Récupération de l'ID
        $reponse = self::$bdd->prepare('SELECT id FROM gsbv2.visiteur WHERE login = ?');
        $reponse->execute(array($login));
        $id = $reponse->fetch()[0];
        return $id;
    }

    public static function getNomUtilisateur($login)
    {
       // Récupération du nom
       $reponse = self::$bdd->prepare('SELECT nom FROM gsbv2.visiteur WHERE login = ?');
       $reponse->execute(array($login));
       $nom = $reponse->fetch()[0];
       return $nom; 
    }

    public static function getPrenomUtilisateur($login)
    {
       // Récupération du nom
       $reponse = self::$bdd->prepare('SELECT prenom FROM gsbv2.visiteur WHERE login = ?');
       $reponse->execute(array($login));
       $prenom = $reponse->fetch()[0];
       return $prenom; 
    }

    public static function getReponse()
    {
        $reponse = self::$bdd->prepare('SELECT * FROM gsbv2.FicheFrais WHERE FicheFrais.mois = ?');
        return $reponse;
    }

    public static function getFicheFrais($mois)
    {
        $reponse = self::$bdd->prepare('SELECT * FROM gsbv2.FicheFrais WHERE FicheFrais.mois = ?');
        $reponse->execute(array($mois));
        return $reponse;
    }

    public static function supprimerLigne($bdd, $id)
    {
        $reponse = $bdd->prepare('DELETE FROM gsbv2.FicheFrais WHERE idFrais = ?');
	    $reponse->execute(array($id));
    }
}