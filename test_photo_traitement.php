<?php
session_start(); 
include("fixednavbar.php");


$serveur="localhost";
$log="root";
$mdp="";

$saut="</br>";

$mail=$_SESSION['mail'];

$lieu=$_POST['lieu'];
$statut=$_POST['statut'];

$bdd="projetweb";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);


	$fileName = $_FILES['profile_pic']['name'];
		

 	$sql=mysqli_query($connect,"INSERT INTO documents (id_auteur,chemin,publication,lieu,statut) VALUES (3,'$fileName',NOW(),'$lieu','private')");
	
	if($sql)
	{ 
		echo$fileName;
		//while($data=mysqli_fetch_assoc($sql)){
			echo"Vous avez ajouté dans documents :".$fileName;
					
		//}
	}
	
	else
	{
		echo "erreur requete";
	}
	mysqli_close($connect);
	

	
	?>