<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-sm bay-blog-mainlist">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p>Posted on <?php the_time('F jS, Y') ?></p>
                    <?php the_excerpt(__('(more...)')); ?>                    
                </article>
            <?php endwhile; else: ?>
                <?php _e('Sorry, no posts matched your criteria.'); ?><
            <?php endif; ?>
        </div>
        
    </div>
</div>

<?php get_footer(); ?>