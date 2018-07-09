<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <main class="bay-single">
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
                // If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
                endif;
                
                endwhile; 
            endif; 
            ?>
            </main>
		</div>
	</div>
</div>

<?php get_footer(); ?>