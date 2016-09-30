<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package monitoramentodeafluentes-theme
 */

get_header(); ?>
<?php
/*$result = $wpdb->get_results('SELECT idEvento_dad, data, hora, dados, Sensor_codSensor FROM `monitoramentodeafluentes`.`evento_dados` WHERE Sensor_codSensor = "UL0" LIMIT 5;');
$data = array();
foreach($result as $row) {
	$data[] = $row;
};

print json_encode($data)."<br><br><br>";*/
?>
<div class="container">
	<div id="header">
		<h2>Umidade</h2>
	</div>
	<div class="demo-container">
		<div id="placeholder" class="demo-placeholder"></div>
	</div>
	<p class="message"></p>
	<p>
		<label>Ponto clicado: </label>
		<span id="hoverdata"></span>
		<span id="clickdata"></span>
	</p>
	<p>Time between updates: <input id="updateInterval" type="text" value="" style="text-align: right; width:5em"> milliseconds</p>
</div>

<div class="container">
	<table class="table table-striped table-bordered" style="width:auto;left: 50%;position: relative;transform: translateX(-50%);">
		<tr>
			<td>Id Evento</td>
			<td>Data</td>
			<td>Hora</td>
			<td>Dado</td>
			<td>Código do Sensor</td>
		</tr>
  	<?php
  	$resultados = $wpdb->get_results('SELECT idEvento_dad, data, hora, dados, Sensor_codSensor FROM `monitoramentodeafluentes`.`evento_dados` WHERE Sensor_codSensor = "UL0" ORDER BY idEvento_dad LIMIT 5');
  	foreach($resultados as $resultado) {
			echo "<tr>";
			echo "<td>{$resultado->idEvento_dad}</td>";
			echo "<td>{$resultado->data}</td>";
			echo "<td>{$resultado->hora}</td>";
			echo "<td>{$resultado->dados}</td>";
			echo "<td>{$resultado->Sensor_codSensor}</td>";
			echo "</tr>";
		};
		?>
	</table>
  <div class="starter-template">
    <h1>Bootstrap starter template</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
  </div>
</div><!-- /.container -->
				<?php
				/*
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>

						<?php
						endif;

						/* Start the Loop */
						//while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							/* get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

					</main><!-- #main -->
				</div><!-- #primary --> */
				?>

<?php
//get_sidebar();
get_footer();
