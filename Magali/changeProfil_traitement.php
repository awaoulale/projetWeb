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


//$mail=$_POST['mail'];
//$pseudo=$_POST['pseudo'];

$mail=$_SESSION['mail'];
$pseudo=$_SESSION['pseudo'];

$nom = $_POST['fileName'];

//$Pchemin=$_POST['chemin'];
//$_SESSION['chemin']=$Pchemin;
//$_SESSION['chemin']=$_POST['chemin'];


if(!$connect )
	echo"pb de connexion";
else{
	//on construit la requete
		
		
		
	$sql="UPDATE profil SET chemin='doc3.jpg' WHERE id_utilisateur=(SELECT U.id FROM utilisateurs U WHERE U.mail='$mail' AND U.pseudo='$pseudo')";
		
	// on ecrit notre requete, on l enverra avec jquery
	$res= mysqli_query($connect,$sql);
	//$data=mysqli_fetch_assoc($res);
	if($res){
	        
			
			echo"Vous avez bien changé votre photo de profil !";
	
			echo$saut;
			echo$saut;
	
	
	}
	else{
	echo "erreur requete";
	}
	
	mysqli_close($connect);
}

?>
<html>
Retournez sur Vous <a href="vous.php">Allez voir votre nouvelle photo de profil!</a>
</html>
<?php include("footer.php"); ?>