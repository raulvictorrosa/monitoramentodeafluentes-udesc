<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package monitoramentodeafluentes-theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>

		<!-- Bootstrap core CSS -->
		<link href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<link href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>

	<body <?php body_class(); ?>>
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
          <a class="navbar-brand brand-logo" href="<?php echo get_site_url(); ?>">
          	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="UDESC - CEPLAN" title="UDESC - CEPLAN" height="40">
          	<?php echo get_bloginfo(); ?>
        	</a>
        </div>

        <?php
          wp_nav_menu(
            array(
              'theme_location'  => 'primary',
              'container_class' => 'primary-menu'
            )
          );
        ?>

        <div id="navbar" class="collapse navbar-collapse" style="display: none !important;">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo get_site_url(); ?>">Home</a></li>
            <li><a href="<?php echo get_site_url(); ?>/profundidade">Profundidade</a></li>
            <li><a href="<?php echo get_site_url(); ?>/temperatura">Temperatura</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
		<!-- /header --> 
