<?php
session_start(); 
?>
<html>
 <head>
 <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
 <title> ECE Plouf Vous </title>
 <link rel="stylesheet" href="vous.css"  /> 
 </head>


<body>
<center>
	
<h1 class="logo"><img src="logoPlouf.png" alt="Logo" height="150" width="350"/></h1>

<div id="menu">
  <ul id="onglets">
    <li class="active"><a href="emplois.php"> Emplois </a></li>
    <li><a href="accueil.html"> Accueil </a></li>
    <li><a href="vous.php"> Vous </a></li>
    <li><a href="reseau.php"> Votre réseau </a></li>
	<li><a href="notifications.php"> Vos notifications </a></li>
  </ul>
</div>
  
	
	</center>
	
</body>	
</html>

<?php
//session_start();

$serveur="localhost";
$log="root";
$mdp="";

$saut="</br>";

$bdd="projetweb";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);

$mail=$_SESSION['mail'];
$pseudo=$_SESSION['pseudo'];

if(!$connect )
	echo"pb de connexion";
else{
	//on construit la requete
		//$sql="SELECT U.Nom,U.Prenom,U.mail,D.chemin FROM utilisateurs U JOIN documents D ON U.id=D.id_auteur WHERE U.id=3";
	$sql="SELECT U.Nom,U.Prenom,U.mail,D.chemin FROM utilisateurs U JOIN documents D ON U.id=D.id_auteur WHERE U.mail='$mail' AND U.pseudo='$pseudo'";
	
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
			echo '<img src="'.$data["chemin"].'.jpg" alt="Votre photo de profil" />';
			
			//echo 'Votre login est'.$_SESSION['pseudo'].'et votre mail est :'.$_SESSION['mail'];
		}
	}
	else{
	echo "erreur requete";
	
	
	}
	mysqli_close($connect);
}

?>