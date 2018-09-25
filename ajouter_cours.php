<?php
include("./inc/header.php");  
  if(!isset($_POST['resultat'])){
?>
<span id="toolbar">
      <input type="button" value="G" onclick="cmd('bold')"/><br/>
      <input type="button" value="I" onclick="cmd('italic')"/><br/>
      <input type="button" value="U" onclick="cmd('underline')"/><br/>
      <input type="button" value="S" onclick="cmd('strikethrough')"/><br/>
      <input type="button" value="Im" onclick="cmd('insertImage')"/><br/>
      <select onchange="cmd('heading', this.value); this.selectedIndex = 0;">
        <option value="">T</option>
        <option value="h1">1</option>
        <option value="h2">2</option>
        <option value="h3">3</option>
      </select><br/>
      <input type="button" value="C" onclick="cmd('justifycenter')"/><br/>
      <input type="button" value="<-" onclick="cmd('justifyleft')"/><br/>
      <input type="button" value="->" onclick="cmd('justifyright')"/><br/>
      <input type="button" value="_" onclick="cmd('subscript')"/><br/>
      <input type="button" value="^" onclick="cmd('superscript')"/><br/>
      <input type="button" value="Ul" onclick="cmd('insertunorderedlist')"/><br/>
      <input type="button" value="Ol" onclick="cmd('insertorderedlist')"/><br/>
      <input type="button" value="HTML" onclick="cmd('insertHTML')"/><br/>
      <select onchange="cmd('foreColor', this.value); this.selectedIndex = 0;">
        <option value="">Stylo</option>
        <option value="#505050">defaut</option>
        <option value="red">rouge</option>
        <option value="blue">bleu</option>
        <option value="green">vert</option>
        <option value="purple">violet</option>
        <option value="turquoise">turquoise</option>
        <option value="deeppink">rose</option>
      </select><br/>
    </span>

<div id="formArticle">
       <?php
      echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'" id="myform" enctype="multipart/form-data"> <div class="notes" contentEditable>';

      if(!isset($_POST['modifier']))
          echo '(clique)';
      else{
          $req="SELECT contenu FROM ".$_POST['matiere']." WHERE id =".$_POST['id'];
          $req=str_replace("'", " ", $req);
          $query=$db->prepare($req);
          $query->execute();
          $data=$query->fetch();
          $query->closeCursor();
          echo $data['contenu'];
      }
      echo '</div>
       <input type="hidden" name="resultat" id="resultat"/>
       <input type="hidden" name="matiere" value='.$_POST["matiere"].'/>
       <input type="hidden" name="id" value='.$_POST["id"].'/>
       <input type="hidden" name="add" value='.$_POST['add'].'/>';
      if(isset($_POST['modifier']))
          echo'<input type="hidden" name="modifier" value="'.$_POST['modifier'].'"/>';

      echo ' <input type="button" name="poster" value="Go" onclick="soumission()"/>
   </form>
</div>';
       ?>
   
   <?php }
      else{
          //il faut l'ajouter a la BDD a l'aide de post matiere,resultat(contenu) et id+1
          if(!isset($_POST['modifier'])){
          $stmt=$db->prepare("INSERT INTO ".$_POST['matiere']." VALUES(:id,:contenu)");
          $stmt->bindValue(':id', $_POST['id'],PDO::PARAM_INT);
          $stmt->bindValue(':contenu', $_POST["resultat"],PDO::PARAM_STR);
          $stmt->execute();
          $stmt->closeCursor();
          }else{
            $text=str_replace("'", "\'",$_POST['resultat']);
              $query='UPDATE '.$_POST['matiere'].' SET contenu=\''.$text.'\' WHERE id='.$_POST['id'];
          $req=$db->prepare($query);
          $req->execute();
          $req->closeCursor();
          }
          echo "page ajouté ! ";
          echo "revenir au cours <a href=lire_cours.php?matiere=".$_POST['add']."&&id=".$_POST['id'].">ici</a>";
      }
include("./inc/footer.php");   
?>
