<?php
session_start(); 
?>
<html>
 <head>
 
 



       <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	   <meta charset="utf-8">
	   <title> ECEPlouf Administrateur</title>
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


	
	
<div id="infos">
 <h2>  Supression des utilisateurs inactifs  </h2>
</div>


<?php
// seuil de 1 a 5 ans
$seuil_date = $_POST['seuil_date'];
$jours= $seuil_date*365;
//echo"$seuil_date";
//echo"$jours";


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
	//on construit les requetes
	
	//Supression des docs
	
		$sql="DELETE FROM `documents` WHERE id_auteur IN (SELECT id FROM utilisateurs WHERE DATEDIFF(NOW(),lastconnexion)>'$jours')";
		
	//Supression des réaction
	
		$sql2="DELETE FROM `reactions` WHERE id_utilisateur IN (SELECT id FROM utilisateurs WHERE DATEDIFF(NOW(),lastconnexion)>'$jours')";	
		
	//Supression de leurs amitiés
	
		$sql3="DELETE FROM `amis` WHERE id_ami1 IN (SELECT id FROM utilisateurs WHERE DATEDIFF(NOW(),lastconnexion)>'$jours')";		
		$sql4="DELETE FROM `amis` WHERE id_ami2 IN (SELECT id FROM utilisateurs WHERE DATEDIFF(NOW(),lastconnexion)>'$jours')";		
		
		
		//Supression des cv
	
		$sql5="DELETE FROM `cv` WHERE id_auteur IN (SELECT id FROM utilisateurs WHERE DATEDIFF(NOW(),lastconnexion)>'$jours')";	
		
		//Supression des photos de profils
	
		$sql6="DELETE FROM `profil` WHERE id_utilisateur IN (SELECT id FROM utilisateurs WHERE DATEDIFF(NOW(),lastconnexion)>'$jours')";	
		
	    $res= mysqli_query($connect,$sql);
		$res2= mysqli_query($connect,$sql2);
		$res3= mysqli_query($connect,$sql3);
		$res4= mysqli_query($connect,$sql4);
		$res5= mysqli_query($connect,$sql5);
		$res6= mysqli_query($connect,$sql6);
	
	    
	
	//et enfin on les suprrime des utilisateurs
	
	if($res3){
		
		$sql7="DELETE FROM `utilisateurs` WHERE DATEDIFF(NOW(),lastconnexion)>'$jours'";	
		
	    $res= mysqli_query($connect,$sql7);
		 
		 header('Location: admin.php');
	}
	else{
	echo "erreur requete";
	
	
	}
	mysqli_close($connect);
}
?>

	



	
<div id="footer">
  <div class="container">
    <p class="text-muted">Copyright ©2018 ECE Paris, A. OULALE - M. TREUVELOT - E. VERMEULEN</p>
  </div>
</div>

	
</body>	
</html>
