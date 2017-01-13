<?php
/*
* Plugin Name: Adresy feedů pro České služby
* Plugin URI: https://webstudionovetrendy.eu/
* Description: Zobrazí na nástěnce widget s adresami aktivovaných feedů. Pro chod pluginu jsou nutné pluginy České služby a WooCommerce
* Version: 170113
* Author: Webstudio Nove Trendy
* Author URI: https://webstudionovetrendy.eu/
* GitHub Plugin URI: https://github.com/novetrendy/dashboard-ceske-sluzby
* License: GPL2
*** Changelog ***
2017.01.13 - version 170113
* Added settings button
/*
2017.01.12 - version 170112
* Added date and time of last update feed
/*
2016.12.21 - version 161221
* First version
*/

if ( ! defined( 'ABSPATH' ) )   {
    exit; // Exit if accessed directly
    }



/** Feedy dashboard widget */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active ( 'ceske-sluzby/ceske-sluzby.php' ) ){
/** Feedy dashboard widget */
function ceske_sluzby_feedy_dashboard_widget() {
        $url_heureka = site_url('?feed=heureka');
        $url_heureka1 = content_url('/heureka.xml');
        $url_zbozi = site_url('?feed=zbozi');
        $url_zbozi1 = site_url('/obsah/zbozi.xml');
        $url_pricemania = content_url('pricemania.xml');
        $url_google = site_url('?feed=google');
        $dirsd = get_stylesheet_directory_uri();
        $heureka_xml = WP_CONTENT_DIR.'/heureka.xml';
        $zbozi_xml = WP_CONTENT_DIR.'/zbozi.xml';
        $pricemania_xml = WP_CONTENT_DIR.'/pricemania.xml';
        //print_r(get_option( 'active_plugins'));
        ?>
        <div style="width:100%">
            <p style="font-size:18px;line-height:22px;font-weight:bold;margin-bottom:15px;">Nastavení</p>
            <form  method="post">
        <a href="admin.php?page=wc-settings&tab=ceske-sluzby"><input style="margin-bottom:5px;"  class="button-primary woocommerce-save-button" type="submit" name="nastaveni" value="Obecné"></a>
        <?php
        if (get_option( 'wc_ceske_sluzby_heureka_xml_feed-aktivace' ) == 'yes'){ ?>
        <a href="admin.php?page=wc-settings&tab=ceske-sluzby&section=xml-feed"><input style="margin-bottom:5px;"  class="button-primary woocommerce-save-button" type="submit" name="nastavenixml" value="XML"></a>
        <?php
        }
        if ( get_option( 'wc_ceske_sluzby_dalsi_nastaveni_dodaci_doba-aktivace' ) == "yes" ) { ?>
        <a href="admin.php?page=wc-settings&tab=ceske-sluzby&section=dodaci-doba"><input style="margin-bottom:5px;" class="button-primary woocommerce-save-button" type="submit" name="nastavenidd" value="Dodací doba"></a>
        <?php
        if (get_option( 'wc_ceske_sluzby_heureka_certifikat_spokojenosti-aktivace' ) == 'yes'){ ?>
        <a href="admin.php?page=wc-settings&tab=ceske-sluzby&section=certifikat-spokojenosti"><input style="margin-bottom:5px;"  class="button-primary woocommerce-save-button" type="submit" name="certifikat" value="Certifikát spokojenosti"></a>
        <?php
        }
        ?>
    </form>
            <?php
            }
        echo '<hr>';
            if (get_option( 'wc_ceske_sluzby_xml_feed_heureka-aktivace') == 'yes'){
            ?>
            <div style="width:45%;float:left;">
                <img src="<?php echo plugin_dir_url( __FILE__ ).'/images/Heureka.png'?>" />
            </div>
            <div style="width:55%;float:right;">
                <strong>Feed</strong> pro <strong>Heureka.cz</strong> najdete <a href="<?php echo $url_heureka ?>">zde.</a> <?php echo $url_heureka ?>
            </div>
            <div style="clear:both;"><strong>Průběžně generovaný feed pro Heureka.cz</strong> najdete <a href="<?php echo $url_heureka1 ?>">zde.</a> <?php echo $url_heureka1 ?> </div>
            <?php
            if (file_exists($heureka_xml)) {
            echo '<div style="clear:both;"><strong>Poslední aktualizace heureka.xml: </strong><span style="color:#D4131F">'.date ("d.m.Y H:i:s.", filemtime($heureka_xml)).'</span></div><hr>';
            }
        }
           if (get_option( 'wc_ceske_sluzby_xml_feed_zbozi-aktivace') == 'yes'){
        ?>
            <div style="width:45%;float:left;">
                <img src="<?php echo plugin_dir_url( __FILE__ ).'/images/Zbozi.png'?>" />
            </div>
            <div style="width:55%;float:right;">
                <strong>Feed</strong> pro <strong>Zbozi.cz</strong> najdete <a href="<?php echo $url_zbozi ?>">zde.</a> <?php echo $url_zbozi ?>
            </div>
            <div style="clear:both;"><strong>Průběžně generovaný feed pro Zbozi.cz</strong> najdete <a href="<?php echo $url_zbozi1 ?>">zde.</a><br /> <?php echo $url_zbozi1 ?> </div>
            <?php
            if (file_exists($zbozi_xml)) {
            echo '<div style="clear:both;"><strong>Poslední aktualizace zbozi.xml: </strong><span style="color:#D4131F">'.date ("d.m.Y H:i:s.", filemtime($zbozi_xml)).'</span></div><hr>';
            }
         }
        if (get_option( 'wc_ceske_sluzby_xml_feed_pricemania-aktivace') == 'yes'){
        ?>
            <div style="width:45%;float:left;">
                <img style="margin-top:5px;" src="<?php echo plugin_dir_url( __FILE__ ).'/images/Pricemania.png'?>" />
            </div>
            <div style="width:55%;float:right;">
                <strong>Feed</strong> pro <strong>Pricemania.cz</strong> najdete <a href="<?php echo $url_pricemania ?>">zde.</a></div>
            <div style="clear:both;"><?php echo $url_pricemania ?></div>
            <?php
            if (file_exists($pricemania_xml)) {
            echo '<div style="clear:both;"><strong>Poslední aktualizace pricemania.xml: </strong><span style="color:#D4131F">'.date ("d.m.Y H:i:s.", filemtime($pricemania_xml)).'</span></div><hr>';
            }
        }
        if (get_option( 'wc_ceske_sluzby_xml_feed_heureka-aktivace') == 'yes'){
        ?>
            <div style="width:45%;float:left;">
                <img style="margin-top:5px;" src="<?php echo plugin_dir_url( __FILE__ ).'/images/google-shopping.jpg'?>" />
            </div>
            <div style="width:55%;float:right;">
                <strong>Feed</strong> pro <strong>Google Merchant</strong> najdete <a href="<?php echo $url_google ?>">zde.</a></div>
            <div style="clear:both;"><?php echo $url_google ?></div>
        <hr>        
<?php }
            ?> </div> <?php

}

function pridat_ceske_sluzby_feedy_dashboard_widget() {
    wp_add_dashboard_widget('ceske_sluzby_feedy_dashboard_widget', 'České služby - adresy feedů', 'ceske_sluzby_feedy_dashboard_widget');
}

add_action('wp_dashboard_setup', 'pridat_ceske_sluzby_feedy_dashboard_widget');
}
else
// If České služby not active, deactivate plugin
 if ( is_admin() ) {
          add_action( 'admin_init', 'cs_plugin_deactivate' );
          add_action( 'admin_notices', 'cs_plugin_admin_notice' );
          function cs_plugin_deactivate() {
              deactivate_plugins( plugin_basename( __FILE__ ) );
          }
          function cs_plugin_admin_notice() {
               echo '<div class="error notice is-dismissible"><p>Pro plugin Adresy feedů pro České služby je nutný aktivovaný plugin České služby. Protože plugin České služby není aktivovaný plugin Adresy feedů pro České služby byl deaktivován. </p></div>';
               if ( isset( $_GET['activate'] ) )
                    unset( $_GET['activate'] );
          }
        }
}
else  {
 // If WooCommerce not active, deactivate plugin
 if ( is_admin() ) {
          add_action( 'admin_init', 'dashboard_plugin_deactivate' );
          add_action( 'admin_notices', 'dashboard_plugin_admin_notice' );
          function dashboard_plugin_deactivate() {
              deactivate_plugins( plugin_basename( __FILE__ ) );
          }
          function dashboard_plugin_admin_notice() {
               echo '<div class="error notice is-dismissible"><p>Pro plugin Adresy feedů pro České služby je nutný aktivovaný plugin WooCommerce. Protože plugin Woocommerce není instalovaný, nebo aktivovaný plugin Adresy feedů pro České služby byl deaktivován. </p></div>';
               if ( isset( $_GET['activate'] ) )
                    unset( $_GET['activate'] );
          }
        }
    }
