<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./views/style/style.css">
    <script src="./controller/JS/trombinoscope.js" async></script>
    <title>Trombinoscope Dev'Engers</title>
</head>
    <header>
        <div class="logo">
            <img src="./images/logo.png " class="img_logo">
            <h1>Dev'Engers</h1>
        </div>
        <h2>Trombinoscope </h2>
        <div class="formulaire">
            <label for="recherche">Rechercher quelqu'un:</label>
            <form>
                <input type="search" name="arg" class="champs">
                <input type="submit" class="envoyer">
                <button name="fill" class="envoyer">Remplir</button>
                <button name="delete" class="envoyer">Vider</button>
            </form>
        </div>
    </header>
    <body>
        <div class="containeur">
                <?php
                    $usersView = $usersController; 
                    unset($usersController);
                    foreach($usersView as $user) {
                ?>
                    <div class="person <?=htmlspecialchars($user["surname"])?>"> 
                        <h3 id="<?= htmlspecialchars($user["id"])?>"><?=htmlspecialchars($user["surname"])." ". htmlspecialchars($user["name"])?></h3>
                        <img src="<?=htmlspecialchars($user['image'])?>"/> 
                        <p class='none'><?=htmlspecialchars($user["desc"])?></p> 
                    </div>                    
                <?php
                    };
               ?>
        </div>
    </body>
</html>