<?php
    /**
    * @Packge      : foodbook
    * @Version    : 1.0
    * @Author      : ThemeLooks
    * @Author URI : https://www.themelooks.com/
    *
    */
    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit( );
    }
?>

<div class="col-sm-12">
    <h1 class="nof-title mb-3">
        <?php
            esc_html_e( 'Nothing Found', 'foodbook' );
        ?>
    </h1>

    <?php
        if ( is_home() && current_user_can( 'publish_posts' ) ) :
    ?>

        <p class="nof-desc">
            <?php
                echo sprintf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'foodbook' ), esc_url( admin_url( 'post-new.php' ) ) );
            ?>
        </p>

    <?php elseif ( is_search() ) : ?>

        <p class="nof-desc">
            <?php
                esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'foodbook' );
            ?>
        </p>
        <div class="row content-none-search">
            <div class="col-sm-12">
                <?php
                    get_search_form();
                ?>
            </div>
        </div>

    <?php else : ?>

        <p  class="nof-desc">
            <?php
                wp_kses_post( _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'foodbook' ) );
            ?>
        </p>
        <?php
            get_search_form();
        ?>

    <?php endif; ?>
</div>