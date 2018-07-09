<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p>Posted on <?php the_time('F jS, Y') ?></p>
    <?php the_excerpt(__('(more...)')); ?>                    
</article>