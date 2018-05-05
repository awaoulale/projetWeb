<?php
session_start(); 
include("fixednavbar.php");


$serveur="localhost";
$log="root";
$mdp="";

$saut="</br>";

$mail=$_SESSION['mail'];
$pseudo=$_SESSION['pseudo'];

$lieu=$_POST['lieu'];
$statut=$_POST['statut'];


$bdd="projetweb";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);


	$fileName = $_FILES['profile_pic']['name'];
	$fileError = $_FILES['profile_pic']['error'];
		
if(!$connect )
	echo"pb de connexion";
else 
{
	if($fileError==UPLOAD_ERR_NO_FILE)
	{
	echo"Vous avez téléchargé aucun fichier ou la taille du fichier téléchargée est trop grande";
	echo$saut;
	echo$saut;
	}
	

	else{
 	$sql1=mysqli_query($connect,"INSERT INTO documents (id_auteur,chemin,publication,lieu,statut) VALUES ((SELECT U.id FROM utilisateurs U WHERE U.mail='$mail' AND U.pseudo='$pseudo'),'$fileName',NOW(),'$lieu','$statut')");
	
	if($sql1)
	{ 
	
			echo"Vous avez ajouté dans vos documents : ".$fileName;
							
				if (isset($_POST['choix_profil'])) //si la case est cochée
				{ 
					echo 'La case a été cochée';
					$pos4 = strpos($data2['chemin_doc'], '.jpg');
					$pos5 = strpos($data2['chemin_doc'], '.jpeg');
					$pos6 = strpos($data2['chemin_doc'], '.bmp');
					$pos7 = strpos($data2['chemin_doc'], '.gif');
					$pos8 = strpos($data2['chemin_doc'], '.png');
					
					if(($pos4==false)&&($pos5==false)&&($pos6==false)&&($pos7==false)&&($pos8==false))
					{
						echo"Ce n'est pas le bon format de fichier pour une photo.";
					}
					else
					{	
						$sql2=mysqli_query($connect,"UPDATE profil SET chemin='$fileName' WHERE id_utilisateur=(SELECT U.id FROM utilisateurs U WHERE U.mail='$mail' AND U.pseudo='$pseudo')");
						if($sql2)
						{
							echo"Vous avez changé votre photo de profil !";
						}						
					}	
						
						
				}
				
				
		
		
		
	}
	
	else
	{
		echo "erreur requete";
	}
	mysqli_close($connect);
	
    $folder ="C:\wamp\www\projetWeb\\";
    $path = $folder.$fileName; 
	move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $path);

    
	
}

}
	
?>
	

	<html>
Retournez sur Vous <a href="vous.php">Allez voir votre profil!</a>
</html>