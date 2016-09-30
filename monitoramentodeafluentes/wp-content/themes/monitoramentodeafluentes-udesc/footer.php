<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package monitoramentodeafluentes-theme
 */

?>
			<?php /*
			</div> --><!-- #content

			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'monitoramentodeafluentes-udesc' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'monitoramentodeafluentes-udesc' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'monitoramentodeafluentes-udesc' ), 'monitoramentodeafluentes-udesc', '<a href="http://www.ceplan.udesc.br/" rel="designer">Raul Victor Rosa <raulvictorrosa@gmail.com></a>' ); ?>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
		</div><!-- #page -->
		*/ ?>

		<?php wp_footer(); ?>

    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/function.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui/jquery-ui.min.js"></script> <!-- Para exibição de label com formato de tempo -->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugin/flot/jquery.flot.js"></script> 
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugin/flot/jquery.flot.time.js"></script> <!-- Para exibição de label com formato de tempo -->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugin/timezone-js/src/date.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugin/flot/jquery.flot.resize.js"></script> <!-- Para responsividade -->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugin/flot/jquery.flot.canvas.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/strftime/strftime.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugin/datas-charts/app.js"></script>
	</body>
</html>
