<?php
include("./inc/header.php");
if(isset($_GET['matiere'])){
$query=$db->prepare("SELECT contenu from ".$_GET['matiere']);
$query->execute();
  while($it=$query->fetch()){
    echo $it['contenu']."<br/>";
  }
$query->closeCursor();
}else
    echo'<p>ERREUR: probleme durant la lecture de la matiere voulue</p>'
?>





<?php
include("./inc/footer.php");
?>