
</div><!-- end #wrapper -->

<div id="footer-wrap" class="container">

	<?php do_action('leeway_before_footer'); ?>

	<footer id="footer" class="clearfix" role="contentinfo">

		<nav id="footernav" class="clearfix" role="navigation">
			<?php
				// Get Navigation out of Theme Options
				wp_nav_menu(array('theme_location' => 'footer', 'container' => false, 'menu_id' => 'footernav-menu', 'echo' => true, 'fallback_cb' => '', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'depth' => 1));
			?>
		</nav>

		<div id="footer-text">
			<?php do_action('leeway_footer_text'); ?>
		</div>

	</footer>

</div>

<?php wp_footer(); ?>
</body>
</html>
