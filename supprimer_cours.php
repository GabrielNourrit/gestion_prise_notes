<?php
include("./inc/header.php");
//gestion des types de variables !
$matiere=substr($_POST['matiere'],1,-1);
$id=substr($_POST['id'],1,-1);
$id=$id+0;
$add=substr($_POST['add'],1,-1);
//operations correctes de suppression :
$stmt=$db->prepare("DELETE FROM ".$matiere." WHERE id=:id");
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$stmt->execute();
$stmt->closeCursor();
echo "page correctement supprimé !";
echo "revenir au cours <a href=lire_cours.php?matiere=".$add."&&id=".$id.">ici</a>";
include("./inc/footer.php");
?>