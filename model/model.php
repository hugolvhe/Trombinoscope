<?php
// Use as BDD
$users_model = [];
$persons = [
    [
        "prenom" => "Romain",
        "nom" => "Naimor",
        "desc" => "Recherche voyage dans l'espace",
    ],
    [
        "prenom" => "Alexandre",
        "nom" => "Erdnaxela",
        "desc" => "Chaussete showman",
    ],
    [
        "prenom" => "Alexandre",
        "nom" => "A",
        "desc" => "El Professor",
    ],
    [
        "prenom" => "Khang",
        "nom" => "Gnakh",
        "desc" => "Big Bang Gang",
    ],
    [
        "prenom" => "Alexis",
        "nom" => "Sixela",
        "desc" => "Alexis = isTernaire() ? happy : sad",
    ],
    [
        "prenom" => "Corinne",
        "nom" => "Enniroc",
        "desc" => "Le CSS de la vie",
    ],
    [
        "prenom" => "Elisa",
        "nom" => "Asile",
        "desc" => "Viszlát",
    ],
    [
        "prenom" => "Florian",
        "nom" => "Nairolf",
        "desc" => "Lebron James Junior",
    ],
    [
        "prenom" => "Hugo",
        "nom" => "Oguh",
        "desc" => "Vive les Gifs",
    ],
    [
        "prenom" => "Jerome",
        "nom" => "Del Mareo",
        "desc" => "AS 'Patrice'",
    ],
    [
        "prenom" => "Patricia",
        "nom" => "Aicitrap",
        "desc" => "En attente de la fibre...",
    ],
    [
        "prenom" => "Remy",
        "nom" => "Ymer",
        "desc" => "Bientot le permis",
    ],
    [
        "prenom" => "Remy",
        "nom" => "Ymer",
        "desc" => "Bientot le permis",
    ],
];

/*
 *   Genere les personnes a partir de la liste des utilisateurs       
 *   @param array $users                                         
 *   Tableau qui va contenir les personnes                  
 *   @param array $persons                                       
 *   Liste des prenoms infos de personnes                                   
 *   @return void                                                                                                      
 */
function generatePersons(array &$users_model, array $persons): void
{
    $i = 0;
    foreach ($persons as $person) {
        $prenom = $person["prenom"];
        $user = [
            "id" => $i,
            "prenom" => $prenom,
            "img" => "./images/" . $prenom . $i . ".png alt=" . $prenom,
            "salut" => "Salut, c'est " . $prenom . "!",
            "nom" => $person["nom"],
            "desc" => $person["desc"],
        ];
        array_push($users_model, $user);
        $i++;
    }
};

/*
 *   Retourne les infos sur un utilisateur au format HTML
 *   @param array $user_model
 *   Tableau de tout les utilisateurs
 *   @param int $idUser
 *   index de l'utilisateur dans le tableau
 *   @return array
 */
function getPerson(array $users_model, int $idUser): array
{
    return ($users_model[$idUser]);
};

/*
 *  Retourne les infos de touts les eleves 
 *  @param array $users_model
 *  Tableau de tout les utilisateurs (model)
 *  @return array
 */
function getPersons(array $users_model):array
{
    $infosUsers = [];
    foreach ($users_model as $indexUser => $userInfos) {
        array_push($infosUsers, getPerson($users_model, $indexUser));
    }
    return $infosUsers;
}

/*
 *   Retourne les ids d'une recherche d'utilisateur depuis le tableau
 *   @param array $users
 *   Tableau de tout les utilisateurs
 *   @param string
 *   Nom ou prenom de l'utilisateur
 *   @return array
 */
function getIds(array $users_model, string $argUrl):array
{
    $result = [];
    $count = 0;
    foreach ($users_model as $user => $userInfos) {
        if ($argUrl == strtolower($userInfos["prenom"]) || $argUrl == strtolower($userInfos["nom"])) {
            array_push($result, $user . ",");
        }
    }
    return $result;
};
generatePersons($users_model, $persons);