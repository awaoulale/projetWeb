<center>
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
			echo"<b>Votre page Vous</b>"; 
			echo$saut;
			echo$saut;
			echo"<b>".$data1['Prenom']."</b>";
			echo" ";
			echo"<b>".$data1['Nom']."</b>";
			echo$saut;
			echo"<b>".$data1['mail']."</b>";
			echo$saut;
			echo$saut;
			echo"<b>"."Votre photo de profil : "."</b>";
			echo$saut;
			echo '<img src="'.$data1["chemin_profil"].'" alt="Votre photo de profil" height="400" width="600" />';
			echo$saut;
			echo$saut;
			echo$saut;
			echo$saut;
			echo$saut;
			
			echo"<b>"."Votre CV : "."</b>";
			echo$saut;
			echo$saut;
			echo"<b>"."Spécialité ou points forts : "."</b>";
			echo$data1['specialite']; 
			echo$saut;
			echo"<b>"."Dernier diplome obtenu : "."</b>";
			echo$data1['diplome']; 
			echo$saut;
			echo"<b>"."Hobbies : "."</b>";
			echo$data1['hobbys']; 
			echo$saut;
			echo"<b>"."Experiences professionnelles : "."</b>";
			echo$data1['experience']; 
			echo$saut;
			echo"<b>"."Date de naissance : "."</b>";
			if($data1['naissance']!='NULL') //Voir la valeur par défaut
			{
				echo$data1['naissance']; 
			}
			echo$saut;
			echo$saut;
			echo$saut;
			echo"<b>"."Vos publications "."</b>";
			echo$saut;
			echo$saut;
			
			
		}
		$sql2=mysqli_query($connect, "SELECT D.chemin AS chemin_doc,D.publication,D.lieu,D.statut FROM documents D JOIN utilisateurs U ON U.id=D.id_auteur WHERE U.pseudo='$pseudo' AND U.mail='$mail' ORDER BY D.publication DESC");
			if($sql2)
			{
				while($data2=mysqli_fetch_array($sql2))
				{
					echo "Date : ".$data2['publication']." Lieu : ".$data2['lieu'];echo$saut;echo" Statut : ".$data2['statut'];echo$saut;
					
					//Différence si c'est une photo ou une vidéo
					$pos1 = strpos($data2['chemin_doc'], '.mp4');
					$pos2 = strpos($data2['chemin_doc'], '.ogv');
					$pos3 = strpos($data2['chemin_doc'], '.webm');
					
					$pos4 = strpos($data2['chemin_doc'], '.jpg');
					$pos5 = strpos($data2['chemin_doc'], '.jpeg');
					$pos6 = strpos($data2['chemin_doc'], '.bmp');
					$pos7 = strpos($data2['chemin_doc'], '.gif');
					$pos8 = strpos($data2['chemin_doc'], '.png');
															
					if (($pos1!=false)||($pos2!=false)||($pos3!=false))
					{	
						echo'<video controls src="'.$data2['chemin_doc'].'" height="400" width="600"> Video des documents </video>';
						echo$saut;echo$saut;
					}
					if (($pos4!=false)||($pos5!=false)||($pos6!=false)||($pos7!=false)||($pos8!=false))
					{
						echo'<img src="'.$data2['chemin_doc'].'" alt="Vos photos" height="300" width="500" />';
						echo$saut;echo$saut;
					}
					else
					{
						echo"Vous avez publié : ".$data2['chemin_doc'];
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

</center>

<h3> Apporter des modifications sur mon profil ou sur mon mur  </h3>


<form action="publi_texte_traitement.php" method="post"> 
	<label> Ecrivez une publication : </label>
		<br/>
		<textarea cols="80" rows="5" name="publi_text" > </textarea>
		<br/>
		<br/>
		  <label> Entrez le lieu de votre publication texte : </label>
		  <input type="text" name="lieu_texte"/><br/>
		  <br/>
		  <label> Le statut de votre publication texte : </label>
		  <input type="radio" name="statut_texte" value="public" checked>public
		  <input type="radio" name="statut_texte" value="private">private
		<br/>
		<input type="submit" value="Postez votre texte"/>

<br/>
<br/>
<br/>		
</form>

<h3> Modifier mon CV </h3>
<link rel="stylesheet" href="boutonCV.css" />
<a class="stylebouton" href="cv.php">Modifier mon CV</a>

</br>
</br>


</br>


<html>


<h3> Telecharger un document </h3>
<form action="photo_traitement.php" method="post" enctype="multipart/form-data"> 
  <div>
    <label for="profile_pic">Sélectionnez le fichier (formats acceptes photos : .png,.jpg,.gif,.bmp et formats acceptes videos : .mp4,.ogv,.webm)</label>
    <input type="file" id="profile_pic" name="profile_pic" >
		  <br/>
		
		  <label> Entrez le lieu : </label>
		  <input type="text" name="lieu"/><br/>
		  <br/>
		  
		  <label> Le statut de votre publication : </label>
		  <input type="radio" name="statut" value="public" checked>public
		  <input type="radio" name="statut" value="private">private
		  <br/>
		  <label> Si vous voulez que l'image que vous téléchargez soit votre nouvelle photo de profil, cochez la case : </label>
		  <input id="checkBox" name ="choix_profil" type="checkbox" value="choix_profil">
		   
		  <br/>
		  <input type="submit" name="valider" value="OK"/>
		
		
			
 	</form>

</br>
</br>

</html> 

<?php include("footer.php"); ?>
