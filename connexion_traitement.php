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
				$sql2="UPDATE `utilisateurs` SET `lastconnexion`=NOW() WHERE pseudo='$pseudo'";
                $res2= mysqli_query($connect,$sql2);
				
				$sql3="SELECT * FROM `cv` WHERE id_auteur=(SELECT id FROM utilisateurs WHERE pseudo='$pseudo')";
                $res3= mysqli_query($connect,$sql3);
				$data=mysqli_fetch_assoc($res3);
				
				
				
				$_SESSION['naissance'] =$data['naissance'];
                $_SESSION['specialite'] =$data['specialite'];
                $_SESSION['diplome'] =$data['diplome']; 
                $_SESSION['hobbys'] =$data['hobbys'];
                $_SESSION['experience'] =$data['experience'];
				
				
				//header('Location: accueil.html');
				 header('Location: monreseau.php');
                //header('Location: newsfeed.php');				 
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