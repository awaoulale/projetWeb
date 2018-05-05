<?php
session_start(); 


$serveur="localhost";
$log="root";
$mdp="";
$saut="</br>";
$bdd="projetweb";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);
$mail=$_SESSION['mail'];
$pseudo=$_SESSION['pseudo'];



//<!-- Fixed navbar -->
echo'<div class="navbar navbar-custom navbar-inverse navbar-static-top" id="nav">';
 echo'   <div class="container">';
 echo'     <div class="navbar-header">';
 echo'       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">';
 echo'         <span class="icon-bar"></span>';
 echo'         <span class="icon-bar"></span>';
 echo'         <span class="icon-bar"></span>';
 echo'         <span class="icon-bar"></span>';
 echo'         <span class="icon-bar"></span>';
 echo'         <span class="icon-bar"></span>';
 echo'       </button>';
 echo'     </div>';
 echo'     <div class="collapse navbar-collapse">';
  echo'      <ul class="nav navbar-nav nav-justified">';
  echo'        <li><a href="accueil.html">Accueil</a></li>';
  echo'        <li><a href="monreseau.php">Mon reseau</a></li>';
  echo'        <li><a href="vous.php">Vous</a></li>';
  echo'        <li><a href="notifications.php">Notifications</a></li>';
  echo'        <li><a href="emplois.php">Emplois</a></li>';
  echo'        <li><a href="deconnexion.php">Deconnexion</a></li>';
  
 $sql="SELECT type FROM utilisateurs WHERE mail='$mail' AND pseudo='$pseudo'";
  
  	$res= mysqli_query($connect,$sql);
	
	if($res){
		    $data=mysqli_fetch_assoc($res);
	        if($data["type"]=="Auteur"){}
			else{
				echo'<li><a href="admin.php">Admin</a></li>';
				}
	}
 
  
  echo'      </ul>';
  echo'    </div><!--/.nav-collapse -->';
  echo'  </div><!--/.container -->';
echo'</div><!--/.navbar -->';







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
			//echo "Changez votre pdp si vous voulez";
			
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
			if($data['naissance']!='2018-05-03')
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

<!-- <html>
<label> Changez de pdp </label>
<input type="file" id="file" name="file" accept=".png, .jpg, .jpeg">
</html> -->

<link rel="stylesheet" href="boutonCV.css" />
<a class="stylebouton" href="cv.php">Modifier mon CV</a>

<?php include("footer.php"); ?>