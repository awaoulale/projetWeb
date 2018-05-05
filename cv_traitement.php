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

$naissance=$_POST['naissance'];
$specialite=$_POST['specialite'];
$diplome=$_POST['diplome'];
$hobbys=$_POST['hobbys'];
$experience=$_POST['experience'];

//session_start();
//$_SESSION['naissance']=$naissance;

$_SESSION['naissance'] =$_POST['naissance'];
$_SESSION['specialite'] =$_POST['specialite'];
$_SESSION['diplome'] =$_POST['diplome'];
$_SESSION['hobbys'] =$_POST['hobbys'];
$_SESSION['experience'] =$_POST['experience'];

if(!$connect )
	echo"pb de connexion";
else{
	//on construit la requete
		
	//$sql="INSERT INTO cv (id_auteur,specialite,diplome,hobbys,experience,naissance) VALUES ((SELECT U.id FROM utilisateurs U WHERE U.mail='$mail' AND U.pseudo='$pseudo'), '$specialite', '$diplome', '$hobbys', '$experience', '$naissance')";
	$sql="UPDATE cv SET specialite='$specialite', diplome='$diplome', hobbys='$hobbys', experience='$experience', naissance='$naissance' WHERE id_auteur=(SELECT U.id FROM utilisateurs U WHERE U.mail='$mail' AND U.pseudo='$pseudo')";
		
	// on ecrit notre requete, on l enverra avec jquery
	$res= mysqli_query($connect,$sql);
	//$data=mysqli_fetch_assoc($res);
	if($res){
	        
			
			echo"Vous avez bien enregistré votre CV !";
	
			echo$saut;
			echo$saut;
	
	
	}
	else{
	echo "erreur requete : Vous avez mal rempli les champs. Veuillez mettre votre date de naissance svp";
	}
	
	mysqli_close($connect);
}

?>
<html>
Retournez sur Vous <a href="vous.php">Allez voir votre CV!</a>
</html>
<?php include("footer.php"); ?>