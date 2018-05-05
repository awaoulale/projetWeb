

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
		$resultat1=mysqli_query($connect, "SELECT * FROM ece WHERE nom='$nom' AND prenom='$prenom'");
		if($resultat1)
		{
			$data=mysqli_fetch_array($resultat1);
			
				$mail = $data["mail"];
				$pseudo = $data["pseudo"];
				
					
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
		$resultat1=mysqli_query($connect, "INSERT INTO utilisateurs VALUES (NULL,'$nom','$prenom','$mail','$pseudo',NOW(),'Auteur')"); 
		$resultat1=mysqli_query($connect, "INSERT INTO profil VALUES((SELECT id FROM utilisateurs WHERE mail='$mail'),'photopardefaut',NULL)");
		$resultat1=mysqli_query($connect, "INSERT INTO cv VALUES(NULL,(SELECT id FROM utilisateurs WHERE mail='$mail'),'','','','',NULL)");
		
		
			
		
	}	
				
	header('Location: admin.php');
		
?>



