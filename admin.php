<?php
session_start(); 
?>
<html>
 <head>
 
 



       <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	   <meta charset="utf-8">
	   <title> ECEPlouf Administrateur</title>
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



?>

<!--
<center>
	
<h1 class="logo"><img src="logoPlouf.png"  height="150" width="350"/></h1>

	</center>
	-->
	
	
	
<div id="infos">
 <h2>  Administrateur   </h2>
</div>
	
  	
	
	
	
	
	
	
	

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
		$sql="SELECT Nom,Prenom,mail,lastconnexion FROM utilisateurs ORDER BY lastconnexion DESC";
	//$sql="SELECT U.Nom,U.Prenom,U.mail,D.chemin FROM utilisateurs U JOIN profil D ON U.id=D.id_utilisateur WHERE U.mail='$mail' AND U.pseudo='$pseudo'";
	
	// on ecrit notre requete, on l enverra avec jquery
	$res= mysqli_query($connect,$sql);
	if($res){
		echo'<center>';
		echo'<table>';
            echo'<tr>';
            echo'<td>Nom</td>';
            echo'<td>Prenom</td>';
            echo'<td>Mail</td>';
			echo'<td>Derniere connexion</td>';
            echo'</tr>';
		//on traite les résultats
		//chaque ligne
		while($data=mysqli_fetch_assoc($res)){// tant qu on peut extraire
			
           
			
			
			
			echo'<tr>';
			echo'<td>'.$data['Nom'].'</td>';
			echo'<td>'.$data['Prenom'].'</td>';
			echo'<td>'.$data['mail'].'</td>';
			echo'<td>'.$data['lastconnexion'].'</td>';
			echo'</tr>';
			
		
		}
		 echo'</table>';
		 echo'</center>';
	}
	else{
	echo "erreur requete";
	
	
	}
	mysqli_close($connect);
}
?>

	

<form method="post" action="supression_utilisateur_inactif.php">
  <fieldset>
    <h7>Supprimer des utilisateurs dont la derniere connexion date de plus de :</h7>
    <div>
      <input type="radio" id="contactChoice1"
       name="seuil_date" value="1">
      <label for="contactChoice1">1 an</label>
      <input type="radio" id="contactChoice1"
       name="seuil_date" value="2">
      <label for="contactChoice1">2 ans</label>
      <input type="radio" id="contactChoice1"
       name="seuil_date" value="3">
      <label for="contactChoice1">3 ans</label>
      <input type="radio" id="contactChoice1"
       name="seuil_date" value="4">
      <label for="contactChoice1">4 ans</label>
      <input type="radio" id="contactChoice1"
       name="seuil_date" value="5" checked>
      <label for="contactChoice1">5 ans</label>
      <button type="submit">Supprimer</button>

    </div>
  </fieldset>
</form>
	


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


	
	if(!$connect)
	echo"pb de connexion";
else
{
	// Barre de recherche
	echo '<div id="searchbar">';
	echo '<form method="post" action="ajout_util.php">';
	echo '   <p>';
	echo '       <label for="utilisateurs">Ajouter un utilisateur</label><br />';
	echo '       <select name="utilisateurs" id="utilisateurs">';
		$resultat1=mysqli_query($connect, "SELECT nom,prenom 
		  FROM ece");
		if($resultat1)
		{
			while($data=mysqli_fetch_array($resultat1))
			{
				$nom = $data["nom"];
				$prenom = $data["prenom"];
				$resultat2=mysqli_query($connect, "SELECT Nom 
					FROM utilisateurs WHERE Nom='$nom' AND Prenom='$prenom'");
				$data2=mysqli_fetch_assoc($resultat2);
				if($data2==""){
					echo '<option value="'.$data["nom"]." ".$data["prenom"]."\">".
					$data["nom"]." ".$data["prenom"].'
					</option>';		
				}
			}
		}
	echo '       </select>';
	echo '       <input class="bouton" type="submit" value="Ajouter " />';
	echo '   </p>';

	echo '	</form>';
	echo '</div>';
	// Fin barre de recherche
		
	
		
	
}	

?>




<?php
$serveur="localhost";
    $log="root";
    $mdp="";

	$bdd="projetweb";
	$connect=mysqli_connect($serveur,$log,$mdp);
	$con=mysqli_select_db($connect,$bdd);
	$mail=$_SESSION['mail'];
	$pseudo=$_SESSION['pseudo'];


	
	if(!$connect)
	echo"pb de connexion";
else
{

	// Barre de recherche
	echo '<div id="searchbar">';
	echo '<form method="post" action="sup_util.php">';
	echo '   <p>';
	echo '       <label for="utilisateurs">Supprimer un utilisateur</label><br />';
	echo '       <select name="utilisateurs" id="utilisateurs">';
		$resultat1=mysqli_query($connect, "SELECT Nom,Prenom 
		  FROM utilisateurs WHERE pseudo<>'JSegado'");
		if($resultat1)
		{
			while($data=mysqli_fetch_array($resultat1))
			{
				$nom = $data["Nom"];
				$prenom = $data["Prenom"];
				
					echo '<option value="'.$data["Nom"]." ".$data["Prenom"]."\">".
					$data["Nom"]." ".$data["Prenom"].'
					</option>';		
				//}
			}
		}
	echo '       </select>';
	echo '       <input class="bouton" type="submit" value="Supprimer " />';
	echo '   </p>';

	echo '	</form>';
	echo '</div>';
	// Fin barre de recherche
}	
	
		
	
	

?>












	
<div id="footer">
  <div class="container">
    <p class="text-muted">Copyright ©2018 ECE Paris, A. OULALE - M. TREUVELOT - E. VERMEULEN</p>
  </div>
</div>

	
</body>	
</html>
