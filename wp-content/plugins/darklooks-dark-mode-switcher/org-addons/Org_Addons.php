<?php
namespace Darklooks\Orgaddons;
/**
 *
 * @package     Darklooks
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

class Org_Addons {

	private static $apiUrl = 'https://api.wordpress.org/plugins/info/1.2/?action=query_plugins&request[author]={themelooks}';

    private static function sendRequest() {
        $response = wp_remote_get( esc_url_raw( self::$apiUrl ) );
        //
        if( ! is_wp_error( $response ) ) {
            return json_decode( wp_remote_retrieve_body( $response ), true );
        }
    }

    public static function getItems() {
        return self::sendRequest();
    }


    private static function template_html() {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
        ?>
        <style>
            .tl-org-items-wrp {
                display: flex;
                max-width: 100%;
                flex-wrap: wrap;
                gap: 15px;
            }
            .tl-org-items-wrp .tl-org-item {
                max-width: 413px;
                background-color: #fff;
                border: 1px solid #dcdcde;
                box-sizing: border-box;
                padding: 12px;
            }
            .tl-org-items-wrp .tl-org-item .tl-org-item-inner-group {
                display: flex;
            }
            .tl-org-item-info {
                min-width: 200px;
                margin-right: 10px;
            }
            .tl-org-items-wrp .tl-org-item .tl-org-item-icon img {
                max-width: 80px;
                margin-right: 10px;
            }
            .tl-org-items-wrp .tl-org-item .plugin-action-buttons .information  {
                font-size: 13px;
            }
        </style>
        <div class="tl-org-items-wrp">
            <?php 
            $installedPlugins = self::installedPlugins();
            $activatedPlugins = get_option('active_plugins');

            $items = self::getItems();
            if( !empty( $items['plugins'] ) ):
                foreach( $items['plugins'] as $item ):

                $itemName = !empty( $item['name'] ) ? $item['name'] : '';
                $pluginSlug = !empty( $item['slug'] ) ? $item['slug'] : '';
                $sanitizePluginName = sanitize_title( $itemName );
            ?>
            <div class="tl-org-item">
                
                <div class="tl-org-item-inner-group">
                    <div class="tl-org-item-icon">
                       <?php 
                        // slug
                        if( !empty( $item['icons']['1x'] ) ) {
                            echo '<img src="'.esc_url( $item['icons']['1x'] ).'" />';
                        }
                       ?>
                    </div>
                    <div class="tl-org-item-info">
                        <?php
                        if( !empty( $itemName ) ) {
                            echo '<h4>'.esc_html( $itemName ).'</h4>';
                        }
                        //
                        if( !empty( $item['short_description'] ) ) {
                            echo '<p>'.esc_html( $item['short_description'] ).'</p>';
                        }
                        ?>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <li>
                            <?php
                                //
                                $nameBased = array_search( $sanitizePluginName, $installedPlugins );
                                if( !empty( $nameBased ) ) {
                                    $actuvePluginKey = $nameBased;
                                } else {
                                    $actuvePluginKey = array_search( $pluginSlug, $installedPlugins );
                                }


                                if(  !in_array( $actuvePluginKey, $activatedPlugins ) && ( in_array( $pluginSlug, $installedPlugins ) || in_array( $sanitizePluginName, $installedPlugins ) ) ) {
                                    
                                    $install_url = wp_nonce_url( add_query_arg( array( 'action' => 'activate', 'plugin' => urlencode( $actuvePluginKey ) ), admin_url( 'plugins.php' ) ), 'activate-plugin_'.$actuvePluginKey );

                                    echo '<a class="button activate-now" data-slug="'.esc_attr( $pluginSlug ).'" href="'.esc_url( $install_url ).'" aria-label="'.esc_attr( $itemName ).'" data-name="'.esc_attr( $itemName ).'">'.esc_html__( 'Activate', 'darklooks' ).'</a>';


                                } else if( in_array( $actuvePluginKey , $activatedPlugins ) ) {

                                echo '<button type="button" class="button button-disabled" disabled="disabled">'.esc_html__( 'Active', 'darklooks' ).'</button>';

                                } else {
                                    $install_url  = wp_nonce_url( add_query_arg( array( 'action' => 'install-plugin', 'plugin' => $pluginSlug ), admin_url( 'update.php' ) ), 'install-plugin_'.$pluginSlug );

                                    echo '<a class="install-now button" data-slug="'.esc_attr( $pluginSlug ).'" href="'.esc_url( $install_url ).'" aria-label="Install '.esc_html( $itemName ).' now" data-name="'.esc_html( $itemName ).'">'.esc_html__( 'Install Now', 'darklooks' ).'</a>';
                                }
                            ?>
                            </li>
                            <li>

                                <?php 
                                $url = admin_url( 'plugin-install.php' ).'?tab=plugin-information&plugin='.esc_attr( $pluginSlug ).'&TB_iframe=true&width=772&height=550';
                                ?>
                                <a href="<?php echo esc_url( $url ); ?>" class="thickbox open-plugin-details-modal information" aria-label="<?php echo esc_attr( $itemName ); ?>" data-title="<?php echo esc_attr( $itemName ); ?>"><?php esc_html_e( 'More Details', 'darklooks' ) ?></a>
                            </li>
                        </ul>            
                    </div>
                </div>
                <div class="tl-org-item-meta"></div>
            </div>
            <?php 
                endforeach;
            endif;
            ?>
        </div>
        <?php
    }

    public static function getOrgItems() {
        self::template_html();
    }

    private static function installedPlugins() {
        $getPlugins = get_plugins();
        $nameList = array_column( $getPlugins, 'Name' );

        $keyList = array_keys( $getPlugins );
        
        $newNameList = [];

        foreach( $nameList as $name ) {
            $newNameList[] = sanitize_title( $name );
        }

        return array_combine( $keyList, $newNameList );
    }


}
