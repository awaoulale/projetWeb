<?php
session_start(); 
?>

<html>
 <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title> ECEPlouf</title>
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


<div id="infos">
 <h2>  Mon réseau   </h2>
</div>
	



<?php
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
	// Barre de recherche
	echo '<div id="searchbar">';
	echo '<form method="post" action="">';
	echo '   <p>';
	echo '       <label for="utilisateurs">Rechercher quelqu\'un</label><br />';
	echo '       <select name="utilisateurs" id="utilisateurs">';
		$resultat1=mysqli_query($connect, "SELECT Nom,Prenom 
		  FROM utilisateurs");
		if($resultat1)
		{
			while($data=mysqli_fetch_array($resultat1))
			{
			   echo '<option value=\"'.$data["Nom"]." ".$data["Prenom"]."\">".
			   $data["Nom"]." ".$data["Prenom"].'
			   </option>';
			}
		}
	echo '       </select>';
	echo '       <input class="bouton" type="button" value="Rechercher " />';
	echo '   </p>';

	echo '	</form>';
	echo '</div>';
	// Fin barre de recherche
	
	// Affichage des amis	
	$resultat1=mysqli_query($connect, "SELECT U.Nom,U.Prenom,P.chemin
	  FROM utilisateurs U, profil P, amis A
          WHERE A.id_ami1=(SELECT id FROM utilisateurs WHERE pseudo='$pseudo')
          AND P.id_utilisateur=A.id_ami2
          AND P.id_utilisateur=U.id");
	if($resultat1)
	{
		while($idami=mysqli_fetch_array($resultat1))
		{
			//echo $idami["Prenom"]. " " .$idami["Nom"]. "<br/>". "<br/>";
			
			//$id_doc=$idami["id_doc"];
			
			echo '<img src="'.$idami["chemin"].'.jpg" alt="photo" height="150" width="150" />';
			//echo '<span class="marge">';
			echo $idami["Prenom"]. " " .$idami["Nom"]. "<br/>". "<br/>";
			//echo '</span>';
			echo "<br/><br/><br/>";
		}
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