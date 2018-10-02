<?php
/*
Plugin Name: Vakavic anti-spam
Description: تنظیمات دسته‌بندی خودکار کامنت از طریق سایت <a href="http://vakavic.com/">واکاویک</a>
Author: Vakavic.com
Version: 1.2.5
Author URI:  http://t.me/vakavic
*/

if ( !defined( 'ABSPATH' ) )
    exit;

require_once (__DIR__ . '/settings.php');
    
add_filter( 'pre_comment_approved' , 'kbwp_vakavic_comment_check' , 99, 2 );
function kbwp_vakavic_comment_check( $approved , $commentdata )
{
    $options = get_option('kbwpvakcm_options');
    
    $url = 'https://api.vakavic.com/classifier/classify';
    $fields = array(
        'referenceKey' => $options['ref_key'],
        'text' => $commentdata['comment_content']
    );
    $headers = array(
        'Authorization' => "Bearer {$options['api_token']}"
    );
    $args = array(
        'body' => $fields,        
        'headers' => $headers,
        'blocking' => true
    );

    
    $response = wp_remote_post($url , $args );
    $result = json_decode($response['body']);
    
    if(empty($result) || $result == null) {
        return $approved;
    }
    else if ($result->Success == true
        && $result->label == $options['label']
        && (($result->probability * 100) >= $options['probability'])
    ) {
        if ($options['action'] == 'not_approved')
            return 0;
        else
            return 'spam';
    }

    if($result->Success == true && $result->remainingAPICalls == 0) {
        $options['api_remain_error'] = 1;
    } 
    else {
        $options['api_remain_error'] = 0;
    }
    
    update_option('kbwpvakcm_options', $options);
    
    return $approved;

}

function kbwp_vakavic_active_plugin() {
    $options = get_option('kbwpvakcm_options');
    if (empty($options['label']) && empty($options['probability'])) {
        $options['label'] = 'حذف';
        $options['probability'] = 20;
        update_option('kbwpvakcm_options', $options);
    }
}
register_activation_hook( __FILE__, 'kbwp_vakavic_active_plugin' );

add_action ('admin_init', 'kbwp_vakavic_api_remain_check');
function kbwp_vakavic_api_remain_check(){
    
    $options = get_option('kbwpvakcm_options');
    if ($options['api_remain_error'] == 1) {
        add_action( 'admin_notices', 'kbwp_vakavic_show_notice' );
    }
    return;
}

function kbwp_vakavic_show_notice() {
    echo '<div class="error"><p>' . sprintf( 'اعتبار حساب %sواکاویک%s شما به پایان رسیده است. لطفا نسبت به تمدید آن اقدام کنید.', '<a target="_blank" href="http://vakavic.com/">', '</a>' ) . '</p></div>';
}

