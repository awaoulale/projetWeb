<html>


<?php
$data=explode(" ", $_POST['utilisateurs']);
$nom = $data[0];
$prenom = $data[1];

echo '<div id="infos">';
echo '<h2>  Ajout de '.$prenom.' '.$nom.'</h2>';
echo '</div>';


session_start(); // On démarre la session AVANT toute chose
$serveur="localhost";
    $log="root";
    $mdp="";

	$bdd="projetweb";
	$connect=mysqli_connect($serveur,$log,$mdp);
	$con=mysqli_select_db($connect,$bdd);


	if(!$connect )
	echo"pb de connexion";
	else
	{
		$resultat1=mysqli_query($connect, "SELECT * FROM utilisateurs WHERE nom='$nom' AND prenom='$prenom'");
		if($resultat1)
		{
			$data=mysqli_fetch_array($resultat1);
			
				$mail = $data["mail"];
				$pseudo = $data["pseudo"];
				$id = $data["id"];
				
					
		}
	}	
			

// Ajout du profil dans la base utilisateur
	$bdd="projetweb";
	$connect=mysqli_connect($serveur,$log,$mdp);
	$con=mysqli_select_db($connect,$bdd);
	
	if(!$connect )
	echo"pb de connexion";
	else
	{
		// Enregistrement de l'utilisateur
		$resultat1=mysqli_query($connect, "DELETE FROM `documents` WHERE id_auteur='$id'"); 
		$resultat1=mysqli_query($connect, "DELETE FROM `reactions` WHERE id_utilisateur='$id'");
		$resultat1=mysqli_query($connect, "DELETE FROM `amis` WHERE id_ami1='$id'"); 
		$resultat1=mysqli_query($connect, "DELETE FROM `amis` WHERE id_ami2='$id'"); 
		$resultat1=mysqli_query($connect, "DELETE FROM `cv` WHERE id_auteur='$id'");
		$resultat1=mysqli_query($connect, "DELETE FROM `profil` WHERE id_utilisateur'$id'");
		$resultat1=mysqli_query($connect, "DELETE FROM `utilisateurs` WHERE id='$id'");
		
		
			
		
	}	
				
	header('Location: admin.php');
		
?>





</html>