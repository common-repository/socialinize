<?php
function socialinize_api_field()
{
   $options = get_option('required_socialinize_data');
   echo "<input style='width:100%' id='socialinize_api' name='required_socialinize_data[socialinize_api]' type='text' value='" . $options['socialinize_api'] . "' />";
}
function socialinize_api_fb_fields()
{
   $options = get_option('required_socialinize_data');
   echo _e( 'Facebook API key', 'socialinize-fb-placeholder-1')."<input style='width:100%' id='fb_api_key' name='required_socialinize_data[fb_api_key]' type='text' value='" . $options['fb_api_key'] . "' />";
   echo _e( 'Facebook secret key', 'socialinize-fb-placeholder-2' )."<input style='width:100%' id='fb_secert_key' name='required_socialinize_data[fb_secert_key]' type='text' value='" . $options['fb_secert_key'] . "' />";

    echo "<hr>";
    echo _e( 'Facebook Client  key', 'socialinize-fb-placeholder-3' )."<input style='width:100%' id='fb_client_api_key' name='required_socialinize_data[fb_client_api_key]' type='text' value='" . $options['fb_client_api_key'] . "'/>";

    echo _e( 'Facebook client secret key', 'socialinize-fb-placeholder-4' )."<input style='width:100%' id='fb_secert_client_key' name='required_socialinize_data[fb_secert_client_key]' type='text' value='" . $options['fb_secert_client_key'] . "'   />";
}
function socialinize_api_tw_fields()
{
   $options = get_option('required_socialinize_data');
   echo _e( 'Twitter API key', 'socialinize-tw-placeholder-1')."<input style='width:100%' id='tw_api_key' name='required_socialinize_data[tw_api_key]' type='text' value='" . $options['tw_api_key'] . "' />";
   echo _e( 'Twitter secret key', 'socialinize-tw-placeholder-2' )."<input style='width:100%' id='tw_secert_key' name='required_socialinize_data[tw_secert_key]' type='text' value='" . $options['tw_secert_key'] . "' />";

    echo "<hr>";
    echo _e( 'Twitter Client  key', 'socialinize-tw-placeholder-3' )."<input style='width:100%' id='tw_client_api_key' name='required_socialinize_data[tw_client_api_key]' type='text' value='" . $options['tw_client_api_key'] . "'/>";

    echo _e( 'Twitter client secret key', 'socialinize-tw-placeholder-4' )."<input style='width:100%' id='tw_secert_client_key' name='required_socialinize_data[tw_secert_client_key]' type='text' value='" . $options['tw_secert_client_key'] . "'   />";
}
function socialinize_api_li_fields()
{
   $options = get_option('required_socialinize_data');
   echo _e( 'Linkedln API key', 'socialinize-li-placeholder-1')."<input style='width:100%' id='li_api_key' name='required_socialinize_data[li_api_key]' type='text' value='" . $options['li_api_key'] . "' />";
   echo _e( 'Linkedln secret key', 'socialinize-li-placeholder-2' )."<input style='width:100%' id='li_secert_key' name='required_socialinize_data[li_secert_key]' type='text' value='" . $options['li_secert_key'] . "' />";
}

function socialinize_api_dr_fields()
{
   $options = get_option('required_socialinize_data');
   echo _e( 'Dribble API key', 'socialinize-dr-placeholder-1')."<input style='width:100%' id='dr_api_key' name='required_socialinize_data[dr_api_key]' type='text' value='" . $options['dr_api_key'] . "' />";
   echo _e( 'Dribble secret key', 'socialinize-dr-placeholder-2' )."<input style='width:100%' id='dr_secert_key' name='required_socialinize_data[dr_secert_key]' type='text' value='" . $options['dr_secert_key'] . "' />";
}
function socialinize_api_tr_fields()
{
   $options = get_option('required_socialinize_data');
   echo _e( 'Tumblr API key', 'socialinize-tr-placeholder-1')."<input style='width:100%' id='tr_api_key' name='required_socialinize_data[tr_api_key]' type='text' value='" . $options['tr_api_key'] . "' />";
   echo _e( 'Tumblr secret key', 'socialinize-tr-placeholder-2' )."<input style='width:100%' id='tr_secert_key' name='required_socialinize_data[tr_secert_key]' type='text' value='" . $options['tr_secert_key'] . "' />";
}
function socialinize_api_callbackurl_fields()
{
   $options = get_option('required_socialinize_data');
   echo _e( 'Callback (The website URL you wish the user to return to. e.g example.com)', 'socialinize-url-placeholder-1')."<input style='width:100%' id='socialinize_callback' name='required_socialinize_data[socialinize_callback]' type='text' value='" . $options['socialinize_callback'] . "' />";
}
function socialinize_section_links()
{
   echo "<p>". _e( 'Please follow documentation on', 'socialinize-text-doclink' )." <a href='http://www.socialinize.com'  target='_blank'>". _e( 'socialinize.com', 'socialinize-text-actuallylink' )."</a> </p>";
   echo "<p>". _e( 'To get the socialinize API, you are required to register. You can register at ', 'socialinize-text-docregister' )."<a href='http://www.socialinize.com'  target='_blank'>". _e( 'socialinize.com', 'socialinize-text-actuallylink' )."</a> </p>";  
}
function socialinize_roles_select_display()
{
   $options = get_option('required_socialinize_data'); 
   ?>
   <select id='socialinize-select' name='required_socialinize_data[socialinize-select]'>
     <?php wp_dropdown_roles($options['socialinize-select'] ); ?>
   </select>
   <?php
}
function socialinize_section_reg()
{   
    $imglocation = "plugins/socialinize/assets/images/login/button_sign-out_en.png'";
    $imageUrl   =  content_url($imglocation,__FILE__);
    echo "<p><img src='".$imageUrl."' alt='Sign out button Samll'  style='padding:3px 3px 3px 0px'> <b>[socialinizesignoutbuttonen]</b> </p>";
   
    $imglocation = "plugins/socialinize/assets/images/login/twitter-sign-In-Small-en.png'";
    $imageUrl   =  content_url($imglocation,__FILE__);
    echo "<p><img src='".$imageUrl."' alt='Twitter Login button Samll'  style='padding:3px 3px 3px 0px'> <b>[socialinizelogintwittersmen]</b> </p>";
   
    $imglocation = "plugins/socialinize/assets/images/login/twitter-sign-In-Large-en.png'";
    $imageUrl   =  content_url($imglocation,__FILE__);
    echo "<p><img src='".$imageUrl."' alt='Twitter Login button Large'  style='padding:3px 3px 3px 0px'> <b>[socialinizelogintwitterlgen]</b></p>";
   
    $imglocation = "plugins/socialinize/assets/images/login/dribbble-sign-In-Small-en.png'";
    $imageUrl   =  content_url($imglocation,__FILE__);
    echo "<p><img src='".$imageUrl."' alt='Dribbble Login button Samll'  style='padding:3px 3px 3px 0px'> <b>[socialinizelogindribbblesmen]</b> </p>";
   
    $imglocation = "plugins/socialinize/assets/images/login/dribbble-sign-In-Large-en.png'";
    $imageUrl   =  content_url($imglocation,__FILE__);
    echo "<p><img src='".$imageUrl."' alt='Dribbble Login button Large'  style='padding:3px 3px 3px 0px'> <b>[socialinizelogindribbblelgen]</b></p>";
   
       $imglocation = "plugins/socialinize/assets/images/login/facebook-sign-In-Small-en.png'";
    $imageUrl   =  content_url($imglocation,__FILE__);
    echo "<p><img src='".$imageUrl."' alt='Facebook Login button Samll'  style='padding:3px 3px 3px 0px'> <b>[socialinizeloginfacebooksmen]</b> </p>";
   
    $imglocation = "plugins/socialinize/assets/images/login/facebook-sign-In-Large-en.png'";
    $imageUrl   =  content_url($imglocation,__FILE__);
    echo "<p><img src='".$imageUrl."' alt='Facebook Login button Large'  style='padding:3px 3px 3px 0px'> <b>[socialinizeloginfacebooklgen]</b></p>";
   
    $imglocation = "plugins/socialinize/assets/images/login/Linkedln-sign-In-Small-en.png'";
    $imageUrl   =  content_url($imglocation,__FILE__);
    echo "<p><img src='".$imageUrl."' alt='Linkedln Login button Samll'  style='padding:3px 3px 3px 0px'> <b>[socialinizeloginlinkedlnsmen]</b> </p>";
   
    $imglocation = "plugins/socialinize/assets/images/login/Linkedln-sign-In-Large-en.png'";
    $imageUrl   =  content_url($imglocation,__FILE__);
    echo "<p><img src='".$imageUrl."' alt='Linkedln Login button Large'  style='padding:3px 3px 3px 0px'> <b>[socialinizeloginlinkedlnlgen]</b></p>";
    
           $imglocation = "plugins/socialinize/assets/images/login/tumblr-sign-In-Small-en.png'";
    $imageUrl   =  content_url($imglocation,__FILE__);
    echo "<p><img src='".$imageUrl."' alt='Tumblr Login button Samll'  style='padding:3px 3px 3px 0px'> <b>[socialinizeloginfacebooksmen]</b> </p>";
   
    $imglocation = "plugins/socialinize/assets/images/login/tumblr-sign-In-Large-en.png'";
    $imageUrl   =  content_url($imglocation,__FILE__);
    echo "<p><img src='".$imageUrl."' alt='Tumblr Login button Large'  style='padding:3px 3px 3px 0px'> <b>[socialinizeloginfacebooklgen]</b></p>";
}