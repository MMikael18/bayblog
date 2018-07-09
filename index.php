<?php get_header(); ?>

<div class="container" id="bay-container"> 
    <div class="row">
        <div class="col-sm">
            <main class="bay-index bay-blog-mainlist" id="data-containes">
            <?php
                $allposts = array( 
                    'post_type'      =>  'post',
                    'posts_per_page' =>  get_theme_mod('posts_per_page', '8')
                );            
                $wp_query = new WP_Query($allposts); 
                if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : the_post(); 
                    get_template_part( 'parts/content', get_post_format() );
                endwhile; else: 
                    _e('Sorry, no posts matched your criteria.','bay_theme'); 
                endif; 
            ?>
            </main>
        </div>
        
    </div>
</div>

<?php get_footer(); ?>