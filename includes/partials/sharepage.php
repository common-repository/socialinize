<?php 
function edit_share_functions(){
  if(!current_user_can('manage_options')){
        wp_die( __( 'You do not have sufficient permissions to access this page.', 'socialinize-text-errorpermissions' ) );
   }
?>
      <h2> 
       <?php   _e( ' Socialinize', 'socialinize-text-menuheading' ) ?>
     </h2>

         <div style="max-width:850px; border:0px solid grey">       
               <form method="post" action="options.php">
                   <?php settings_fields('socialinize_shares'); ?> 
                   <?php do_settings_sections('socialinize_share_section_page'); ?>
                   <?php submit_button();?>
               </form>
          </div>
  <?php    
  
}
function socialinize_fb_share_call()
{ 
 $options = get_option('required_socialinize_share_data');

?>
 <input type="checkbox"  name="required_socialinize_share_data[facebookshare]" value="1" <?php checked(1,  $options['facebookshare'] , true); ?> /> 
  <?php
}
function socialinize_tw_share_call()
{ 
  $options = get_option('required_socialinize_share_data');
 ?>
   <input type="checkbox"  name="required_socialinize_share_data[twittershare]"value="1" <?php checked(1, $options['twittershare'], true); ?> /> 
<?php
}
function socialinize_go_share_call()
{ 
 $options = get_option('required_socialinize_share_data');
?>
 <input type="checkbox"  name="required_socialinize_share_data[googleplusshare]" value="1"  <?php checked(1,  $options['googleplusshare'] , true); ?> /> 
  <?php
}
function socialinize_digg_share_call()
{ 
  $options = get_option('required_socialinize_share_data');
 ?>
   <input type="checkbox"  name="required_socialinize_share_data[diggshare]" value="1"  <?php checked(1, $options['diggshare'], true); ?> /> 
<?php
}
function socialinize_li_share_call()
{ 
 $options = get_option('required_socialinize_share_data');

?>
 <input type="checkbox"  name="required_socialinize_share_data[linkedlnshare]" value="1" <?php checked(1,  $options['linkedlnshare'] , true); ?> /> 
  <?php
}
function socialinize_pint_share_call()
{ 
  $options = get_option('required_socialinize_share_data');
 ?>
   <input type="checkbox"  name="required_socialinize_share_data[pinterestshare]" value="1" <?php checked(1, $options['pinterestshare'], true); ?> /> 
<?php
}
function socialinize_reddit_share_call()
{ 
 $options = get_option('required_socialinize_share_data');

?>
 <input type="checkbox"  name="required_socialinize_share_data[redditshare]" value="1" <?php checked(1,  $options['redditshare'] , true); ?> /> 
  <?php
}
function socialinize_stumble_share_call()
{ 
  $options = get_option('required_socialinize_share_data');
 ?>
   <input type="checkbox"  name="required_socialinize_share_data[stumbleuponshare]" value="1" <?php checked(1, $options['stumbleuponshare'], true); ?> /> 
<?php
}
function socialinize_tumblr_share_call()
{ 
 $options = get_option('required_socialinize_share_data');
?>
 <input type="checkbox"  name="required_socialinize_share_data[tumblrshare]" value="1"  <?php checked(1,  $options['tumblrshare'] , true); ?> /> 
  <?php
}
function socialinize_vk_share_call()
{ 
  $options = get_option('required_socialinize_share_data');
 ?>
   <input type="checkbox"  name="required_socialinize_share_data[vkshare]" value="1"  <?php checked(1, $options['vkshare'], true); ?> /> 
<?php
}
function socialinize_pocket_share_call()
{ 
  $options = get_option('required_socialinize_share_data');
 ?>
   <input type="checkbox"  name="required_socialinize_share_data[pocketshare]" value="1" <?php checked(1, $options['pocketshare'], true); ?> /> 
<?php
}
function socialinize_delicious_share_call()
{ 
  $options = get_option('required_socialinize_share_data');
  ?>
      <input type="checkbox"  name="required_socialinize_share_data[deliciousshare]" value="1" <?php checked(1, $options['deliciousshare'], true); ?> /> 
 <?php
}
function socialinize_email_share_call()
{ 
 $options = get_option('required_socialinize_share_data');
   ?>
     <input type="checkbox"  name="required_socialinize_share_data[emailshare]" value="1"  <?php checked(1,  $options['emailshare'] , true); ?> /> 
  <?php
}
function socialinize_wordpress_share_call()
{ 
  $options = get_option('required_socialinize_share_data');
   ?>
     <input type="checkbox"  name="required_socialinize_share_data[wordpressshare]" value="1"  <?php checked(1, $options['wordpressshare'], true); ?> /> 
  <?php
}
function socialinize_select_share_image_type_call()
{ 
        $options = get_option('required_socialinize_share_data'); 
  
         $share_images=array("twitter","digg","email","facebook","google+","reddit","linkedIn","pinterest","pocket","stumbleupon","tumblr","vk","wordpress");
        $arrlength      = count($share_images);
     ?>
      <div>
      <input type="radio" name="required_socialinize_share_data[image-selection]" value="1" <?php checked(0, $options['image-selection'], true); ?>  
      <div>
      <?php
         for($ii=0;$ii<$arrlength;$ii++){         
             $imglocation = "plugins/socialinize/assets/images/share/flat/".$share_images[$ii]."-min.png";
             $imageUrl   =  content_url($imglocation,__FILE__); 
             echo "<img src='".$imageUrl."' alt='".$share_images[$ii]."' height='32' width='32' style='padding:3px 3px 3px 0px'></a>";
          }
        ?> 
        </div>
        <br>
        <input type="radio" name="required_socialinize_share_data[image-selection]" value="2" <?php checked(1, $options['image-selection'], true); ?>
        <div>
        <?php
         for($ii=0;$ii<$arrlength;$ii++){        
            $imglocation = "plugins/socialinize/assets/images/share/black-simple/".$share_images[$ii]."-min.png";
            $imageUrl   =  content_url($imglocation,__FILE__);
            echo "<img src='".$imageUrl."' alt='".$share_images[$ii]."' height='32' width='32' style='padding:3px 3px 3px 0px'></a>";
         }
       ?> </div>
        <br>
        <input type="radio" name="required_socialinize_share_data[image-selection]" value="3" <?php checked(2, $options['image-selection'], true); ?>
        <div>
        <?php
            for($ii=0;$ii<$arrlength;$ii++){         
              $imglocation = "plugins/socialinize/assets/images/share/black-flat/".$share_images[$ii]."-min.png";
              $imageUrl   =  content_url($imglocation,__FILE__);
              echo "<img src='".$imageUrl."' alt='".$share_images[$ii]."' height='32' width='32' style='padding:3px 3px 3px 0px'></a>";
           }
     ?>  </div>
     <br>
    <input type="radio" name="required_socialinize_share_data[image-selection]" value="4" <?php checked(3, $options['image-selection'], true); ?>
        <div>
          <?php
             for($ii=0;$ii<$arrlength;$ii++){         
                $imglocation = "plugins/socialinize/assets/images/share/white-flat/".$share_images[$ii]."-min.png";
                $imageUrl   =  content_url($imglocation,__FILE__); 
                echo "<img src='".$imageUrl."' alt='".$share_images[$ii]."' height='32' width='32' style='padding:3px 3px 3px 0px'></a>";
             }
     ?></div>
     <br>
    <input type="radio" name="required_socialinize_share_data[image-selection]" value=5" <?php checked(4, $options['image-selection'], true); ?>
        <div>
         <?php
           for($ii=0;$ii<$arrlength;$ii++){          
             $imglocation = "plugins/socialinize/assets/images/share/white-simple/".$share_images[$ii]."-min.png";
             $imageUrl   =  content_url($imglocation,__FILE__); 
             echo "<img src='".$imageUrl."' alt='".$share_images[$ii]."' height='32' width='32' style='padding:3px 3px 3px 0px'></a>";
          }
     ?></div>
      </div>
     <br>
     <br>
     <?php
     echo "<p>  ". __( ' Shortcode ', 'socialinize-text-shortcodes' )."   <strong> [socialinizesharebuttonsen]</strong></p>"; 
}