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
<div class="container">
  <!-- <div class="starter-template">
    <h1>Home</h1>
    <p class="lead">
      Use this document as a way to quickly start any new project.<br>
      All you get is this text and a mostly barebones HTML document.
    </p>
  </div> -->
  <div class="row">
		<div class="col-sm-12">
			<h1 style="text-align: center;">Profundidade</h1>
			<div id="chartProfundidade" style="height: 400px;"></div>
			<table class="table table-striped table-bordered" style="display: none;width:auto;left: 50%;position: relative;transform: translateX(-50%);">
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
		</div>
	</div>
</div><!-- /.container -->
<?php
//get_sidebar();
get_footer();
