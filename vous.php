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

$mail=$_SESSION['mail'];
$pseudo=$_SESSION['pseudo'];

$naissance=$_SESSION['naissance'];
$specialite=$_SESSION['specialite'];
$diplome=$_SESSION['diplome'];
$hobbys=$_SESSION['hobbys'];
$experience=$_SESSION['experience'];
//$Pchemin=$_SESSION['chemin'];

if(!$connect )
	echo"pb de connexion";
else{
	//on construit la requete

	$sql="SELECT U.Nom,U.Prenom,U.mail,P.chemin,C.naissance,C.specialite,C.diplome,C.hobbys,C.experience FROM utilisateurs U 
			JOIN profil P ON U.id=P.id_utilisateur 
			JOIN cv C ON U.id=C.id_auteur
				WHERE U.mail='$mail' AND U.pseudo='$pseudo'";
	
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
			echo$saut;
			echo"Voici votre CV : ";
			echo$saut;
			echo$saut;
			echo "Votre spécialité : ";
			echo$data['specialite']; 
			echo$saut;
			echo "Votre diplome : ";
			echo$data['diplome']; 
			echo$saut;
			echo "Votre hobbys : ";
			echo$data['hobbys']; 
			echo$saut;
			echo "Votre experience : ";
			echo$data['experience']; 
			echo$saut;
			echo "Votre naissance : ";
			if($data['naissance']!='NULL') //Voir la valeur par défaut
			{
				echo$data['naissance']; 
			}
			echo$saut;
			echo$saut;
			
			
		}
	}
	else{
	echo "erreur requete";
	
	
	}
	mysqli_close($connect);
}


?>

<link rel="stylesheet" href="boutonCV.css" />
<a class="stylebouton" href="cv.php">Modifier mon CV</a>

</br>
</br>


<?php //echo "Changez votre pdp si vous voulez";  

//move_uploaded_file("image.jpg", "C:/wamp/www/projetWeb/image.jpg"); ?> 



<html>

<form action="file.php" method="post" enctype="multipart/form-data"> 
  <div>
    <label for="profile_pic">Sélectionnez le fichier à utiliser pour changer votre photo de profil</label>
    <input type="file" id="profile_pic" name="profile_pic"
          accept=".jpg, .jpeg, .png"> 
		  
		 <!-- <input type="file" id="profile_pic" name="<?php //echo$profile_pic ?>"
          accept=".jpg, .jpeg, .png"> -->
		   
		  
		  <?php //$fichier = $FILES['profile_pic']['name']; 
		  //$fichier = $_FILES['profile_pic']['name']; 
		  //echo 'Voici quelques informations de débogage :';
//print_r(basename($_FILES['userfile']['name']))
		  		  
				//echo"le nom du fichier est ".$fichier; ?>
				
				<a class="stylebouton" href="file.php">Que dit $FILES </a>
		  
  </div>
  <div>
  </br>
   <!-- <button>Envoyer</button> -->
	<a class="stylebouton" href="changeProfil_traitement.php">Modifier ma photo de profil</a>
  </div>
</form>

</br>
</br>

</html> 

<?php include("footer.php"); ?>
