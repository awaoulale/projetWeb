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
				
	$sql1=mysqli_query($connect,"SELECT U.Nom,U.Prenom,U.mail,P.chemin AS chemin_profil,C.naissance,C.specialite,C.diplome,C.hobbys,C.experience FROM utilisateurs U 
			JOIN profil P ON U.id=P.id_utilisateur 
			JOIN cv C ON U.id=C.id_auteur
				WHERE U.pseudo='$pseudo' AND U.mail='$mail'");
	
	// on ecrit notre requete, on l enverra avec jquery

	if($sql1){
		//on traite les résultats
		//chaque ligne
		while($data1=mysqli_fetch_assoc($sql1)){// tant qu on peut extraire
			echo"Bonjour !";
			echo$saut;
			echo$data1['Prenom'];
			echo" ";
			echo$data1['Nom'];
			echo$saut;
			echo$data1['mail'];
			echo$saut;
			echo$saut;
			echo "Votre photo de profil <br/>";
			echo '<img src="'.$data1["chemin_profil"].'" alt="Votre photo de profil" />';
			echo$saut;
			echo$saut;
			echo$saut;
			echo$saut;
			echo$saut;
			
			echo"Voici votre CV : ";
			echo$saut;
			echo$saut;
			echo "Votre spécialité : ";
			echo$data1['specialite']; 
			echo$saut;
			echo "Votre diplome : ";
			echo$data1['diplome']; 
			echo$saut;
			echo "Votre hobbys : ";
			echo$data1['hobbys']; 
			echo$saut;
			echo "Votre experience : ";
			echo$data1['experience']; 
			echo$saut;
			echo "Votre naissance : ";
			if($data1['naissance']!='NULL') //Voir la valeur par défaut
			{
				echo$data1['naissance']; 
			}
			echo$saut;
			echo$saut;
			
			
		}
		$sql2=mysqli_query($connect, "SELECT D.chemin AS chemin_doc,D.publication,D.lieu FROM documents D JOIN utilisateurs U ON U.id=D.id_auteur WHERE U.pseudo='$pseudo' AND U.mail='$mail' ORDER BY D.publication DESC");
			if($sql2)
			{
				while($data2=mysqli_fetch_array($sql2))
				{
					echo "Date : ".$data2['publication']." Lieu : ".$data2['lieu'];echo$saut;
					
					//Différence si c'est une photo ou une vidéo
					$pos1 = strpos($data2['chemin_doc'], '.mp4');
					$pos2 = strpos($data2['chemin_doc'], '.ogv');
					$pos3 = strpos($data2['chemin_doc'], '.webm');
					
					//$pos4 = strpos($data2['chemin_doc'], '.txt');
										
					if (($pos1===false)&&($pos2===false)&&($pos3===false))
					{	
						
						echo'<img src="'.$data2['chemin_doc'].'" alt="Vos photos" height="300" width="500" />';
						echo$saut;echo$saut;
					}
					else
					{
						
						//echo'<embed src="'.$data2['chemin_doc'].'" autostart="false" height="400" width="600" />';
						echo'<video controls src="'.$data2['chemin_doc'].'" height="400" width="600"> Video des documents </video>';
						echo$saut;echo$saut;
					}
				}
				
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

<link rel="stylesheet" href="boutonCV.css" />
<a class="stylebouton" href="changeProfil_traitement.php">Modifier ma photo de profil</a>

</br>
</br>


<?php //echo "Changez votre pdp si vous voulez";  

//move_uploaded_file("image.jpg", "C:/wamp/www/projetWeb/image.jpg"); ?> 



<html>

<!-- <form action="file.php" method="post" enctype="multipart/form-data"> 
  <div>
    <label for="profile_pic">Sélectionnez le fichier à utiliser pour changer votre photo de profil</label>
    <input type="file" id="profile_pic" name="profile_pic"
          accept=".jpg, .jpeg, .png">  -->
		  
		 <!-- <input type="file" id="profile_pic" name="<?php //echo$profile_pic ?>"
          accept=".jpg, .jpeg, .png"> -->
		   
		  
		  <?php //$fichier = $FILES['profile_pic']['name']; 
		  //$fichier = $_FILES['profile_pic']['name']; 
		  //echo 'Voici quelques informations de débogage :';
//print_r(basename($_FILES['userfile']['name']))
		  		  
				//echo"le nom du fichier est ".$fichier; ?>
				
			<!--	<a class="stylebouton" href="file.php">Que dit $FILES </a>
		  
  </div>
  <div> 
  </br> -->
   <!-- <button>Envoyer</button> -->
<!--	<a class="stylebouton" href="changeProfil_traitement.php">Modifier ma photo de profil</a>
  </div>
</form> -->

<h3> Télécharger </h3>
<form action="photo_traitement.php" method="post" enctype="multipart/form-data"> 
  <div>
    <label for="profile_pic">Sélectionnez le fichier (photo formats :, video formats :)</label>
    <input type="file" id="profile_pic" name="profile_pic" >
         <!-- accept=".jpg, .jpeg, .png, .txt"> -->
		  <br/>
		  <br/>
		  <label> Entrez le lieu : </label>
		  <input type="text" name="lieu"/><br/>
		  <br/>
		  <br/>
		  <label> Le statut de votre publication : </label>
		  <input type="radio" name="statut" value="public" checked>public
		  <input type="radio" name="statut" value="private">private
		  <br/>
		  <br/>
		  <input id="checkBox" name ="choix_profil" type="checkbox">
		   <br/>
		  <br/>
		  <input type="submit" name="valider" value="OK"/>
		
			<input id="checkBox" name ="choix_profil" type="checkbox">
			
 	</form>

</br>
</br>

</html> 

<?php include("footer.php"); ?>
