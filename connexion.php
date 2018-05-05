<?php
session_start(); // On démarre la session AVANT toute chose
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
</head>

<header class="masthead">
  	<!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="reseauprofessionnel.jpg" alt="Reseau professionnel">
          <div class="container">
            <div class="carousel-caption">
              <h2>Elargissez votre reseau professionnel !</h2>
              <p></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="offresprofessionnelles.jpg" alt="Offres professionnelles">
          <div class="container">
            <div class="carousel-caption">
              <h2>Accedez a de nombreuses offres professionnelles !</h2>
              <p></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="partageechange.jpg" alt="Partage et echange">
          <div class="container">
            <div class="carousel-caption">
              <h2>Partagez &amp; Echangez !</h2>
              <p></p>
            </div>
          </div>
        </div>       
      </div><!-- /.carousel-inner -->
      <div class="logo"><b><font size="20">ECEPlouf</font></b></div> 
      <!-- Controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>  
    </div>
    <!-- /.carousel -->
  <!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed"></script>
		<script src="js/scripts.js"></script>
  <!-- jQuery -->
   		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Javascript de Bootstrap -->
   		 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</header>



<body>
    <center>
	
	
	
	<div id="infos">
 <h3> Bienvenue sur ECE Plouf!</h3>
   <p> Ce site va vous permettre de vous connecter à la communauté de l'ECE Paris.
 </br> Postez votre CV, constituez votre réseau et profitez des offres de stages et d'emplois de nos alumnis!</p>
 <br/>
 
	

    <form action="connexion_traitement.php" method="post">
	
	    <label> mail</label>
		<input type="text" name="mail"/><br/>
		
		
		<br/>
		<br/>
		
		<label> pseudo </label>
		<input type="text" name="pseudo"/><br/>
	
	
	    <br/>
		<br/>
		
		
		<input type="submit" value="Connexion"/>
	</form>
	
	<small>Toujours pas inscrit? <a href="inscription.php">Créez vous un compte!</a>
	
	</small>
	
	</center>
	
</body>	

</html>