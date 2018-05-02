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
		
	$resultat1=mysqli_query($connect, "SELECT id_ami1, chemin, nom, prenom, publication FROM amis JOIN documents ON amis.id_ami1=documents.id_auteur JOIN utilisateurs ON utilisateurs.id=amis.id_ami1 WHERE id_ami2=(SELECT id FROM utilisateurs WHERE pseudo='$pseudo') ORDER BY publication DESC"); //OK
	if($resultat1)
	{
		while($idami=mysqli_fetch_array($resultat1))
		{
		
			echo $idami["prenom"]. " " .$idami["nom"]. "<br/>" .$idami["publication"]. "<br/>";
			echo '<img src="'.$idami["chemin"].'.jpg" alt="photo" />';
			echo "<br/><br/><br/>";

		}
	}
	/*
	$resultat=mysqli_query($connect, "SELECT chemin from documents JOIN amis ON documents.id_auteur=amis.(SELECT id_ami1 FROM amis WHERE id_ami2=(SELECT id FROM utilisateurs WHERE pseudo='$pseudo'))");
	if($resultat) //si la requete ne renvoie pas rien
	{
		echo "ok";
		while($document=mysqli_fetch_array($resultat)) //tant qu'il y a une ligne de réponse
		{
			//echo $document["chemin"] . "" . "<br/>";
			echo "Entree dans la 2e boucle while <br/>";
			//echo '<img src="'.$document["chemin"].'.jpg" alt="photo" />';
		}			
	}	
	*/
	
}	
		
?>