<!DOCTYPE html>
<html <?php body_class(); ?>>
<head>    
    <!--
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    -->

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
</head>
<?php
    $background_img = get_theme_mod('bay_theme_customizer_backgroundimage','');
?>
<body <?php body_class(); ?> >
    <?php bay_hero_header(); ?>
    <div class="bay-drawer bay-drawer-close" data-drawer="">
        <div class="bay-drawer-shadow"></div>   
        <nav>
            <div class="bay-main-left">
                <div id="burger-close"><?php bay_get_burger(); ?></div>
                <?php bay_theme_custom_logo(); ?>
            </div>    
            <?php get_sidebar(); ?>
        </nav>
    </div>
    <header class="main">
        <nav class="navbar bay-main-navigation">
            <div class="bay-main-left">
                <div id="burger-open"><?php bay_get_burger(); ?></div>
                <?php bay_theme_custom_logo(); ?>
            </div>
            <div></div>
            <div>
                <form>
                    <input type="text" id="bayajaxsearch" class="form-control mr-sm-2" />                
                </form>
            </div>
        </nav>    
    </header>

