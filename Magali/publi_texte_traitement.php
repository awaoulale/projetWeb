<?php
session_start(); 
include("fixednavbar.php");


$serveur="localhost";
$log="root";
$mdp="";

$saut="</br>";

$mail=$_SESSION['mail'];
$pseudo=$_SESSION['pseudo'];

$lieu_text=$_POST['lieu_texte'];
$statut_text=$_POST['statut_texte'];


$bdd="projetweb";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);


	//$fileName = $_FILES['profile_pic']['name'];
	$publiText=$_POST['publi_text'];
		
if(!$connect )
	echo"pb de connexion";
else 
{

 	$sql1=mysqli_query($connect,"INSERT INTO documents (id_auteur,chemin,publication,lieu,statut) VALUES ((SELECT U.id FROM utilisateurs U WHERE U.mail='$mail' AND U.pseudo='$pseudo'),'$publiText',NOW(),'$lieu_text','$statut_text')");
	
	if($sql1)
	{ 
		
			echo"Vous avez ajouté dans vos publications : ".$publiText;
							
			
		
		
	}
	
	else
	{
		echo "erreur requete texte";
	}
	mysqli_close($connect);
	
}
	
?>
	

	<html>
Retournez sur Vous <a href="vous.php">Allez voir votre profil!</a>
</html>