<?php
/************************/
// Theme Customizer 
/************************/

function mytheme_customize_register( $wp_customize ) {
  //All our sections, settings, and controls will be added here

  // Remove
  $wp_customize->remove_section( 'header_image' );
  $wp_customize->remove_section( 'colors' );

  // Sections
  $wp_customize->add_section( 'section_site_look' , array(
    'title'      => esc_html__( 'Site look', 'bay_theme_admin' ),
    'priority'   => 30,
  ) );

  $wp_customize->add_section( 'section_post_list' , array(
    'title'      => esc_html__( 'Posts listing', 'bay_theme_admin' ),
    'priority'   => 25,
  ) );

  /* settings */

  // site look
  $wp_customize->add_setting( 'background_color' , 
    array(
      'default'     => '#fff',
      'transport'   => 'refresh',
    ) 
  );

  $wp_customize->add_setting( 'header_color' , 
    array(
      'default'     => '#fff',
      'transport'   => 'refresh',
    ) 
  );

  $wp_customize->add_setting( 'bay_theme_customizer_backgroundimage', 
    array(
        'sanitize_callback' => 'bay_theme_sanitize_backgroundimage'
    )
  );

    function bay_theme_sanitize_backgroundimage( $file, $setting ) {         
      $mimes = array(
          'jpg|jpeg|jpe' => 'image/jpeg',
          'gif'          => 'image/gif',
          'png'          => 'image/png'
      );
      $file_ext = wp_check_filetype( $file, $mimes );
      return ( $file_ext['ext'] ? $file : $setting->default );
    }

  $wp_customize->add_setting( 'bay_theme_header_height', 
    array( 'sanitize_callback' => 'absint')
  );
    
  $wp_customize->add_setting( 'bay_theme_header_opacity', array(
    'default' => '0',
    //'type' => 'theme_mod',
    //'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    //'sanitize_callback' => 'wpse_intval',
  ) );
  
  // post list
  $wp_customize->add_setting( 
    'posts_per_page', 
    array(
        'default'     => '9',
        'sanitize_callback' => 'absint' //converts value to a non-negative integer
    )
  );
 
  /* controlls */
  
  // section_site_look
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
    'label'        => esc_html__( 'Background Color', 'bay_theme_admin' ),
    'section'    => 'section_site_look',
    'settings'   => 'background_color',
  ) ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
    'label'        => esc_html__( 'Header Color', 'bay_theme_admin' ),
    'section'    => 'section_site_look',
    'settings'   => 'header_color',
  ) ) );

  $wp_customize->add_control( 
    new WP_Customize_Upload_Control( 
        $wp_customize, 
        'bay_theme_customizer_backgroundimage', 
        array(
            'label'      => __( 'Hero Image', 'bay_theme_admin' ),
            'section'    => 'section_site_look'                    
        )
    ) 
  ); 
  $wp_customize->add_control( 
    'bay_theme_header_height', 
    array(
      'label' => esc_html__( 'Hero Image Space', 'bay_theme_admin' ),
      'section' => 'section_site_look',
      'type' => 'number'
    )
  ); 
  $wp_customize->add_control( 'bay_theme_header_opacity', array(
    'type' => 'range',
    'priority' => 10,
    'section' => 'section_site_look',
    'label' => __( 'Hero image shade', 'bay_theme_admin' ),
    'description' => '',
    'input_attrs' => array(
            'min' => 0,
            'max' => 1,
            'step' => .01,
            //'class' => 'example-class',
            //'style' => 'color: #ff0022',
            ),
    ));

  // section_post_list

  $wp_customize->add_control(
    'posts_per_page', 
    array(
        'label' => esc_html__( 'Posts per page', 'bay_theme_admin' ),
        'section' => 'section_post_list',
        'type' => 'number'
    )
  );
  
}
add_action( 'customize_register', 'mytheme_customize_register' );

function cd_customizer_css()
{
  ?>
    <style type="text/css">
      body { background: #<?php echo get_theme_mod('background_color', '#43C6E4'); ?>; }
      body > header.main { background-color: <?php echo get_theme_mod('header_color', '#43C6E4'); ?>; }
      .bay-hero-header{}
      .bay-container{
        margin-top: <?php echo get_theme_mod('bay_theme_header_height', '#43C6E4'); ?>px;
      }
      .bay-hero-header {
        height: <?php echo get_theme_mod('bay_theme_header_height', '#43C6E4'); ?>px;
      }
      .bay-hero-header .bay-hero-col{
        height: <?php echo get_theme_mod('bay_theme_header_height', '#43C6E4'); ?>px;
      }
      .bay-hero-header::before{
        /*background-color: black;**/
        opacity: <?php echo get_theme_mod('bay_theme_header_opacity', '0'); ?>;
      }
      
    </style>
  <?php
}
add_action( 'wp_head', 'cd_customizer_css');
?>