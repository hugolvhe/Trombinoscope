<?php
require_once "./model/model.php";

/*
 *   Lie le model et la vue pour la page d'acceuil
 *   @return void
 */
function insertPersonsController():void 
{   
    insertPersonsModel();
    exit(header("Location: ./"));
}

/*
 *   Lie le model et la vue pour la page d'acceuil
 *   @return void
 */
function deletePersonsController():void 
{   
    deletePersonsModel();
    exit(header("Location: ./"));
}

/*
 *   Lie le model et la vue pour la page d'acceuil
 *   @return void
 */
function pageAcceuil():void 
{
    $usersController = getAllPersons();
    exit(require_once("./views/affichageAcceuil.php"));
}

/*
 *   Lie le model et la vue pour la page de description
 *   @param int $id_user
 *   id de la personne
 *   @return void
 */
function pageDescription($idUser):void
{
    $usersController = getPersonById($idUser);
    if(empty($usersController)) {
        exit(require_once "./views/affichageErreur.php");
    }   
    exit(require_once "./views/affichageDescription.php");        
}


/*
 *   Lie le model et la vue pour la page de recherche ou page d'erreur si n'existe pas
 *   @param string $inputUser
 *   nom/prenom recherché
 *   @return void
 */
function pageResearch(string $inputUser):void
{
    $usersController = getPersonsByString($inputUser);
    if(empty($usersController)) {
        exit(require_once "./views/affichageErreur.php");
    }    
    exit(require_once "./views/affichageRecherche.php");
}



