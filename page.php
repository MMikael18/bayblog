<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <main class="bay-page">
			<?php 
            if ( have_posts() ) : 
                while ( have_posts() ) : 
                    the_post();
			?>
                    <div class="blog-post">
                        <h2 class="blog-post-title"><?php the_title(); ?></h2>
                        <p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
                        <?php the_content(); ?>
                    </div>
            <?php
                endwhile; 
            endif; 
			?>
            </main>
		</div>
	</div>
</div>

<?php get_footer(); ?>