<?php
include("./inc/header.php");
   ?>
<select onchange="redir(this.value); this.selectedIndex = 0;">
      <option value="">make choice</option>
      <?php
        $matieres=$db->prepare('SELECT * FROM matiere;');
        $matieres->execute();
        while($iterateur = $matieres->fetch()){
            echo '<option value="'.$iterateur['surnom'].'_'.$iterateur['type'].'_S'.$iterateur['semestre'].'">'.$iterateur['surnom'].'_'.$iterateur['type'].'_S'.$iterateur['semestre'].'</option>';
        }
        $matieres->CloseCursor();
      ?>
    </select>
    <input type="button" value="cree matiere" onclick='document.location.href="matiere.php"'/>
    <?php
echo'<div id="index">
<strong>Wiki Perso :</strong><br/><br/>
-> tableau html  <a href="inc/tab.txt" target="_blank"/>ici</a>.<br/><br/>
-> site de conversion html pdf <a href="https://convertio.co/fr/" target="_blank"/>ici</a>

</div>';
include("./inc/footer.php");
?>
    
    