<?php
session_start(); 
include("fixednavbar.php");


$serveur="localhost";
$log="root";
$mdp="";

$saut="</br>";

$mail=$_SESSION['mail'];

$lieu=$_POST['lieu'];
$statut=$_POST['statut'];
$choix_profil=$_POST['choix_profil'];

$bdd="projetweb";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);


	$fileName = $_FILES['profile_pic']['name'];
		

 	$sql=mysqli_query($connect,"INSERT INTO documents (id_auteur,chemin,publication,lieu,statut) VALUES (3,'$fileName',NOW(),'$lieu','private')");
	
	if($sql)
	{ 
		//while($data=mysqli_fetch_assoc($sql)){
			echo"Vous avez ajouté dans documents : ".$fileName;
					
		//}
		
		
	}
	
	else
	{
		echo "erreur requete";
	}
	mysqli_close($connect);
	
	//AJOUT
    //$id = $_SESSION['user_id'];
 
    $folder ="C:\wamp\www\projetWeb\\";
    $path = $folder.$fileName; // New variable
	move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $path)

    // if( move_uploaded_file($_FILES["pic"]["tmp_name"], $path) ) {
        // $mysqli = connectDB();
        // if( upload($id, $path, $mysqli) ) {
           // echo 'File uploaded';
        // } else {
          // echo 'Something went wrong uploading file';
        // }
    // } else {
       // echo 'Something went wrong uploading file';
    // }
	
	
	
?>
	

	<html>
Retournez sur Vous <a href="vous.php">Allez voir votre profil!</a>
</html>