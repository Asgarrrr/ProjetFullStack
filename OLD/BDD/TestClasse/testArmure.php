<?php
//DEV BY GARNON
include("../../header.php");
include("../Armure.php");
$reqArmure = $Bdd->query("SELECT * FROM armure");
$reqDel = $Bdd->query("SELECT * FROM armure");
?>
<!-- Choix du heros et choix de l'armure à équiper -->
<form action="" method="post">
    <select name="Listeheros">
        <?php
        $reqAssos = $Bdd->query("SELECT * FROM assochero WHERE id_user = 1");
        while ($info = $reqAssos->fetch()) {
            $reqHero = $Bdd->query('SELECT * FROM hero WHERE id_hero = ' . $info['id_hero'] . '');
            $heroinfo = $reqHero->fetch();
            $reqTypehero = $Bdd->query('SELECT * FROM typehero WHERE id_typehero = '.$heroinfo['id_typehero'].'');
            $typeheroinfo = $reqTypehero->fetch();
            echo "<option value=" . $info['id_hero'] . ">" . $typeheroinfo['nom'] . "</option>";
        } ?>
    </select>
    <select name="Listearmures">
        <?php
        while ($infoarmure = $reqArmure->fetch()) {
            echo "<option value=" . $infoarmure['id_armure'] . ">" . $infoarmure['nom'] . "</option>";
        } ?>
    </select>
    <input type="submit" name="submitarmure">
</form>
<form action="" method="post">
    Nom de l'armure :
    <input type="text" name="nomCrea">
    Prix de l'armure :
    <input type="text" name="prixCrea">
    Durabilite de l'armure :
    <input type="text" name="durabiliteCrea">
    Defense de l'armure :
    <input type="text" name="defenseCrea">
    <input type="submit" name="submitCrea">
</form>
<form action="" method="post">
    <select name="listeDel">
        <?php
        while ($infoDel = $reqDel->fetch()) {
            echo "<option value=" . $infoDel['id_armure'] . ">" . $infoDel['nom'] . "</option>";
        } ?>
    </select>

    <input type="submit" name="submitDel">
</form>
<?php
// Equipement de l'armure
if (isset($_POST['submitarmure'])) {
    $armure = new Armure($Bdd, $_POST['Listearmures'], 0);
    echo "Le nom de l'armure est : " . $armure->getNom() . ", elle coûte " . $armure->getPrix() . "€, elle fait " . $armure->getDefense() . " de defense et est à " . $armure->getDurabilite() . "%";
    echo "<br>Armure équipée";
    $armure->equiperArmure(1, $_POST['Listeheros']);
}
//Suppression de l'armure
if (isset($_POST['submitDel'])) {
    $armureDel = new Armure($Bdd, $_POST['listeDel'], 0);
    $armureDel->deleteArmure();
}
// Creation de l'armure
if (isset($_POST['submitCrea'])  && !empty($_POST['nomCrea']) && !empty($_POST['prixCrea']) && !empty($_POST['durabiliteCrea']) && !empty($_POST['defenseCrea'])) {
    $armureCree = new Armure($Bdd, NULL, 1);
    echo "<br>armure créée";
    $armureCree->createArmure($_POST['nomCrea'], $_POST['prixCrea'], $_POST['durabiliteCrea'], $_POST['defenseCrea']);
}
?>