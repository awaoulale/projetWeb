<html>
 <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title> ECEPlouf Afficher profil</title>
	    <link rel="icon" type="image/png" href="plouf.jpg" />
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
 <link rel="stylesheet" href="emplois.css"  /> 
 </head>

 
<body>



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
  echo'        <li><a href="messagerie.php">Messagerie</a></li>';
  
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



?>








<?php

$data=explode(" ", $_POST['utilisateurs']);
$nom = $data[0];
$prenom = $data[1];

echo '<div id="infos">';
echo '<h2>  Profil de '.$prenom.' '.$nom.'</h2>';
echo '</div>';
  
//session_start(); // On démarre la session AVANT toute chose
	$serveur="localhost";
    $log="root";
    $mdp="";

	$bdd="projetweb";
	$connect=mysqli_connect($serveur,$log,$mdp);
	$con=mysqli_select_db($connect,$bdd);
	$mail=$_SESSION['mail'];
	$pseudo=$_SESSION['pseudo'];

	
	if(!$connect )
	echo"pb de connexion";
else
{
	
	// Recherche du profil
		$resultat1=mysqli_query($connect, "SELECT U.Nom,U.Prenom,P.chemin 
	  FROM utilisateurs U, profil P
          WHERE U.Nom='$nom' AND U.Prenom='$prenom' AND U.id=P.id_utilisateur");
	if($resultat1)
	{
		$idami=mysqli_fetch_array($resultat1);			
		echo '<img src="'.$idami["chemin"].'" alt="photo" height="150" width="150" />';
		echo $idami["Prenom"]. " " .$idami["Nom"]. "<br/>". "<br/>";
		
	}
	
	
		// Recherche du cv
		$resultat3=mysqli_query($connect, "SELECT C.naissance,C.specialite,C.diplome,C.experience,C.hobbys 
		FROM utilisateurs U, cv C 
		WHERE U.id=C.id_auteur AND U.id=(SELECT id FROM utilisateurs WHERE Nom='$nom' AND Prenom='$prenom')");
	if($resultat3)
	{
		$data3=mysqli_fetch_array($resultat3);			
		echo "Date de naissance : " .$data3["naissance"]. "<br/>" . "Spcialites : " .$data3["specialite"]. "<br/>". 
		"Diplome : ".$data3["diplome"]. "<br/>" ."Experiences : " .$data3["experience"]."<br/>" ."Hobbys : ".$data3["hobbys"];
		
	}



	
	echo "<br/><br/><br/>";	
	
	
		$resultat1=mysqli_query($connect, "SELECT U.id
	  FROM utilisateurs U 
          WHERE U.Nom='$nom' AND U.Prenom='$prenom'");
	if($resultat1)
	{
		$idami=mysqli_fetch_array($resultat1);			
		$id2 = $idami["id"];
//		echo '*'.$id2.'*';
	}


	$resultat1=mysqli_query($connect, "SELECT U.Nom 
	  FROM utilisateurs U, amis A 
          WHERE A.id_ami1=(SELECT id FROM utilisateurs WHERE mail='$mail' AND pseudo='$pseudo')
          AND A.id_ami2='$id2'");

	$data=mysqli_fetch_assoc($resultat1);
	 if($data==""){
		
		echo 'Pas encore suivie';
		echo '<form action="nouvel_ami.php" method="post">';		
			echo '<input type="submit" value="Suivre"/>';
			echo '<input type="hidden" name="id_ami" value='.$id2.' />';
		echo '</form>';
		
	}
	else {
		echo 'Déjà suivie';
		echo '<form action="plus_ami.php" method="post">';		
		echo '<input type="submit" value="Ne plus suivre"/>';
		echo '<input type="hidden" name="id_ami" value='.$id2.' />';
		echo '</form>';
	}		
	
}	
		
?>





<div id="footer">
  <div class="container">
    <p class="text-muted">Copyright ©2018 ECE Paris, A. OULALE - M. TREUVELOT - E. VERMEULEN</p>
  </div>
</div>
</body>
	


</html>