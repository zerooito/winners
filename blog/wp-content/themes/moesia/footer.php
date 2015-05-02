<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Moesia
 */
?>

	<?php tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
	
	<?php tha_footer_before(); ?>
	<?php if ( is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) || is_active_sidebar( 'sidebar-5' ) ) : ?>
		<?php get_sidebar('footer'); ?>
	<?php endif; ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php tha_footer_top(); ?>
		<div class="site-info container">
			<a href="<?php echo esc_url( __( 'http://www.winnersdesenvolvimento/', 'winners' ) ); ?>"><?php printf( __( 'By %s', 'winners' ), 'Winners Desenvolvimento' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Tema: %2$s by %1$s', 'Reginaldo Junior' ), 'Winners', '<a href="http://www.winnersdesenvolvimento.com.br">Winners</a>' ); ?>
		</div><!-- .site-info -->
		<?php tha_footer_bottom(); ?>
	</footer><!-- #colophon -->
	<?php tha_footer_after(); ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
