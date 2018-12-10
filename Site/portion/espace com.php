<?php

?><!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="">
<meta charset="utf-8">
<head>
    <title></title>
</head>
<body>

<form method="post" action="">
    <?php
    if (isset($_POST['commentaire'])) {

        $comment = htmlspecialchars($_POST['commentaires']);

        if (!empty($_POST['sondage']) && !empty($_POST['commentaires'])) {

            $insertcom = $bdd->prepare("INSERT INTO espace_commentaire(id_planete, id_membre, sondage, commentaires) VALUES(2 , :id_membre, :sondage, :commentaire)");
            $insertcom->execute(array(
                'id_membre' => $_SESSION['id_membre'],
                'sondage' => $_POST['sondage'],
                'commentaire' => $_POST['commentaires']
            ));
        }
    }
    ?>
    <p> L'article etait t'il pértinant?
        <input type="radio" name="sondage" value="oui" id="oui">
        <label for="oui"> oui </label>
        <input type="radio" name="sondage" value="moyen" id="moy">
        <label for="moy">moyennement</label>
        <input type="radio" name="sondage" value="non" id="non">
        <label for="non">non</label>
    </p>

    <label style="color: #FFFFFF" for="commentaire">Déposer un commentaire:</label>
    <br>
    <textarea name="commentaires" id="commentaire" rows="5" cols="50"></textarea>
    <br>
    <input class="envoyer" type="submit" value="Envoyer" name="commentaire">
</form>

<?php
$reqcom = $bdd->query("SELECT espace_membre.nom, espace_membre.prenom, planete.nom_planete, sondage, commentaires FROM espace_commentaire INNER JOIN planete ON espace_commentaire.id_planete = planete.id_planete INNER JOIN espace_membre ON espace_commentaire.id_membre = espace_membre.id_membre WHERE planete.id_planete = 2");
while ($com = $reqcom->fetch()) {
    echo("<font color='white'>" . $com['nom'] . " " . $com['prenom'] . "</font><br>");
    echo("<font color=\"white\">" . $com['sondage'] . "<br> " . $com['commentaires'] . "</font><br>");
}
$reqcom->closeCursor();
?>
</body>
</html>
