<?php

global $custom_table_example_db_version;
$custom_table_example_db_version = '1.1';

function socialinize_action_init() {
        load_plugin_textdomain('socialinize', false, basename(dirname(__FILE__)) . '/lang');
 }
add_action('init', 'socialinize_action_init');

function socialinize_db_auto_init()
{
    global $wpdb;
    global $custom_table_example_db_version;

    $table_name = $wpdb->prefix . 'socialinize_auto_post'; // do not forget about tables prefix

    $sql = "CREATE TABLE " . $table_name . " (
      id int(11) NOT NULL AUTO_INCREMENT,
      name tinytext NOT NULL,
       message VARCHAR(100) NOT NULL,
      link VARCHAR(1000) NULL,
      date VARCHAR(100) NULL,
      time  VARCHAR(11) NULL,
      PRIMARY KEY  (id)
    );";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    add_option('custom_table_example_db_version', $custom_table_example_db_version);
}

add_action('init', 'socialinize_db_auto_init');
 
function add_socialinize_admin_menu()
{
   	add_menu_page( 'socialinize', __(' Socialinize Settings', 'socialinize-text-menuheading' ) ,  'manage_options', 'Socialinize','socialinize_display_setting','', '7' );
   	add_submenu_page('Socialinize', __( ' Manage Shares', 'socialinize-text-subheading1' ), 'Socialinize Shares','manage_options', 'edit_share_slug', 'edit_share_functions');
    add_submenu_page('Socialinize', __( ' Manage Followers', 'socialinize-text-subheading2' ), 'Socialinize Follow','manage_options', 'edit_follow_slug', 'edit_follow_functions');  
    //add_submenu_page('Socialinize', __( ' Autopost', 'socialinize-text-subheadingauto' ), 'Socialinize Autopost list','manage_options', 'edit_autotable_slug', 'add_autopost_table_function');  
   // add_submenu_page('Socialinize', __( ' add new auto ', 'socialinize-text-subheadingautopost' ), 'Socialinize Add autopost','manage_options', 'add_autopost_slug', 'add_autopost_functions');  	
}
add_action( 'admin_menu', 'add_socialinize_admin_menu' );

function socialinize_init_register_setting()
{
   add_settings_section('socialinize_setting', __( ' Socialinize Settings', 'socialinize-text-menusection1' ), null, 'socialinizesettingspage'  );
   add_settings_field('socialinize_api', __( ' Socialinize API', 'socialinize-text-menufield1' ),  'socialinize_api_field',  'socialinizesettingspage',   'socialinize_setting'  ); 
   add_settings_field('socialinize_callback_url', __( 'Callback URL', 'socialinize-text-menufield10' ),  'socialinize_api_callbackurl_fields',  'socialinizesettingspage',   'socialinize_setting'  ); 
   add_settings_field('socialinize_facebook_api', __( 'Facebook keys', 'socialinize-text-menufield11' ),  'socialinize_api_fb_fields',  'socialinizesettingspage',   'socialinize_setting'  ); 
   add_settings_field('socialinize_twitter_api', __( 'Twitter keys', 'socialinize-text-menufield12' ),  'socialinize_api_tw_fields',  'socialinizesettingspage',   'socialinize_setting'  ); 
    add_settings_field('socialinize_linkedln_api', __( 'Linkedln keys', 'socialinize-text-menufield13' ),  'socialinize_api_li_fields',  'socialinizesettingspage',   'socialinize_setting'  ); 
    add_settings_field('socialinize_dribble_api', __( 'Dribble keys', 'socialinize-text-menufield14' ),  'socialinize_api_dr_fields',  'socialinizesettingspage',   'socialinize_setting'  ); 
      add_settings_field('socialinize_tumblr_api', __( 'Tumblr keys', 'socialinize-text-menufield15' ),  'socialinize_api_tr_fields',  'socialinizesettingspage',   'socialinize_setting'  ); 
   add_settings_field("socialinize-select", __( ' Select User Roles ', 'socialinize-text-menufield2' ) , "socialinize_roles_select_display", 'socialinizesettingspage', "socialinize_setting");
   add_settings_field('socialinize_register_doc', __( ' Information', 'socialinize-text-menufield3' ) ,  'socialinize_section_links',   'socialinizesettingspage' , "socialinize_setting");
 
   register_setting( 'socialinize_plugin_options', 'required_socialinize_data');  

   add_settings_field('socialinize_register_docs', __( ' Shortcut codes', 'socialinize-text-menufield4' ) ,  'socialinize_section_reg',   'socialinizesettingspage' , "socialinize_setting");

   add_settings_section('socialinize_shares', __( ' Socialinize Shares', 'socialinize-text-menusection2' ), null, 'socialinize_share_section_page');
   add_settings_field('facebookshare', __( ' Facebook ', 'socialinize-text-menufieldshare1' )  ,'socialinize_fb_share_call', 'socialinize_share_section_page', "socialinize_shares"  );
   add_settings_field('twittershare',  __( ' Twitter ', 'socialinize-text-menufieldshare2' )   ,'socialinize_tw_share_call', 'socialinize_share_section_page', "socialinize_shares"  );
   add_settings_field('googleplusshare', __( ' Google + ', 'socialinize-text-menufieldshare3' ),'socialinize_go_share_call', 'socialinize_share_section_page', "socialinize_shares"  );
   add_settings_field('diggshare', __( ' Digg ', 'socialinize-text-menufieldshare4' ) ,'socialinize_digg_share_call', 'socialinize_share_section_page', "socialinize_shares"  );
   add_settings_field('linkedlnshare', __( ' Linkedln ', 'socialinize-text-menufieldshare5' ) ,'socialinize_li_share_call', 'socialinize_share_section_page', "socialinize_shares"  );
   add_settings_field('pinterestshare', __( ' Pinterest ', 'socialinize-text-menufieldshare6' ) ,'socialinize_pint_share_call', 'socialinize_share_section_page', "socialinize_shares"  );
   add_settings_field('redditshare', __( ' Reddit ', 'socialinize-text-menufieldshare7' ) ,'socialinize_reddit_share_call', 'socialinize_share_section_page', "socialinize_shares"  );
   add_settings_field('stumbleuponshare', __( ' StumbleUpon ', 'socialinize-text-menufieldshare8' ) ,'socialinize_stumble_share_call', 'socialinize_share_section_page', "socialinize_shares"  );
   add_settings_field('tumblrshare', __( ' Tumblr ', 'socialinize-text-menufieldshare9' )  ,'socialinize_tumblr_share_call', 'socialinize_share_section_page', "socialinize_shares"  );
   add_settings_field('vkshare', __( ' VK ', 'socialinize-text-menufieldshare10' ) ,'socialinize_vk_share_call', 'socialinize_share_section_page', "socialinize_shares"  );
   add_settings_field('pocketshare', __( ' Pocket ', 'socialinize-text-menufieldshare11' ) ,'socialinize_pocket_share_call', 'socialinize_share_section_page', "socialinize_shares"  );
 
   add_settings_field('emailshare', __( ' Email ', 'socialinize-text-menufieldshare12' ) ,'socialinize_email_share_call', 'socialinize_share_section_page', "socialinize_shares"  );
   add_settings_field('wordpressshare', __( ' Wordpress ', 'socialinize-text-menufieldshare13' )  ,'socialinize_wordpress_share_call', 'socialinize_share_section_page', "socialinize_shares"  );    
   add_settings_field("image-selection", __( ' Select images ', 'socialinize-text-menufieldshare14' ) , "socialinize_select_share_image_type_call", "socialinize_share_section_page", "socialinize_shares");  
   register_setting( 'socialinize_shares', 'required_socialinize_share_data');
   
    add_settings_section("socialinize_follower_section", "", null, "socialinize_follow_section_page");
    add_settings_field("fb_follow", __( ' Facebook Profile Name ', 'socialinize-text-menufieldfollower1' ) , "socialinize_facebook_follow_call", "socialinize_follow_section_page", "socialinize_follower_section"); 
    add_settings_field("fb_follow_count", __( 'Facebook Show number of Followers', 'socialinize-text-menufieldfollowercount1' ) , "socialinize_facebook_count_call", "socialinize_follow_section_page", "socialinize_follower_section"); 
    add_settings_field("tw_follow", __( ' Twitter Profile Name ', 'socialinize-text-menufieldfollower2' ) , "socialinize_twitter_follow_call", "socialinize_follow_section_page", "socialinize_follower_section"); 
    add_settings_field("tw_follow_count", __( 'Twitter Show number of Followers ', 'socialinize-text-menufieldfollowercount2' ) , "socialinize_twitter_count_call", "socialinize_follow_section_page", "socialinize_follower_section");
    add_settings_field("go_follow", __( ' Google Plus Profile Name ', 'socialinize-text-menufieldfollower3' ) , "socialinize_google_follow_call", "socialinize_follow_section_page", "socialinize_follower_section");
    add_settings_field("go_follow_count", __( ' Google Show number of Followers ', 'socialinize-text-menufieldfollowercount3' ) , "socialinize_google_count_call", "socialinize_follow_section_page", "socialinize_follower_section"); 
    add_settings_field("pin_follow", __( ' Pinterest Profile Name ', 'socialinize-text-menufieldfollower4' ) , "socialinize_pinterest_follow_call", "socialinize_follow_section_page", "socialinize_follower_section");  
    add_settings_field("followercods", "Shortcut codes ", "socialinize_follow_info_section", "socialinize_follow_section_page", "socialinize_follower_section");  

    register_setting("socialinize_follower_section", "required_socialinize_follow_data");
 }
 
function socialinize_display_setting()
{
   ?>
   <div class="wrap">
      <h2> 
       <?php   __( ' Socialinize Settings', 'socialinize-text-menuheading' ) ?>
     </h2>
      <form method="post" action="options.php">
         <?php settings_fields('socialinize_plugin_options'); ?> 
         <?php do_settings_sections('socialinizesettingspage'); ?>
         <?php submit_button();?>

      </form>
   </div>
   <?php
}

add_action('admin_init', 'socialinize_init_register_setting');

require_once(SOCIALINIZE_DIR.'includes/partials/settingspage.php'); 
require_once(SOCIALINIZE_DIR.'includes/partials/followerspage.php'); 
require_once(SOCIALINIZE_DIR.'includes/partials/sharepage.php'); 
require_once(SOCIALINIZE_DIR.'includes/partials/autotablepage.php'); 
require_once(SOCIALINIZE_DIR.'includes/partials/autoform.php'); 