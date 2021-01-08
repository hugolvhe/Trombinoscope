
<?php

/*
 *   @return string
 */
function checkArgUrl(): string
{
    // Arg de l'url SET et egal a "0"
    if (isset($_GET["arg"]) && $_GET["arg"] === "0") {
        return (string) strtolower($_GET["arg"]);
    }
    // Arg de l'url SET avec valeur
    elseif ((isset($_GET["arg"]) && !empty($_GET["arg"]))) {
        return (string) strtolower($_GET["arg"]);
    }
    // Arg de l'url n'est pas SET
    else if (!isset($_GET["arg"])) {
        return "all";
    }
    // Arg de l'url SET et vide
    else if (isset($_GET["arg"]) && empty($_GET["arg"])) {
        return "all";
    }
}

/*
 *   Verifie si un utilisateur a deja ete recherche donc stocké en cache
 *   @param string $path
 *   Chemin du fichier 
 *   @param int $expire
 *   temps d'expiration
 *   @return boolean
 */
function checkIfCached(string $path, int $expire)
{
    if (file_exists($path) && filemtime($path) > $expire) {
        return true;
    }
    return false;
}

/*
 *   Deserialize le contenu du cache(fichier)
 *   @param string $path
 *   Chemin vers le fichier
 *   @param string $userCache (ref)
 *   Variable pour stocker les ids trouvés dans le fichier
 */
function formatCache(string $path, array &$userCache): void
{
    $userCache = explode(",", file_get_contents($path));
}

/*
 *   Ecrit les ids d'utilisateur dans un fichier
 *   @param array $usersIds
 *   Tableau de tout les utilisateurs
 *   @param array $path
 *   Le chemin pour stocker le fichier cache de la personne
 *   @return bool
 */
function setCache($userIds, $path): bool
{
    if (empty($userIds)) {
        return false;
    } else {
        file_put_contents($path, $userIds);
        return true;
    };
}


