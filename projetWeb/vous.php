<?php
session_start(); 
include("fixednavbar.php");

$serveur="localhost";
$log="root";
$mdp="root";
$saut="</br>";
$bdd="projet";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);
$mail=$_SESSION['mail'];
$pseudo=$_SESSION['pseudo'];
if(!$connect )
	echo"pb de connexion";
else{
	//on construit la requete
		//$sql="SELECT U.Nom,U.Prenom,U.mail,D.chemin FROM utilisateurs U JOIN documents D ON U.id=D.id_auteur WHERE U.id=3";
	$sql="SELECT U.Nom,U.Prenom,U.mail,P.chemin FROM utilisateurs U JOIN profil P ON U.id=P.id_utilisateur WHERE U.mail='$mail' AND U.pseudo='$pseudo'";
	
	// on ecrit notre requete, on l enverra avec jquery
	$res= mysqli_query($connect,$sql);
	if($res){
		//on traite les résultats
		//chaque ligne
		while($data=mysqli_fetch_assoc($res)){// tant qu on peut extraire
			echo"Bonjour !";
			echo$saut;
			echo$data['Prenom'];
			echo" ";
			echo$data['Nom'];
			echo$saut;
			echo$data['mail'];
			echo$saut;
			echo "Votre photo de profil <br/>";
			echo '<img src="'.$data["chemin"].'" alt="Votre photo de profil" />';
			echo$saut;
			echo "Changez votre pdp si vous voulez";
			
			
			//echo 'Votre login est'.$_SESSION['pseudo'].'et votre mail est :'.$_SESSION['mail'];
		}
	}
	else{
	echo "erreur requete";
	
	
	}
	mysqli_close($connect);
}
?>
<html>
<label> Changez de pdp </label>
<input type="file" id="file" name="file" accept=".png, .jpg, .jpeg">
</html>
<?php include("footer.php"); ?>