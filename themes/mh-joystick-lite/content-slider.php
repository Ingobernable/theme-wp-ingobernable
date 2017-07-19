<article class="slide-wrap">
    <div class="content-slide-thumb">
    	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        	<?php if (has_post_thumbnail()) { the_post_thumbnail('mh-joystick-lite-slider'); } else { echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-slider.png' . '" alt="No Image" />'; } ?>
        </a>
    	<?php if (has_category()) { ?>
    		<span class="content-slide-category">
    			<?php $category = get_the_category(); echo $category[0]->cat_name; ?>
    		</span>
    	<?php } ?>
        <h2 class="content-slide-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>
    </div>
</article>