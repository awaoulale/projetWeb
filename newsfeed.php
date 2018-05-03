<?php

session_start(); // On démarre la session AVANT toute chose


	$serveur="localhost";
	$log="root";
	$mdp="root";

	$bdd="projetweb";
	$connect=mysqli_connect($serveur,$log,$mdp);
	$con=mysqli_select_db($connect,$bdd);

	$mail=$_SESSION['mail'];
	$pseudo=$_SESSION['pseudo'];

if(!$connect )
	echo"pb de connexion";
else
{
		
	$resultat1=mysqli_query($connect, "SELECT id_ami1, chemin, nom, prenom, publication, aime, partage, commentaire, reactions.id_doc
										FROM amis 
										JOIN documents ON amis.id_ami1=documents.id_auteur 
										JOIN utilisateurs ON utilisateurs.id=amis.id_ami1 
										JOIN reactions ON reactions.id_doc=documents.id_doc
										WHERE id_ami2=(SELECT id FROM utilisateurs WHERE pseudo='$pseudo') 
										ORDER BY publication DESC");

	if($resultat1)
	{
		while($idami=mysqli_fetch_array($resultat1))
		{
			echo $idami["prenom"]. " " .$idami["nom"]. "<br/>" .$idami["publication"]. "<br/>";
			
			$id_doc=$idami["id_doc"];
			
			//on compte le nombre de jaimes
			$resultat2=mysqli_query($connect, "SELECT COUNT(aime) AS nb_1 FROM reactions WHERE id_doc='$id_doc' AND aime='oui'");
			if($resultat2)
			{
				while($nbaime=mysqli_fetch_array($resultat2))
				{
					$nb_1=$nbaime["nb_1"];
					echo $nb_1. " j aime(s) <br/>" ;
				}
			}
			
			//on compte le nombre de partages
			$resultat3=mysqli_query($connect, "SELECT COUNT(partage) AS nb_2 FROM reactions WHERE id_doc='$id_doc' AND partage='oui'");
			if($resultat3)
			{
				while($nbpartage=mysqli_fetch_array($resultat3))
				{
					$nb_2=$nbpartage["nb_2"];
					echo $nb_2. " partage(s) <br/>" ;
				}
			}
			
			//on compte le nombre de commentaires
			$resultat4=mysqli_query($connect, "SELECT COUNT(commentaire) AS nb_3 FROM reactions WHERE id_doc='$id_doc' AND commentaire IS NOT NULL");
			if($resultat4)
			{
				while($nbcommentaire=mysqli_fetch_array($resultat4))
				{
					$nb_3=$nbcommentaire["nb_3"];
					echo $nb_3. " commentaire(s) <br/>" ;
				}
			}
			
			//si le document est une photo .jpg
			if( strstr($idami["chemin"], ".jpg"))
			{
				echo '<img src="'.$idami["chemin"].'" alt="photo" />';
			}
			
			//si le document est une video .mp4
			if( strstr($idami["chemin"], ".mp4"))
			{
				echo '<video controls src="'.$idami["chemin"].'" width="800" height="500">Ici la description alternative</video>';
			}
			
			echo "<br/><br/><br/>";

		}
	}
	//echo '<video controls src="presentationmajeures.mp4" width="800" height="500">Ici la description alternative</video>'; //OK
	
}	
		
?>
