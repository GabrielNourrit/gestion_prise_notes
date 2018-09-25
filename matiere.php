<?php
include("./inc/header.php");  
  if(!isset($_POST['nom'])){
      echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'" id="myform">';
   ?>
<table>
<tr><td>Nom</td><td><input type="text" name="nom" required/></td></tr>
<tr><td>Surnom</td><td><input type="text" name="surnom" required/></td></tr>
<tr><td>Semestre</td><td><input type="text" name="semestre" placeholder="1, 2, 3 ?" required/></td></tr>
<tr><td>Type</td><td><input type="text" name="type" placeholder="TD, TP, CM ?" required/></td></tr>
<tr><td><input type="submit" value="submit"/></td></tr>
</table>
</form>

<?php
  }else{
      
      $query=$db->prepare("INSERT INTO matiere(nom,surnom,semestre,type) VALUES (:nom,:surnom,:semestre,:type)");
      $query->bindValue(':nom',$_POST['nom'],PDO::PARAM_STR);
      $query->bindValue(':surnom',$_POST['surnom'],PDO::PARAM_STR);
      $query->bindValue(':semestre',$_POST['semestre'],PDO::PARAM_INT);
      $query->bindValue(':type',$_POST['type'],PDO::PARAM_STR);
      $query->execute();
      $query->closeCursor();
      $nom=$_POST['surnom'].'_'.$_POST['type'].'_S'.$_POST['semestre'];
      $cree = "CREATE TABLE ".$nom."(id int auto_increment,contenu longtext,primary key(id))ENGINE=InnoDb";
      $reception=$db->exec($cree);
      if($reception!== false)
          echo' <p>Matiere ajoutée !</p>';
      else
          echo'<p>Un probleme est survenue lors de l ajout !</p>';
      
  }
include("./inc/footer.php");   
?>