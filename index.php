<?php
/*
 *                              T O D O
 *      x   Gestion de la case
 *      x   Docs
 *      x   gestion des doublons/recher par Ids
 *      x   Images
 *      x   Recherche par nom et prenom
 *      x   Gerer les exceptions,erreurs
 *      x   Ajouter htmlspecialchar/entities 
 */
require_once "./controller/functions.php";
require_once "./controller/controller.php";

/*
 *   Route les requetes vers le bon controlleur    
 *   @return void
 */
function main():void
{
    if(isset($_GET["delete"])) {
        exit(deletePersonsController());
    }

    if(isset($_GET["fill"])) {
        exit(insertPersonsController());
    }
    $argUrl = checkArgUrl();
    if ($argUrl === "all") {
        exit(pageAcceuil());
    }
    // recherche par ID
    if (is_numeric($argUrl)) {
        $argUrlToInt = intval($argUrl);
        exit(pageDescription($argUrlToInt));
    }
    exit(pageResearch($argUrl));
};
main();




