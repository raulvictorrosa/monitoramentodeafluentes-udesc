<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/img/favicon.ico">
		
		<title>Monitoramento de Afluentes</title>
		
		<!-- Bootstrap core CSS -->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<link href="../assets/css/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- scripts -->
    <script src="../assets/js/jquery/jquery.min.js"></script>
    <script src="../assets/js/bootstrap-js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    
    <script src="../assets/js/canvasjs.min.js"></script>
	</head>
	
	<body>
		<!-- header -->
		<nav class="navbar navbar-inverse navbar-fixed-top cabecalho">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand brand-logo" href="http://127.0.0.1/monitoramentodeafluentes/">
          	<?php //echo get_bloginfo(); ?>
          	<img src="../assets/img/logo.png" alt="UDESC - CEPLAN" title="UDESC - CEPLAN" height="40">
          	Monitoramento de Afluentes
        	</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="http://127.0.0.1/monitoramentodeafluentes/">Home</a></li>
            <li><a href="#profundidade">Profundidade</a></li>
            <li><a href="#temperatura">Temperatura</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
		<!-- /header -->         