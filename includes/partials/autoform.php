<?php

function add_autopost_functions()
{

 global $wpdb;
    $table_name = $wpdb->prefix . 'socialinize_auto_post'; // do not forget about tables prefix

    $message = '';
    $notice = '';

    // this is default $item which will be used for new records
    $default = array(
        'id' => 0,
        'name' => '',
        'message' => '',
        'link' => '',
        'date' => '',
        'time' => ''
    );

    // here we are verifying does this request is post back and have correct nonce
    if (wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__))) {
        // combine our default item with request params
        $item = shortcode_atts($default, $_REQUEST);
        // validate data, and if all ok save item to database
        // if id is zero insert otherwise update
        $item_valid = custom_table_example_validate_post($item);
        if ($item_valid === true) {
            if ($item['id'] == 0) {
                $result = $wpdb->insert($table_name, $item);
                $item['id'] = $wpdb->insert_id;
                if ($result) {
                    $message = __('Item was successfully saved', 'custom_table_example');
            
             $date = new DateTime($item['date'] ."". $item['time']);
               
                wp_schedule_single_event(  $date->getTimestamp(), 'socialinize_autopost', array($item['id']) );

                    //set the cronjob to function call
                } else {
                    $notice = __('There was an error while saving item', 'socialinize-text-menuheading');

                    

                }
            } else {
                $result = $wpdb->update($table_name, $item, array('id' => $item['id']));
                if ($result) {
                    $message = __('Item was successfully updated', 'socialinize-text-menuheading');
                           //update the cronjob to function call
                        wp_clear_scheduled_hook( 'socialinize_autopost', array($item['id']) );
                        $date = new DateTime($item['date'] ."". $item['time']);
                        wp_schedule_single_event(  $date->getTimestamp(), 'socialinize_autopost', array($item['id']) );
                } else {
                    $notice = __('There was an error while updating item', 'socialinize-text-menuheading');
                }
            }
        } else {
            // if $item_valid not true it contains error message(s)
            $notice = $item_valid;
        }
    }
    else {
        // if this is not post back we load item to edit or give new one to create
        $item = $default;
        if (isset($_REQUEST['id'])) {
            $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $_REQUEST['id']), ARRAY_A);
            if (!$item) {
                $item = $default;
                $notice = __('Item not found', 'socialinize-text-menuheading');
            }
        }
    }

    // here we adding our custom meta box
    add_meta_box('autopost_form_meta_box', 'Auto Post Data', 'custom_table_form_meta_box_handler', 'autopost', 'normal', 'default');

    ?>
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('AutoPost', 'custom_table_example')?> <a class="add-new-h2"
                                href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=edit_autotable_slug');?>"><?php _e('back to list', 'socialinize-text-menuheading')?></a>
    </h2>

    <?php if (!empty($notice)): ?>
    <div id="notice" class="error"><p><?php echo $notice ?></p></div>
    <?php endif;?>
    <?php if (!empty($message)): ?>
    <div id="message" class="updated"><p><?php echo $message ?></p></div>
    <?php endif;?>

    <form id="form" method="POST">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(basename(__FILE__))?>"/>
    
        <input type="hidden" name="id" value="<?php echo $item['id'] ?>"/>

        <div class="metabox-holder" id="poststuff">
            <div id="post-body">
                <div id="post-body-content">
                    <?php /* And here we call our custom meta box */ ?>
                    <?php do_meta_boxes('autopost', 'normal', $item); ?>
                    <input type="submit" value="<?php _e('Save', 'custom_table_example')?>" id="submit" class="button-primary" name="submit">
                </div>
            </div>
        </div>
    </form>
</div>
<?php
}

function socialinize_autopost_function($id) {

       $table_name = $wpdb->prefix . 'socialinize_auto';
       $getDetails = $wpdb->get_row( "SELECT * FROM $table_name WHERE id = $id", ARRAY_A );
       $getDetails['message']; $getDetails['url'];
  
  $connectUrl =  "http://socialinize.com/connect/socialogins/".$api['socialinize_api']."/".$social."/";
}
add_action( 'socialinize_autopost', 'socialinize_autopost_function' );

function custom_table_form_meta_box_handler($item)
{
    ?>

<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
    <tbody>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="name"><?php _e('Name', 'socialinize-text-menuheading')?></label>
        </th>
        <td>
           <input type="radio" id="name" name="name"" value="facebook" >  <?php _e('Facebook', 'socialinize-text-menuheading')?>
             <input type="radio" id="name" name="name"" value="twitter" checked>  <?php _e('Twitter', 'socialinize-text-menuheading')?>
      
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="messages"><?php _e('Message', 'socialinize-text-menuheading')?></label>
        </th>
        <td>
            <input id="message" name="message" type="text" style="width: 95%" value="<?php echo esc_attr($item['message'])?> "
                   size="50" class="code" placeholder="<?php _e('Your message', 'socialinize-text-menuheading')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="links"><?php _e('Link', 'custom_table_example')?></label>
        </th>
        <td>
            <input id="link" name="link" type="text" style="width: 95%" value="<?php echo esc_attr($item['link'])?> "
                   size="50" class="code" placeholder="<?php _e('Your link', 'socialinize-text-menuheading')?>" required>
        </td>
    </tr>
       <tr class="form-field">
        <th valign="top" scope="row">
            <label for="link"><?php _e('Date', 'socialinize-text-menuheading')?></label>
        </th>
        <td>
              <input id="date" name="date"  type="date" style="width: 95%" value="<?php echo esc_attr($item['date'])?>"
                   size="50" class="code" placeholder="<?php _e('mm/dd/yyyy', 'socialinize-text-menuheading')?>" required>
        </td>
    </tr>
           <tr class="form-field">
        <th valign="top" scope="row">
            <label for="link"><?php _e('Time', 'socialinize-text-menuheading')?></label>
        </th>
        <td>
           <input id="time" name="time" type="time" style="width: 95%" value="<?php echo esc_attr($item['time'])?>"
                   size="50" class="code" placeholder="<?php _e('hh/mm', 'socialinize-text-menuheading')?>" required>
        </td>
    </tr>
    </tbody>
</table>
<?php
}

/**
 * Simple function that validates data and retrieve bool on success
 * and error message(s) on error
 *
 * @param $item
 * @return bool|string
 */
function custom_table_example_validate_post($item)
{
    $messages = array();

    if (empty($item['name'])) $messages[] = __('Network is required', 'socialinize-text-menuheading');

    if (empty($messages)) return true;
    return implode('<br />', $messages);
}









