<?php
function edit_follow_functions(){
  if(!current_user_can('manage_options')){
     wp_die( __( 'You do not have sufficient permissions to access this page.', 'socialinize-text-errorpermissions' ) );
  }
?>
   <div style="width:750px;">
      <h2> 
       <?php   _e( ' Socialinize Follow', 'socialinize-text-menuheading' ) ?>
     </h2>
      
        <form method="post" action="options.php">
            <?php
               settings_fields("socialinize_follower_section");  
               do_settings_sections("socialinize_follow_section_page");                 
               submit_button(); 
            ?>
         </form>
<?php
}
function socialinize_facebook_follow_call()
{     
   $options = get_option('required_socialinize_follow_data');
   echo "<input style='width:100%' id='socialinize_api' name='required_socialinize_follow_data[fb_follow_username]' type='text' value='" . $options['fb_follow_username'] . "' />";
}
function socialinize_facebook_count_call()
{
  $options = get_option('required_socialinize_follow_data');
   ?>
     <input type="checkbox"  name="required_socialinize_follow_data[fb_follow_count]" value="1" <?php checked(1, $options['fb_follow_count'], true); ?> /> 
   <?php
}
function socialinize_twitter_follow_call()
{     
   $options = get_option('required_socialinize_follow_data');
   echo "<input style='width:100%' id='socialinize_api' name='required_socialinize_follow_data[tw_follow_username]' type='text' value='" . $options['tw_follow_username'] . "' />";
}
function socialinize_twitter_count_call()
{
  $options = get_option('required_socialinize_follow_data');
   ?>
     <input type="checkbox"  name="required_socialinize_follow_data[tw_follow_count]" value="1" <?php checked(1, $options['tw_follow_count'], true); ?> /> 
   <?php
}
function socialinize_google_follow_call()
{     
   $options = get_option('required_socialinize_follow_data');
   echo "<input style='width:100%' id='socialinize_api' name='required_socialinize_follow_data[go_follow_username]' type='text' value='" . $options['go_follow_username'] . "' />";
}
function socialinize_google_count_call()
{
  $options = get_option('required_socialinize_follow_data');
   ?>
     <input type="checkbox"  name="required_socialinize_follow_data[go_follow_count]" value="1" <?php checked(1, $options['go_follow_count'], true); ?> /> 
   <?php
}
function socialinize_pinterest_follow_call()
{     
   $options = get_option('required_socialinize_follow_data');
   echo "<input style='width:100%' id='socialinize_api' name='required_socialinize_follow_data[pin_follow_username]' type='text' value='" . $options['pin_follow_username'] . "' />";
}
function socialinize_pinterest_count_call()
{
  $options = get_option('required_socialinize_follow_data');
   ?>
  <input type="checkbox"  name="required_socialinize_follow_data[pin_follow_count]" value="1" <?php checked(1, $options['pin_follow_count'], true); ?> />  
   <?php
}
function socialinize_follow_info_section()
{
  echo " <p> ". __( 'Facebook  Shortcode', 'socialinize-text-fbshortcode' )." <strong>[socialinizefollowbuttonfacebook]</strong></p> ";
  echo " <p> ". __( 'Twitter  Shortcode', 'socialinize-text-twshortcode' ). " <strong>[socialinizefollowbuttontwitter]</strong></p> ";
  echo " <p> ". __( 'Google  Shortcode', 'socialinize-text-goshortcode' ).  " <strong>[socialinizefollowbuttongoogle]</strong></p> ";
  echo " <p> ". __( 'Pinterest  Shortcode ', 'socialinize-text-pinshortcode' )." <strong>[socialinizefollowbuttonpinterest]</strong></p> ";
}