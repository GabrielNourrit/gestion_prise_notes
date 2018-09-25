<?php
  include("./inc/header.php");
  
  $err=0;
  /*control du get*/
  if(!isset($_GET["matiere"])){
      echo "erreur lors du chargement de la matiere : matiere introuvable";
      $err=1;
  }
  /*debut de lire_cours*/
  if(isset($_GET["id"]))
      $id=$_GET["id"];
  else
      $id=1;
  
  if(!$err){
      $stmt=$db->prepare('SELECT id FROM '.$_GET["matiere"].' ORDER BY id DESC LIMIT 1');
      $stmt->execute();
      $max=$stmt->fetch();
      $stmt->closeCursor();
      if(!isset($max['id']))
          $max['id']=0;
      $stmt=$db->prepare('SELECT contenu FROM '.$_GET["matiere"].' WHERE id = :id');
      $stmt->bindValue(':id',$id,PDO::PARAM_INT);
      $stmt->execute();
      $data=$stmt->fetch();
      if($data['contenu']!=NULL){
          echo $data['contenu'];
?>
<br/><br/><hr/><div id="gestion" >
  <input type="button" value="<<" onclick="undo('<?php echo $_GET['matiere'] ?>',1)"/>
  <input type="button" value="<-" onclick="undo('<?php echo $_GET['matiere'] ?>',<?php echo $id ?>);" />
  <input type="button" value="->" onclick="next('<?php echo $_GET['matiere'] ?>',<?php echo $id ?>);" />
  <input type="button" value=">>" onclick="next('<?php echo $_GET['matiere'] ?>',<?php echo $max['id'] ?>)"/>
  <br/>
  <form method="post" action="supprimer_cours.php">
    <input type="hidden" name="matiere" value="'<?php echo $_GET["matiere"] ?>'"/>
    <input type="hidden" name="id" value="'<?php echo $_GET['id'] ?>'"/>
    <input type="hidden" name="add" value="'<?php echo $_GET['matiere'] ?>'"/>
    <input type="submit" value="-"/>  
  </form>
  <br/>
  <form method="post" action="ajouter_cours.php">
  <input type="hidden" name="matiere" value="'<?php echo $_GET["matiere"] ?>'"/>
  <input type="hidden" name="id" value="'<?php echo $_GET['id'] ?>'"/>
  <input type="hidden" name="add" value="'<?php echo $_GET['matiere'] ?>'"/>
  <input type="hidden" name="modifier" value="1"/>
  <input type="submit" value="edit"/>
</form>
  
</div>
<?php
      }else{
          if($id>0 && $id<$max['id']){
              echo "page vide (effacée)";
              echo '<br/><br/><hr/><div id="gestion" >';
              
?> <input type="button" value="<<" onclick="undo('<?php echo $_GET['matiere'] ?>',1)"/>
<input type="button" value="<-" onclick="undo('<?php echo $_GET['matiere'] ?>',<?php echo $id ?>)"/>
<input type="button" value="->" onclick="next('<?php echo $_GET['matiere'] ?>',<?php echo $id ?>)"/>
<input type="button" value=">>" onclick="next('<?php echo $_GET['matiere'] ?>',<?php echo $max['id'] ?>)"/>
<br/><form method="post" action="ajouter_cours.php">
  <input type="hidden" name="matiere" value="'<?php echo $_GET["matiere"] ?>'"/>
  <input type="hidden" name="id" value="'<?php echo $_GET['id'] ?>'"/>
  <input type="hidden" name="add" value="'<?php echo $_GET['matiere'] ?>'"/>
  <input type="submit" value="+"/>
</form>
<?php
          }
          if($id>$max['id']){
              echo "page vide";
              echo '<br/><br/><hr/><div id="gestion" >';
?> <input type="button" value="<<" onclick="undo('<?php echo $_GET['matiere'] ?>',1)"/>
<input type="button" value="<-" onclick="undo('<?php echo $_GET['matiere'] ?>',<?php echo $id ?>)"/>
<form method="post" action="ajouter_cours.php">
  <input type="hidden" name="matiere" value="'<?php echo $_GET["matiere"] ?>'"/>
  <input type="hidden" name="id" value="'<?php echo $_GET['id'] ?>'"/>
  <input type="hidden" name="add" value="'<?php echo $_GET['matiere'] ?>'"/><br/>
  <input type="submit" value="+"/>  
</form>
<?php
          }
          if($id<=0){
              $details=explode("_",$_GET['matiere']);
              $surnom=$details[0];
              $semestre=$details[2][1];
              $query=$db->prepare('SELECT nom FROM matiere WHERE surnom="'.$surnom.'" AND semestre="'.$semestre.'"');
              $query->execute();
              $nom=$query->fetch();
              $query->closeCursor();
              $up=strtoupper($nom["nom"]);
              echo '<div class=center >Université Grenoble Alpes</div><br/><div class="center">Nourrit Gabriel</div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><div class="subtitle center">'.$up.'</div><br/><div class=center >'.$details[2].' '.$details[1].'</div><br/><div class=center >L3 MIAGE</div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><div class=center >2017-2018</div>';
              echo '<br/><br/><hr/><div id="gestion" >';
?>
   <input type="button" value="->" onclick="next('<?php echo $_GET['matiere'] ?>',<?php echo $id ?>)"/>
   <input type="button" value=">>" onclick="next('<?php echo $_GET['matiere'] ?>',<?php echo $max['id'] ?>)"/><br/>
   <input type="button" value="PDF" onclick="mypdf('<?php echo $_GET['matiere'] ?>')"/></div>



<?php
}
      }
      
      
      $stmt->closeCursor();
  }
  
  include("./inc/footer.php");                                                                                      
?>
