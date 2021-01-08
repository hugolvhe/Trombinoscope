

<?php
/*
 *                              T O D O
 *      x   Gestion de la case
 *      x   Docs
 *      x   gestion des doublons/recher par Ids
 *      x   Images
 *      x   Recherche par nom et prenom
 *          Gerer les exceptions,erreurs
 *          Ajouter htmlspecialchar/entities 
 */


require_once "./controller/functions.php";
require_once "./controller/controller.php";

/*
 *   Route les requetes vers le bon controlleur    
 *   @param array $users_model
 *   Liste de toutes les personnes sert de BDD (model)
 *   @return void
 */
function main($users_model):void
{
    $argUrl = checkArgUrl();
    $expire = time() - 3600;
    $beginPath = "./usersCache/";
    $path = $beginPath . $argUrl . ".txt";
    $idsCacheFile = [];

    if ($argUrl === "all") {
        exit(pageAcceuil($users_model));
    }

    // Recherche par ID -> pageDescription
    if (is_numeric($argUrl)) {
        $argUrlToInt = intval($argUrl);
        if ($argUrlToInt < 0 || $argUrlToInt > count($users_model) - 1) {
            exit(pageError($argUrl));
        }
       exit(pageDescription($users_model,$argUrl));
    }

    // Donnees valides dans un fichier: recuperation
    if (checkIfCached($path, $expire)) {
        formatCache($path, $idsCacheFile);
    }
    // Pas de fichier cache
    else {
        $userIds = getIds($users_model, $argUrl);
        if (!setCache($userIds, $path)) {
            exit(pageError($argUrl));
        }
        formatCache($path, $idsCacheFile);
    }
    exit(pageResearch($users_model, $idsCacheFile));
};
main($users_model);




