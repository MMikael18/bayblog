<?php
  
  /* ************************************************************************ */
// --------------------------- Scripts and stylesheets ---------------------------
/* ************************************************************************ */
function startwordpress_scripts() {
    // css
    wp_enqueue_style( 'theme' , get_template_directory_uri() . '/assets/public.min.css',false,'1.1','all');
    // js
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/public.min.js', array ( 'jquery' ), 1.1, true);
}
add_action( 'wp_enqueue_scripts', 'startwordpress_scripts' );
  

function theme_prefix_setup() {
	
	add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
  ));

}
add_action( 'after_setup_theme', 'theme_prefix_setup' );

function bay_theme_custom_logo() {
	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

}

/************************/
// Theme Customizer 
/************************/

function mytheme_customize_register( $wp_customize ) {
  //All our sections, settings, and controls will be added here

  // Colors
  $wp_customize->add_section( 'cd_colors' , array(
    'title'      => 'Colors',
    'priority'   => 30,
  ) );

  /* settings */
  $wp_customize->add_setting( 'background_color' , array(
    'default'     => '#fff',
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_setting( 'header_color' , array(
    'default'     => '#fff',
    'transport'   => 'refresh',
  ) );

  /* controlls */
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
    'label'        => 'Background Color',
    'section'    => 'cd_colors',
    'settings'   => 'background_color',
  ) ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
    'label'        => 'Header Color',
    'section'    => 'cd_colors',
    'settings'   => 'header_color',
  ) ) );

}
add_action( 'customize_register', 'mytheme_customize_register' );

function cd_customizer_css()
{
    ?>
         <style type="text/css">
             body { background: #<?php echo get_theme_mod('background_color', '#43C6E4'); ?>; }
             body > header.main { background-color: <?php echo get_theme_mod('header_color', '#43C6E4'); ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'cd_customizer_css');

// add_filter( 'body_class', function( $classes ) {
//   if(is_admin_bar_showing()){
//     array_merge( $classes, array( 'bay-admin' ) );
//   }
//   return $classes;
// });
  
?>