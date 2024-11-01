<?php
/**
 * Plugin Name:  Socialinize
 * Plugin URI: www.socialinize.com
 * Description: Facebook, Twitter Login with Socialinize. Allows users or visitors to a website to register or login with there Social network accounts. 
 * Version: 1.3.2
 * Author: James Costello
 * Author URI: www.socialinize.com
 * License:  GPL-2.0+
 * Text Domain:  socialinize
 * Domain Path:  /lang
 */

define('SOCIALINIZE_VERSION', '2.1');
define('SOCIALINIZE_DIR', plugin_dir_path(__FILE__));
define('SOCIALINIZE_URL', plugin_dir_url(__FILE__));

function socialinize_load(){
    if(is_admin()) //load admin files only in admin
        require_once(SOCIALINIZE_DIR.'includes/admin.php'); 
    if (!class_exists('WP_List_Table')) {
         require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
    }
}

socialinize_load();

register_activation_hook(__FILE__, 'socialinize_activation');
register_deactivation_hook(__FILE__, 'socialinize_deactivation');

function socialinize_activation() {    
    register_uninstall_hook(__FILE__, 'socialinize_uninstall');
}

function socialinize_deactivation() {
    
}
	    
function socialinize_uninstall(){
    
}


function socialinize_script_basic()
{
    wp_register_script( 'custom-script', plugins_url( '/js/custom-script.js', __FILE__ ) );
    wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'socialinize_script_basic' );

//shortcode for share buttons
add_shortcode("socialinizefollowbuttonfacebook", "socialinize_button_follow_me_facebook");
add_shortcode("socialinizefollowbuttontwitter", "socialinize_button_follow_me_twitter");
add_shortcode("socialinizefollowbuttongoogle", "socialinize_button_follow_me_google");
add_shortcode("socialinizefollowbuttonpinterest", "socialinize_button_follow_me_pinterest");

//shortcode for share buttons
add_shortcode("socialinizesharebuttonsen", "socialinize_button_share_users");

//shortcode for login buttons
add_shortcode("socialinizelogindribbblelgen", "socialinize_button_dribbble_handler_lg");
add_shortcode("socialinizelogindribbblesmen", "socialinize_button_dribbble_handler_sm");
add_shortcode("socialinizeloginfacebooklgen", "socialinize_button_facebook_handler_lg");
add_shortcode("socialinizeloginfacebooksmen", "socialinize_button_facebook_handler_sm");
add_shortcode("socialinizeloginlinkedlnlgen", "socialinize_button_linkedln_handler_lg");
add_shortcode("socialinizeloginlinkedlnsmen", "socialinize_button_linkedln_handler_sm");
add_shortcode("socialinizelogintumblrlgen",   "socialinize_button_tumblr_handler_lg");
add_shortcode("socialinizelogintumblrsmen",   "socialinize_button_tumblr_handler_sm");
add_shortcode("socialinizelogintwitterlgen",  "socialinize_button_twitter_handler_lg");
add_shortcode("socialinizelogintwittersmen",  "socialinize_button_twitter_handler_sm");

//sign out button
add_shortcode("socialinizesignoutbuttonen", "socialinize_button_logout_users");


function socialinize_button_follow_me_facebook()
{
  $options        = get_option('required_socialinize_follow_data');
  $Isshowfollowers = $options['fb_follow_count'];  
   if($Isshowfollowers==1){ $IsShow ='button_count';}else{$IsShow ='button';}
   
   echo " <div id='fb-root'></div><div class='fb-follow' data-href='https://www.facebook.com/".$options['fb_follow_username'] ."' data-layout='".$IsShow."' data-size='large' data-show-faces='false'></div>";
}
function socialinize_button_follow_me_twitter()
{
   $options        = get_option('required_socialinize_follow_data');
   $Isshowfollowers = $options['tw_follow_count'];
   if($Isshowfollowers==1){ $IsShow ='true';}else{$IsShow ='false';}
   
    echo "<a href='https://twitter.com/".$options['tw_follow_username'] ."' class='twitter-follow-button' data-show-count='".$IsShow."' data-size='large'>Follow ".$options['tw_follow_username'] ."</a>";
}
function socialinize_button_follow_me_google()
{
   $options        = get_option('required_socialinize_follow_data');
   $Isshowfollowers = $options['fb_follow_count'];
   if($Isshowfollowers==1){ $IsShow ='bubble';}else{$IsShow ='none';}
   
    echo "<script src='https://apis.google.com/js/platform.js' async defer></script>  <div class='g-follow' data-annotation='".$IsShow."' data-height='24' data-href='//plus.google.com/".$options['go_follow_username'] ."' data-rel='author'/></div>";
}
function socialinize_button_follow_me_pinterest()
{
  $options        = get_option('required_socialinize_follow_data');

  echo "<script async defer src='//assets.pinterest.com/js/pinit.js'></script><a data-pin-do='buttonFollow' href='https://www.pinterest.com/".$options['pin_follow_username'] ."/'>Pinterest</a>";
}

function socialinize_button_share_users() {
   $options          = get_option('required_socialinize_share_data');  
   $networks         = array("facebookshare","twittershare","googleplusshare","diggshare","linkedlnshare", "pinterestshare", "redditshare","stumbleuponshare","tumblrshare","vkshare","pocketshare","deliciousshare","emailshare","wordpressshare");
   $share_images     = array("facebook","twitter","google+","digg","linkedIn","pinterest","reddit","stumbleupon","tumblr","vk","pocket","delicious","email","wordpress");
   $images_selection = array("flat","black-simple","black-flat","white-flat","white-simple");
  
   $selection    = $options['image-selection']; 
   
   if($selection==null||$selection==""){
       $image_type = "flat";
   }else{
      $image_type =  $images_selection[$selection];
   }

   $arrlength      = count($networks);

   global $wp;
   $current_url   = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
   $title         = get_the_title();
    echo "<div id='socialinize_share' class='socialinize_share'>"; 
     for($i=0;$i<$arrlength;$i++){   
       if($options[$networks[$i]]==1){
      
          $imglocation = "assets/images/share/".$image_type."/".$share_images[$i]."-min.png";
          $imageUrl   =  plugins_url($imglocation,__FILE__);
 
         if($networks[$i]=='facebookshare'){ $shareUrl = "http://www.facebook.com/sharer.php?u=".$current_url;    echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>"; }
         if($networks[$i]=='twittershare') { $shareUrl = "https://twitter.com/share?url=".$current_url."&amp;text=".$title."&amp;hashtags=" ; echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>";} 
         if($networks[$i]=='googleplusshare') { $shareUrl = "https://plus.google.com/share?url=".$current_url;  echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>";}
         if($networks[$i]=='diggshare')      { $shareUrl = "http://www.digg.com/submit?url=".$current_url;      echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>";  }
         if($networks[$i]=='linkedlnshare')    { $shareUrl = "http://www.linkedin.com/shareArticle?mini=true&amp;url=".$current_url;     echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>";   }
         if($networks[$i]=='pinterestshare') { $shareUrl = "http://pinterest.com/pin/create/button/?url=".$current_url."&media=URLTOANIMAGE&description=".$title ; echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>"; }
         if($networks[$i]=='redditshare') { $shareUrl = "http://reddit.com/submit?url=".$current_url."&amp;title=".$title; echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>"; }
         if($networks[$i]=='stumbleuponshare') { $shareUrl = "http://www.stumbleupon.com/submit?url=".$current_url."&amp;title=".$title; echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>"; }
         if($networks[$i]=='tumblrshare') { $shareUrl = "http://www.tumblr.com/share/link?url=".$current_url."&amp;title=".$title; echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>"; }
         if($networks[$i]=='vkshare') { $shareUrl = "http://vkontakte.ru/share.php?url=".$current_url;  echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>";}
         if($networks[$i]=='deliciousshare') { $shareUrl = "https://delicious.com/save?v=5&noui&jump=close&url=".$current_url."&title=".$title; echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>"; }
         if($networks[$i]=='pocketshare') { $shareUrl = "https://getpocket.com/save?url=%u&title=%t"; echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>"; }
         if($networks[$i]=='wordpressshare') { $shareUrl = "http://wordpress.com/press-this.php?u=".$current_url."&title=".$title."&s=DESCRIPTION&i=URLOFANIMAGE";  echo "<a href='".$shareUrl."' target='_blank'><img src='".$imageUrl."'></a>"; }   
         if($networks[$i]=='emailshare'){
               echo "<a href='mailto:?Subject=".$title."&amp;Body=Check%20this%20out!<br>".$current_url."' ><img src='".$imageUrl."'></a>"; 
          }
       }       
   }
   echo "</div>";
}

function socialinize_button_dribbble_handler_lg() {
  $button_output = socialinize_button_function('lg','dribbble');
  return $button_output;
}
function socialinize_button_dribbble_handler_sm() {
  $button_output = socialinize_button_function('sm','dribbble');
  return $button_output;
}
function socialinize_button_facebook_handler_lg() {
  $button_output = socialinize_button_function('lg','facebook');
  return $button_output;
}
function socialinize_button_facebook_handler_sm() {
  $button_output = socialinize_button_function('sm','facebook');
  return $button_output;
}
function socialinize_button_linkedln_handler_lg() {
  $button_output = socialinize_button_function('lg','linkedln');
  return $button_output;
}
function socialinize_button_linkedln_handler_sm() {
  $button_output = socialinize_button_function('sm','linkedln');
  return $button_output;
}
function socialinize_button_tumblr_handler_lg() {
  $button_output = socialinize_button_function('lg','tumblr');
  return $button_output;
}
function socialinize_button_tumblr_handler_sm() {
  $button_output = socialinize_button_function('sm','tumblr');
  return $button_output;
}
function socialinize_button_twitter_handler_lg() {
  $button_output = socialinize_button_function('lg','twitter');
  return $button_output;
}
function socialinize_button_twitter_handler_sm() {
  $button_output = socialinize_button_function('sm','twitter');
  return $button_output;
}
function socialinize_button_function($size,$social) {
$url = home_url();
$removes = array("http://", "localhost/");
$urlcallback = str_replace($removes, "", esc_url( $url ));

 if(!is_user_logged_in() ){
      $apikey = "null"  ;
      $apisecretkey = "null" ; 
   $api        = get_option('required_socialinize_data');
    if($social=='facebook'){  
         $apikey = $api['fb_api_key']   ;
         $apisecretkey = $api['fb_secert_key'];  
    }elseif ($social=='linkedln'){  
         $apikey = $api['li_api_key']   ;
         $apisecretkey = $api['li_secert_key']; 
    }elseif ($social=='twitter'){  
         $apikey =    $api['tw_api_key']   ;
         $apisecretkey = $api['tw_secert_key']; 
    }elseif($social=='tumblr'){  
         $apikey = $api['tr_api_key']   ;
      $apisecretkey = $api['tr_secert_key']; 
    }elseif($social=='dribbbe'){  
      $apikey = $api['dr_api_key']   ;
      $apisecretkey = $api['dr_secert_key']; 
    } 
  
    if($size=='lg'){
         $imageUrl   =  plugins_url('/assets/images/login/'.$social.'-sign-In-Large-en.png',__FILE__);
    }else{
         $imageUrl   =  plugins_url('/assets/images/login/'.$social.'-sign-In-Small-en.png',__FILE__);
    }
    $connectUrl =  "http://socialinize.com/connect/socialogins/".$api['socialinize_api']."/".$social."/".$apikey."/".$apisecretkey."/".$api['socialinize_callback'];
  
    $socialinize_login_button =  "<div class='lk-login' style='padding:5px 0;'><a href='".$connectUrl."'><img src='".$imageUrl."'></a></div>"; 
  
    return $socialinize_login_button;
  }
}
function socialinize_button_logout_users() {
   if(is_user_logged_in()) {
       $imageUrl   =  plugins_url('/assets/images/login/button_sign-out_en.png',__FILE__);
        $logout_button =  "<div class='lk-login' style='padding:5px 0;'><a href='". wp_logout_url( home_url() ) ."'><img src='".$imageUrl."'></a></div>"; 
        return $logout_button;

   } 
}

add_action('parse_request', 'socialinize_custom_url_handler');

function socialinize_custom_url_handler() {        
    if( isset($_GET['data']) && strpos($_SERVER["REQUEST_URI"], 'socialinizeCallback') !== false) {   
        $userdata = unserialize(base64_decode($_GET['data']));
        socialinizeCallback($userdata);
    }
  //   exit();
}

//callback
function socialinizeCallback($data){

   $status = $data['status'];
   $code =  $data['code'];
   
   if($status!="success"){
     echo "<div class='error'><p>Error ".$code." ". __( 'has occurred during login process. If this continue please contact the website administrator', 'socialinize-text-errormsg' )."</p>".$reason."</div>";
   }else{
   
      $userdata = array( 
      'user_login'   =>  $data['user-username'],
      'user_url'     =>  $data['user-profile'],
      'user_pass'    =>  NULL,  
      'user_email'   =>  $data['user-email'],
      'display_name' =>  $data['user-username'],
      'nickname'     =>  $data['user-username'],
      'first_name'   =>  $data['user-firstName'],
      'last_name'    =>  $data['user-lastName']   
   );
   
       $email = $data['user-email'];
    
       if(empty($email)){
             $user = get_user_by('login',$data['user-username']);              
       }else { 
               $user = get_user_by('email',$email); 
       }
     
       $options = get_option('required_socialinize_data');
     
       if(!$user){ 
            $user = wp_insert_user( $userdata ) ;
            $user = get_user_by('login',$data['user-username']);   
             
            $users = get_user_by( 'id', $user->ID); 
			$users = get_user_by('login',$users->user_login);	
            update_user_meta( $user_id, 'twitter_profile_id',  $data['user-identifier'] );
			update_user_meta( $user_id, 'twitter_profile_img', $data['user-profile'] );
			update_user_meta( $user_id, 'gp_display_name', $data['user-username']  );
			update_user_meta( $user_id, 'first_name', $data['user-firstName']  );
			update_user_meta( $user_id, 'last_name', $data['user-lastName'] );
			update_user_meta( $user_id, 'country', $data['user-country'] );
			
			wp_set_current_user( $user_id, $users->user_login );
		    wp_update_user( array ('ID' => $user->ID, 'role' => $options['socialinize-select'])) ;  		 
		    wp_set_auth_cookie( $user->ID, $remember = false, $secure = '', $token = '' );
		   
        }else{
            $users = get_user_by( 'id', $user->ID); 
			$users = get_user_by('login',$users->user_login);		
            update_user_meta( $user_id, 'twitter_profile_id',  $data['user-identifier'] );
			update_user_meta( $user_id, 'twitter_profile_img', $data['user-profile'] );
			update_user_meta( $user_id, 'gp_display_name', $data['user-username']  );
			update_user_meta( $user_id, 'first_name', $data['user-firstName']  );
			update_user_meta( $user_id, 'last_name', $data['user-lastName'] );
			update_user_meta( $user_id, 'country', $data['user-country'] );
			
			wp_set_current_user( $user_id, $users->user_login );
			wp_set_auth_cookie( $user->ID, $remember = false, $secure = '', $token = '' );
	     
       }
	  wp_redirect(home_url());
	  exit();
    }
  //die();
}
?>