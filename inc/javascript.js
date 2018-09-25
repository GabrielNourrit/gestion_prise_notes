function cmd(nom, argument){
    switch(nom){
    case "insertImage":
        argument = prompt("adresse ?");
        break;
    case "insertHTML":
        argument = prompt("balance");
        break;
    }
    if (typeof argument === 'undefined') {
        argument = '';
    }
    document.execCommand(nom,false,argument);
}

function soumission(){
    document.getElementById("resultat").value=document.querySelector(".notes").innerHTML;
    document.getElementById("myform").submit();
}

function next(mat,id){
id=id+1;
document.location.href="lire_cours.php?matiere="+mat+"&&id="+id
}

function undo(mat,id){
id=id-1;
document.location.href="lire_cours.php?matiere="+mat+"&&id="+id
}

function redir(nom){
document.location.href="lire_cours.php?matiere="+nom+"&&id=0"
}

function mypdf(dir){
    document.location.href="monpdf.php?matiere="+dir
}