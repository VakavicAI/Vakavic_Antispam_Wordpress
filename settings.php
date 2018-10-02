<?php

class KBWP_Vakavic_Comment_Check_Setting
{
    var $current_post_type = null;

	function __construct() {
        add_action('admin_menu', array( $this, 'menu' ));
        /**
         * register our kbwpvakcm_settings_init to the admin_init action hook
         */
        add_action('admin_init', array( $this,'kbwpvakcm_settings_init'));    
        
	}
    
    
    /**
     * top level menu
     */    
    function menu() {
        add_comments_page( 
              'واکاویک'
            , 'تنظیمات واکاویک'
            , 'manage_options' // -> Capability level
            , 'kbwpvakcm_setting'
            ,  array( $this, 'kbwpvakcm_options_page' ) 
        );
    }    

    
    function kbwpvakcm_settings_init()
    {
        // register a new setting for "kbwpvakcm" page
        register_setting('kbwpvakcm', 'kbwpvakcm_options');

        // register a new section in the "kbwpvakcm" page
        add_settings_section(
            'kbwpvakcm_setting_section',
            '',
            '',
            'kbwpvakcm'
        ); 
        
        // register a new field in the "kbwpvakcm_setting_section" section, inside the "kbwpvakcm" page
        add_settings_field(
            'api_token',
            // use $args' label_for to populate the id inside the callback
            __('API Key', 'kbwpvakcm'),
            array($this,'kbwpvakcm_input'),
            'kbwpvakcm',
            'kbwpvakcm_setting_section',
            [
                'label_for'         => 'api_token',
                'class'             => 'kbwpvakcm_input_rtl',
                'kbwpvakcm_custom_data' => 'custom',
            ]
        );
        
        add_settings_field(
            'ref_key',
            __('Reference Key', 'kbwpvakcm'),
            array($this,'kbwpvakcm_input'),
            'kbwpvakcm',
            'kbwpvakcm_setting_section',
            [
                'label_for'         => 'ref_key',
                'class'             => 'kbwpvakcm_input_rtl',
                'kbwpvakcm_custom_data' => 'custom',
            ]
        );   
        
        
        add_settings_field(
            'action',
            __('انتقال کامنتهای حذف شده به', 'kbwpvakcm'),
            array($this,'kbwpvakcm_radio'),
            'kbwpvakcm',
            'kbwpvakcm_setting_section',
            [
                'label_for'         => 'action',
                'class'             => 'kbwpvakcm_input_rtl',
                'kbwpvakcm_custom_data' => 'custom',
            ]
        ); 
        
        add_settings_field(
            'pro_settings',
            // use $args' label_for to populate the id inside the callback
            __('تنظیمات پیشرفته', 'kbwpvakcm'),
            array($this,'kbwpvakcm_checkbox'),
            'kbwpvakcm',
            'kbwpvakcm_setting_section',
            [
                'label_for'         => 'pro_settings',
                'class'             => 'kbwcpiv2_row',
                'kbwpvakcm_custom_data' => 'custom',
            ]
        );    
        
        add_settings_field(
            'label',
            __('برچسب', 'kbwpvakcm'),
            array($this,'kbwpvakcm_input'),
            'kbwpvakcm',
            'kbwpvakcm_setting_section',
            [
                'label_for'         => 'label',
                'class'             => 'kbwpvakcm_input',
                'kbwpvakcm_custom_data' => 'custom',
            ]
        ); 
        
        add_settings_field(
            'probability',
            __('درصد احتمال', 'kbwpvakcm'),
            array($this,'kbwpvakcm_input_number'),
            'kbwpvakcm',
            'kbwpvakcm_setting_section',
            [
                'label_for'         => 'probability',
                'class'             => 'kbwpvakcm_input_rtl',
                'kbwpvakcm_custom_data' => 'custom',
            ]
        );             
        
    }

    // section callbacks can accept an $args parameter, which is an array.
    // $args have the following keys defined: title, id, callback.
    // the values are defined at the add_settings_section() function.    
    function kbwpvakcm_setting_section_cb($args) {
        //$args
    }
    
    function kbwpvakcm_input($args)
    {
        $options = get_option('kbwpvakcm_options');
        
        $readonly = '';
        if ( in_array($args['label_for'],  array('label', 'probability')) && empty($options['pro_settings']) ) 
            $readonly = 'readonly';
        
        echo "<input type='text' id='{$args['label_for']}' name='kbwpvakcm_options[{$args['label_for']}]' value='{$options[$args['label_for']]}' {$readonly}>";

        switch ($args['label_for']) {
            case 'api_token':
                echo '<p class="description">کلید دسترسی به API است که پس از ثبت نام در وبسایت واکاویک از صفحه تنظیمات حساب کاربری قابل دسترسی است.</p>';
                break;
            case 'ref_key':
                echo '<p class="description">کد یکتای ماژول مورد نظر است که از صفحه ماژول در تب تنظیمات صفحه هر ماژول در سایت واکاویک قابل دسترسی است</p>';
                break;                    
        }
    }   
    

    function kbwpvakcm_input_number($args)
    {
        $options = get_option('kbwpvakcm_options');
        
        $readonly = '';
        if ( in_array($args['label_for'],  array('label', 'probability')) && empty($options['pro_settings']) ) 
            $readonly = 'readonly';
        
        echo "<input type='number' id='{$args['label_for']}' name='kbwpvakcm_options[{$args['label_for']}]' value='{$options[$args['label_for']]}' step='0.1' min='0' max='100' {$readonly}>درصد";
        echo '<p class="description">نتیجه بیشتر از این احتمال موجب اسپم شدن کامنت میشود</p>';                  
    }
    
    function kbwpvakcm_checkbox($args)
    {
        // get the value of the setting we've registered with register_setting()
        $options = get_option('kbwpvakcm_options');
        echo "<input type='checkbox' id='{$args['label_for']}' name='kbwpvakcm_options[{$args['label_for']}]' value='1'" . checked( 1, $options[$args['label_for']], false ) . '/>';

    }     
    
    
    function kbwpvakcm_radio($args)
    {
        // get the value of the setting we've registered with register_setting()
        $options = get_option('kbwpvakcm_options');
        echo "
            <label for='action_not_approved'> 
            <input type='radio' id='action_not_approved' name='kbwpvakcm_options[{$args['label_for']}]' value='not_approved'" . checked( 'not_approved', $options[$args['label_for']], false ) . "/>در انتظار تایید (Not approved)
            </label>
            ";
        
        echo "
            <label for='action_spam'> 
            <input type='radio' id='action_spam' name='kbwpvakcm_options[{$args['label_for']}]' value='spam'" . checked( 'spam', $options[$args['label_for']], false ) . "/>جفنگ (Spam)
            </label>
            ";

    }    
    
    /**
     * top level menu:
     * callback functions
     */
    function kbwpvakcm_options_page()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        if  ( isset( $_GET['settings-updated'] ) ) {
            add_settings_error('kbwpvakcm_messages', 'wpmerge_messages', __('تنظیمات ذخیره شد.', 'kbwpvakcm'), 'updated');
        }

        // show error/update messages
        settings_errors('kbwpvakcm_messages');
        ?>


        <div class="wrap">
            
            <a href="http://vakavic.com" target="_blank"><img src="<?php echo plugins_url( 'assets', __FILE__ ) .'/img/logo.png'?>" style="width:200px;"></a>
            <h1><?php _e('تنظیمات دسته‌بندی خودکار کامنت', 'kbwpvakcm'); ?></h1>
            
            <form action="options.php" method="post">
                <?php
                // output security fields for the registered setting "kbwpvakcm"
                settings_fields('kbwpvakcm');
                // output setting sections and their fields
                // (sections are registered for "kbwpvakcm", each field is registered to a specific section)
                do_settings_sections('kbwpvakcm');
                // output save settings button
                ?> <p> <?php
                //submit_button();
                ?>
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e('ذخیره تنظیمات', 'kbwpvakcm') ?>">                       
            </form>
        </div>


        <style>
            .kbwpvakcm_input_rtl input {
                direction: ltr;
                text-align: left;
            }
            #action_spam {
                margin-right: 40px;
            }
        </style>

        <script>

            jQuery(function($) {

                $('#pro_settings').change(function() {
                    if($(this).is(":checked")) {

                        $('#label').prop('readonly', false);
                        $('#probability').prop('readonly', false);

                    }
                    else {
                        $('#label').prop('readonly', true);
                        $('#probability').prop('readonly', true);
                    }
                });
                
            });
            
        </script>

        <?php               
    }    

}

new KBWP_Vakavic_Comment_Check_Setting();

?>