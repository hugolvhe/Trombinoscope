<?php
DEFINE("SERVEUR", "localhost");
DEFINE("PORT", "3306");
DEFINE("DATABASE", "trombinoscope");
DEFINE("DB_USERNAME", "admin_trombi");
DEFINE("DB_PASSWORD", "admin_trombi");
DEFINE("DB_CONNEXION", "mysql:host=" . SERVEUR . ":" . PORT . ";dbname=" . DATABASE);

/*
 *   Requete d'insertion de la liste des personnes en BDD
 *   @return void
 */
function insertPersonsModel(): void
{
    $persons = [
        [
            "surname" => "Romain",
            "name" => "Naimor",
            "descr" => "Recherche voyage dans l'espace",
        ],
        [
            "surname" => "Alexandre",
            "name" => "Erdnaxela",
            "descr" => "Chaussete showman",
        ],
        [
            "surname" => "Alexandre",
            "name" => "A",
            "descr" => "El Professor",
        ],
        [
            "surname" => "Khang",
            "name" => "Gnakh",
            "descr" => "Big Bang Gang",
        ],
        [
            "surname" => "Alexis",
            "name" => "Sixela",
            "descr" => "Alexis = isTernaire() ? happy : sad",
        ],
        [
            "surname" => "Corinne",
            "name" => "Enniroc",
            "descr" => "Le CSS de la vie",
        ],
        [
            "surname" => "Elisa",
            "name" => "Asile",
            "descr" => "Viszlát",
        ],
        [
            "surname" => "Florian",
            "name" => "Nairolf",
            "descr" => "Lebron James Junior",
        ],
        [
            "surname" => "Hugo",
            "name" => "Oguh",
            "descr" => "Vive les Gifs",
        ],
        [
            "surname" => "Jerome",
            "name" => "Del Mareo",
            "descr" => "AS 'Patrice'",
        ],
        [
            "surname" => "Patricia",
            "name" => "Aicitrap",
            "descr" => "En attente de la fibre...",
        ],
        [
            "surname" => "Remy",
            "name" => "Ymer",
            "descr" => "Bientot le permis",
        ],
    ];
    try {
        $lDBO = new PDO(DB_CONNEXION, DB_USERNAME, DB_PASSWORD);
        $lDBO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configuration de la remontée d'erreur
        $requestSql = $lDBO->prepare("INSERT INTO user(`name`,`surname`,`descr`,`image`) VALUES (:name0,:surname0,:descr0,:image0),
                                                                                                (:name1,:surname1,:descr1,:image1),
                                                                                                (:name2,:surname2,:descr2,:image2),
                                                                                                (:name3,:surname3,:descr3,:image3),
                                                                                                (:name4,:surname4,:descr4,:image4),
                                                                                                (:name5,:surname5,:descr5,:image5),
                                                                                                (:name6,:surname6,:descr6,:image6),
                                                                                                (:name7,:surname7,:descr7,:image7),
                                                                                                (:name8,:surname8,:descr8,:image8),
                                                                                                (:name9,:surname9,:descr9,:image9),
                                                                                                (:name10,:surname10,:descr10,:image10),
                                                                                                (:name11,:surname11,:descr11,:image11)
                                    ;");
        foreach ($persons as $key => $value) {
            $requestSql->bindValue(":name" . $key, strtolower($value["name"]), PDO::PARAM_STR);
            $requestSql->bindValue(":surname" . $key, strtolower($value["surname"]), PDO::PARAM_STR);
            $requestSql->bindValue(":descr" . $key, $value["descr"], PDO::PARAM_STR);
            $requestSql->bindValue(":image" . $key, "./images/" . strtolower($value["surname"]) . $key . ".png", PDO::PARAM_STR);
        }
        $requestSql->execute();
        $lDBO = null;
    } catch (PDOEXCEPTION $e) {
        exit("Erreur" . $e->getMessage() . "</br>");
    }
};

/*
 *   Requete de supression, vide la table
 *   @return void
 */
function deletePersonsModel(): void
{
    try {
        $lDBO = new PDO(DB_CONNEXION, DB_USERNAME, DB_PASSWORD);
        $lDBO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $lDBO->exec("TRUNCATE TABLE user");
        $lDBO = null;
    } catch (PDOEXCEPTION $e) {
        exit("Erreur" . $e->getMessage() . "</br>");
    }
};

/*
 *   Retourne les infos sur une personne
 *   @param int $idUser
 *   id de la personne
 *   @return array
 *   infos de la personne
 */
function getPersonById(int $idUser): array
    {
    try {
        $lDBO = new PDO(DB_CONNEXION, DB_USERNAME, DB_PASSWORD);
        $lDBO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requestSql = $lDBO->prepare("SELECT * FROM user WHERE `id` = :idUser LIMIT 1");
        $requestSql->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $requestSql->execute();
        $usersModel = $requestSql->fetch(PDO::FETCH_ASSOC);
        $lDBO = null;
    } catch (PDOEXCEPTION $e) {
        exit("Erreur" . $e->getMessage() . "</br>");
    }
    if(!$usersModel) {
        $usersModel = [];
    }
    return $usersModel;
};

/*
 *   Requete de selection pour trouver des personnes par nom ou prenom
 *   @param string $stringUser
 *   nom,prenom recherché
 *   @return array
 *   liste des personnes trouvé
 */
function getPersonsByString(string $stringUser)
{
    try {
        $lDBO = new PDO(DB_CONNEXION, DB_USERNAME, DB_PASSWORD);
        $lDBO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requestSql = $lDBO->prepare("SELECT * FROM user WHERE `name` = :nameUser OR `surname` = :surnameUser LIMIT 5000");
        $requestSql->bindParam(":nameUser", $stringUser, PDO::PARAM_STR);
        $requestSql->bindParam(":surnameUser", $stringUser, PDO::PARAM_STR);
        $requestSql->execute();
        $usersModel = $requestSql->fetchAll(PDO::FETCH_ASSOC);
        $lDBO = null;
    } catch (PDOEXCEPTION $e) {
        die("Erreur" . $e->getMessage() . "</br>");
    }
    return $usersModel;
};

/*
 *  Requete de selection pour recuperer toutes les personnes
 *  @return array
 *  liste de toute les personnes
 */
function getAllPersons(): array
{
    try {
        $lDBO = new PDO(DB_CONNEXION, DB_USERNAME, DB_PASSWORD);
        $lDBO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requestSql = $lDBO->prepare("SELECT * FROM user");
        $requestSql->execute();
        $usersModel = $requestSql->fetchAll();
        $lDBO = null;
    } catch (PDOEXCEPTION $e) {
        die("Erreur" . $e->getMessage() . "</br>");
    }
    return $usersModel;
};
