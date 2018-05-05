<?php
session_start();
include("fixednavbar.php");

$serveur="localhost";
$log="root";
$mdp="";

$saut="</br>";

$bdd="projetweb";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);


$mail=$_SESSION['mail'];
$pseudo=$_SESSION['pseudo'];

$nom_docu=$_POST['nom_docu'];
$id_docu=$_POST['id_docu'];


if(!$connect )
	echo"pb de connexion";
else{
	//on construit la requete
		
	
	$sql="DELETE FROM documents WHERE id_doc='$id_docu' AND chemin='$nom_docu'";
		
	// on ecrit notre requete, on l enverra avec jquery
	$res= mysqli_query($connect,$sql);

	if($res){
	        
		if(isset($id_doc))
		{
			echo"Vous avez bien supprimé votre publication !";
	
			echo$saut;
			echo$saut;
		}
		else
		{
			echo"Vous avez mal renseigne le numero ou le nom de votre document à supprimer";
			echo$saut;
			echo$saut;
		}
	
	}
	else{
	echo "erreur requete";
	}
	
	mysqli_close($connect);
}

?>
<html>
Retournez sur Vous <a href="vous.php">Allez voir votre profil!</a>
</html>
<?php include("footer.php"); ?>