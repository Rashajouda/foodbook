<!DOCTYPE html>
<html <?php language_attributes();?> >

<head>

    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' );?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head();?>
</head>

<body <?php body_class();?>>
    <?php
        // Foodbook Preloader
        do_action( 'foodbook_preloader' );

        if( !is_404() && !is_page_template( 'coming-soon.php' ) ){
            do_action( 'foodbook_header' );
        }