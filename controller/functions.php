
<?php

/*------------------------------------------------------------------------------------------------------------------------------------------------------------------
 *   Verifie l'argument de l'url et retourne la valeur en minuscule
 *   @return string
 * ------------------------------------------------------------------------------------------------------------------------------------------------------------------
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
