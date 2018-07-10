<?php

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/gutenberg.php';


class Bayset {
  public static $domain = 'bay_blogtheme';
}

/************************************/
// Scripts and stylesheets 
/************************************/

function bay_theme_scripts() {
    // css
    wp_enqueue_style( 'theme' , get_template_directory_uri() . '/assets/public.min.css',false,'1.1','all');
    // js

    // register our main script but do not enqueue it yet
    $publicjs = get_template_directory_uri() . '/assets/public.min.js';
    wp_register_script( 'publicjs', $publicjs, array('jquery') );
    
    wp_localize_script( 'publicjs', 'bay_loadmore_params', array(
      'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
      'posts_per_page' =>   get_theme_mod('posts_per_page', '8')
      //'posts' => json_encode( $wp_query->query_vars ),
      //'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
      //'max_page' => $wp_query->max_num_pages
    ) );

    wp_enqueue_script('publicjs');
}
add_action( 'wp_enqueue_scripts', 'bay_theme_scripts' );

/************************************/
// Add Theme Support
/************************************/

function theme_prefix_setup() {

  add_theme_support( 'custom-header' );
	add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
  ));
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'title-tag' );
}

add_action( 'after_setup_theme', 'theme_prefix_setup' );


/************************************/
// Theme content helper functions
/************************************/

if (!function_exists('bay_theme_custom_logo')) {
  function bay_theme_custom_logo() {    
    if ( function_exists( 'the_custom_logo' ) ) {
      $logo = get_custom_logo(0);
      if(!empty($logo)){
        echo $logo;
      }else{
        ?><a href="/" class="custom-logo-link"><span class="custom-logo"><?php echo get_bloginfo( 'name' ); ?></span></a><?php        
      }
      
    }    
  }
}

if (!function_exists('bay_get_burger')) {
  function bay_get_burger(){    
    ?>
    <button class="burger-button">
      <div></div>
      <div></div>
      <div></div>
    </button>
    <?php
  }
}

if (!function_exists('bay_hero_header')) {
  function bay_hero_header(){

    global $wp_query;
    $post = $wp_query->post;
    $background_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' )[0];
    if(is_home()){
      $background_img = get_theme_mod('bay_theme_customizer_backgroundimage','');
    }
    $style = "";
    if(strlen($background_img)){
      $style = "style='background-image: url(".$background_img.")'";
    }
    ?>
    <div class="bay-hero-header" <?php echo $style; ?> >
      <div class="container"> 
        <div class="row">
          <div class="col-sm bay-hero-col">            
              <?php if (is_home()): ?>
                <div class="bay-hero-content">
                  <h1><?php echo get_bloginfo( 'name' ); ?></h1>
                  <p><?php echo get_bloginfo( 'description', 'display' );?></p>
                </div>
                <?php else :
                  bay_post_header();
                ?>
              <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
}

if (!function_exists('bay_post_header')) {
  function bay_post_header(){
    global $wp_query;
    $post = $wp_query->post;
   
    $date = date_i18n( get_option( 'date_format' ), strtotime( $post->post_modified ) );
    $author_name = get_the_author_meta( 'display_name', $post->post_author);
    ?>
    <div class="bay-single-content-width">
      <h2 class="blog-post-title"><?php the_title(); ?></h2>
      <p class="blog-post-meta"><?php echo $date; ?> 
        <?php _e('by', Bayset::$domain) ?>
        <a href="#"><?php echo $author_name; ?></a>
      </p>      
    </div>
    <?php
  }
}


/************************************/
// Widget Areas
/************************************/

function bay_widgets_init(){
  register_sidebar(array(
    'name' => __('Widgetized Area', Bayset::$domain),
    'id'   => 'bay_left_two',
    'description'   => 'Widged area in left menu.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ));
}
add_action( 'widgets_init', 'bay_widgets_init' );

/************************************/
// Ajax
/************************************/

// id postID then get one post
  // if (isset($data['postID'])){
  //     global $post;
  //     $postID = $data['postID'];
  //     $post = get_post($postID);
  //     get_template_part( 'parts/content', get_post_format() );
  //     die();
  // }
if (!function_exists('ajax_postlist_handler')) {
  function ajax_postlist_handler() {
    
    // get json get data
    $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
    $data = json_decode(file_get_contents('php://input'), true);

    // prepare our arguments for the query
    $query = sanitize_text_field($data['query']);
    if (!isset($query)) return;

    $args = array(
      //'paged' => $paged,
      //'posts_per_page' => 9,
      'post_type' => 'post',
      's' => $query
    );
    query_posts( $args );
  
    if( have_posts() ) :
      while( have_posts() ): the_post();
        get_template_part( 'parts/content', get_post_format() );      
      endwhile;
    endif;
    
    die;
  }
}
add_action( 'wp_ajax_get_postlist', 'ajax_postlist_handler' );
add_action( 'wp_ajax_nopriv_get_postlist', 'ajax_postlist_handler' );


?>