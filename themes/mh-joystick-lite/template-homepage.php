<?php /* Template Name: Homepage */ ?>
<?php get_header(); ?>
<div class="mh-home clearfix">
	<div id="main-content" class="home-columns">
		<?php dynamic_sidebar('home-main-column'); ?>
	</div>
	<aside class="home-sidebar">
		<?php dynamic_sidebar('home-sidebar'); ?>
	</aside>
</div>
<?php get_footer(); ?>