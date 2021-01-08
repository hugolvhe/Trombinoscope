<?php
require_once "./model/model.php";

/*
 *   Lie le model et la vue pour la page d'acceuil
 *   @param array $users_model
 *   Tableau de tout les utilisateurs (model)
 *   @return void
 */

function pageAcceuil($users_model):void 
{
    $users_controller = getPersons($users_model);
    require_once "./views/affichageAcceuil.php";
}

/*
 *   Lie le model et la vue pour la page de description
 *   @param array $users_model
 *   Tableau de tout les utilisateurs (model)
 *   @param int $id_user
 *   id de la personne
 *   @return void
 */
function pageDescription($users_model,$id_user):void 
{
    $users_controller = getPerson($users_model,$id_user);
    require_once "./views/affichageDescription.php";        
}


/*
 *   Lie le model et la vue pour la page de recherche
 *   @param array $users_model
 *   Tableau de tout les utilisateurs (model)
 *   @param array $ids
 *   Ids recuperer du fichier cache
 *   @return void
 */

function pageResearch(array $users_model, array $idsCacheFile):void
{
    $users_controller = [];
    for ($i = 0; $i < count($idsCacheFile) - 1; $i++) {
        array_push($users_controller,getPerson($users_model, $idsCacheFile[$i]));
    }
    require_once "./views/affichageRecherche.php";
}


/*
 *   Lie le model et la vue pour la page d'erreur
 *   @param string $argUrl
 *   Input utilisateur
 *   @return void
 */
function pageError($argUrl):void
{   
    $input_user = htmlspecialchars($argUrl);
    require_once "./views/affichageErreur.php";
}

