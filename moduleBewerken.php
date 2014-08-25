<?php
require_once 'module.php';
require_once 'moduleLijst.php';

if(isset($_GET["action"]) && $_GET["action"] == "verwerk"){
    /*echo"bewerking state";
    echo"<br/>";
    echo"naam: ", $_POST["naam"];
    echo"<br/>";
    echo"prijs: ", $_POST["prijs"];
    echo"<br/>";*/
    $module = new Module($_GET["id"], $_POST["naam"], $_POST["prijs"]);
    $modLijst = new ModuleLijst();
    $modLijst->updateModule($module);
    $updated = true;
}else{
    $updated = false;
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <title>Modules</title>
    </head>
    <body>
        <h1>Module bewerken</h1>
        <?php
            if ($updated){
                print("Record bijgewerkt!");
                echo "<br/>";
            }
            //echo "lijn 27";
            $modLijst = new ModuleLijst();
            //echo "<br/>";
            //echo $_GET["id"];
            $module = $modLijst->getModuleById($_GET["id"]);
            $module->getNaam();
        ?>
        <form action="moduleBewerken.php?action=verwerk&id=<?php print($_GET["id"]);?>" method="post">
            Naam:
            <input type="text" name="naam" value="<?php print($module->getNaam()); ?> ">
            <br/><br/>
            Prijs:
            <input type="text" name="prijs" value="<?php print($module->getPrijs()); ?>"> 
            euro
            <br/>
            <input type="submit" value="Opslaan">
        </form>
        <br>
        <a href="overzicht.php">Terug naar overzicht</a>
    </body>
</html>