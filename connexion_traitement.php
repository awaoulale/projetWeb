<?php
//session_start();
//include("vous.php")

$serveur="localhost";
$log="root";
$mdp="";

$bdd="projetweb";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);

//$mail=$_SESSION['mail'];
//$pseudo=$_SESSION['pseudo'];
$mail=$_POST['mail'];
$pseudo=$_POST['pseudo'];

session_start();
$_SESSION['mail'] =$_POST['mail'];
$_SESSION['pseudo'] =$_POST['pseudo'];


if(!$connect )
	echo"pb de connexion";
else{
	//on construit la requete
	
	//$sql="INSERT INTO societedhonneur VALUES($id,'$prenom','$nom','$date','$position','$majeure',$moyenne,'$pays')";
	$sql="SELECT * FROM utilisateurs WHERE mail='$mail' AND pseudo='$pseudo'";
		
	// on ecrit notre requete, on l enverra avec jquery
	$res= mysqli_query($connect,$sql);
	$data=mysqli_fetch_assoc($res);
	if($res){
	        if($data==""){
			echo"Identifiant ou psuedo non reconnu";
			}
			else{
				 //header('Location: accueil.html');
				 header('Location: accueil.html');
				 
                 exit();
			}
	
	}
	else{
	echo "erreur requete";
	}
	mysqli_free_result($res);
	mysqli_close($connect);
}






?>
