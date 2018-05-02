<?php
session_start(); // On démarre la session AVANT toute chose
?>

<!DOCTYPE html>
<html lang="en">
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
	<body>
<!-- Wrap all page content here -->
<div id="wrap">

 
  
  
<?php include("fixednavbar.php"); ?>
  
<!-- Begin page content -->

<div class="container">
  <div class="col-sm-10 col-sm-offset-1">
    <div class="page-header text-center">
      <h1>Boostez votre carriere</h1>
    </div>
    
    <p class="lead text-center"> 
      L'ECE Paris vous propose une platforme entierement dediee a votre parcours professionnel
    </p> 
    
    <hr>
    
  </div>
</div>
    

<div class="row">
  	<div class="col-sm-10 col-sm-offset-1">
  	  <h1> <?php 	echo "Bienvenue" . " " . $_SESSION['pseudo'] . "!" . "<br/>";  ?> </h1>
      <h2>Votre Newsfeed</h2>
      
      <hr>
      <p>Publications</p> 
      <p>Photos</p> 
      <p>Videos</p> 
      <hr>
      
      <div class="divider"></div>
      
  	</div><!--/col-->
</div><!--/container-->


<div class="bg-4">
  <div class="container">
	<div class="row">
		
	
		<div class="col-sm-12 col-xs-6"> 
	    <div class="panel panel-default">
	    	<div class="panel-body">
				 <p> <b>
				 	<?php include("newsfeed.php"); ?>
				 </b></p>
			</div>

		</div><!--/panel-->
		</div><!--/col-->
      
      
      
	</div><!--/row-->
  </div><!--/container-->
</div>

<div class="divider" id="section4"></div>

<?php include("footer.php"); ?>

<ul class="nav pull-right scroll-top">
  <li><a href="#" title="Scroll to top"><i class="glyphicon glyphicon-chevron-up"></i></a></li>
</ul>


<div class="modal" id="myModal" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content">
	<div class="modal-header">
		<button class="close" type="button" data-dismiss="modal">×</button>
		<h3 class="modal-title"></h3>
	</div>
	<div class="modal-body">
		<div id="modalCarousel" class="carousel">
 
          <div class="carousel-inner">
           
          </div>
          
          <a class="carousel-control left" href="#modaCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
          <a class="carousel-control right" href="#modalCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
          
        </div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
   </div>
  </div>
</div>


	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed"></script>
		<script src="js/scripts.js"></script>
		
	<!-- jQuery -->
   		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Javascript de Bootstrap -->
   		 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</body>
</html>