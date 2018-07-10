<?php get_header(); ?>

<div class="container bay-container">
    <div class="row">
        <div class="col-sm">
            <main class="bay-single-content-width">
			<?php 
            if ( have_posts() ) : 
                while ( have_posts() ) : 
                    the_post();
			?>
                    <div class="blog-post">                        
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