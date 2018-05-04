<?php

$serveur="localhost";
$log="root";
$mdp="";

$bdd="projetweb";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$mail=$_POST['mail'];
$pseudo=$_POST['pseudo'];

		

if(!$connect )
	echo"pb de connexion";
else{
	//on construit la requete
	
	
	$sql="SELECT * FROM ece WHERE mail='$mail' AND pseudo='$pseudo' AND nom='$nom' AND prenom='$prenom'";
		
	// on ecrit notre requete, on l enverra avec jquery
	$res= mysqli_query($connect,$sql);
	
	if($res){
		    $data=mysqli_fetch_assoc($res);
	        if($data==""){
			echo"mail nom ou pseudo non reconnu";
			}
			else{
				$sql2="SELECT * FROM utilisateurs WHERE mail='$mail' AND pseudo='$pseudo'";
				$res2= mysqli_query($connect,$sql2);
				$data2=mysqli_fetch_assoc($res2);
	            
				if($data2==""){
				$sql="INSERT INTO utilisateurs VALUES(NULL,'$nom','$prenom','$mail','$pseudo',NULL,'Auteur')";
				$res= mysqli_query($connect,$sql);
				
				
				//Définir la photo de profil par défaut
				$sql2="INSERT INTO profil VALUES((SELECT id FROM utilisateurs WHERE mail='$mail'),'photopardefaut',NULL)";
				$res= mysqli_query($connect,$sql2);
				
				
				//Définir le cv par défaut
				$sql3="INSERT INTO cv VALUES(NULL,(SELECT id FROM utilisateurs WHERE mail='$mail'),'','','','',NULL)";
				$res= mysqli_query($connect,$sql3);
				
				
				
				echo"Vous êtes inscrit,revenez sur la page d'accueil pour vous connecter.";
			    echo "<a href='connexion.php'> Page d'accueil </a>";
			 
                }
				
				else {echo"Vous êtes déjà incrit sur le site!";}
				echo "<a href='connexion.php'> Page d'accueil </a>";
				
			}
	
	}
	else{
	echo "erreur requete";
	}
	//mysqli_free_result($res);  
	//mysqli_free_result($res2);
	mysqli_close($connect);
}






?>
