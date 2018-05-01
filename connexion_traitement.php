<?php

$serveur="localhost";
$log="root";
$mdp="root";

$bdd="projetweb";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);

$mail=$_POST['mail'];
$pseudo=$_POST['pseudo'];


if(!$connect )
	echo"pb de connexion"; //si la connexion ne se fait pas
else
{
	//on construit la requete
	$sql="SELECT * FROM utilisateurs WHERE mail='$mail' AND pseudo='$pseudo'";
		
	// on ecrit notre requete, on l enverra avec jquery
	$res= mysqli_query($connect,$sql);
	$data=mysqli_fetch_assoc($res);
	
	if($res)
	{
	    if($data=="")
	    {
			echo"Mail ou pseudo non reconnu";
		}
		else
		{
			//on affiche la photo de profil de l'utilisateur connecté			
			echo "Vous etes connecte(e) ! <br/>";
			echo "Bienvenue $pseudo ! <br/>";
			//echo '<img src="'.$pseudo.'.jpg" alt="votre photo de profil" />'; //OK
			
			//moi
			$resultat=mysqli_query($connect, "SELECT chemin FROM documents WHERE id_auteur=1");
			if($resultat) //si la requete ne renvoie pas rien
			{
				while($document=mysqli_fetch_array($resultat)) //tant qu'il y a une ligne de réponse
				{
					//echo $document["chemin"] . "" . "<br/>";
					echo "Vore photo de profil <br/>";
					echo '<img src="'.$document["chemin"].'.jpg" alt="Votre photo de profil" />';
				}			
			}
			
            exit();
		}
	}
	else
	{
		echo "erreur requete";
	}
	mysqli_free_result($res);
	mysqli_close($connect);
}

?>
