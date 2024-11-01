<?php
/*
Plugin Name: Whatsapp Share
Plugin URI: http://www.wapinfosolutions.com
Description: Whatsapp Share Button For Desktop and Web
Version: 1.0.1
Text Domain : whatsapp_share
*/

 global $whatsapp_share;    
 $whatsapp_share = new whatsapp_share();
class whatsapp_share{
    
    function __construct(){
	add_shortcode('whatsapp_share',array(&$this,'whatsapp_share_function'));
	add_action('plugins_loaded', array(&$this, 'whatsapp_share_load_textdomain'));
    }
    
    function whatsapp_share_function($atts){	
	$final_url='';
	$btn_text = isset($atts['button_text'])?$atts['button_text']:__('Share On Whatsapp','whatsapp_share');
	$class = isset($atts['button_class'])?$atts['button_class']:'whatsapp_share';
	$id = isset($atts['button_id'])?$atts['button_id']:'whatsapp_share';
	
	$type = isset($atts['message_type'])?$atts['message_type']:'direct_message';
	$number = isset($atts['number'])?$atts['number']:'';
	$message= isset($atts['message'])?$atts['message']:get_the_permalink();
        $target = isset($atts['new_tab'])?$atts['new_tab']:'';
        $target_text ='';
        if($target=='true'){
            $target_text = ' target="_blank" ';
        }
	
	if($type=='direct_message'){
	    
	    ?>
	    <a href="https://api.whatsapp.com/send?phone=<?php echo $number; ?>&text=<?php echo $message; ?>&l=en" class="<?php echo $class; ?>" id="<?php echo $id ?>" <?php echo $target_text; ?>><?php echo $btn_text ?></a>
	    <?php
	}
	else if($type=='only_message'){
	?>    
	<a href="https://api.whatsapp.com/send?text=<?php echo $message ?>&l=en"  class="<?php echo $class; ?>" id="<?php echo $id ?>" <?php echo $target_text; ?>><?php echo $btn_text ?></a>
	<?php
	}
	else if($type=='only_number'){
	    ?>
	<a href="https://api.whatsapp.com/send?phone=<?php echo $number ?>&l=en"  class="<?php echo $class; ?>" id="<?php echo $id ?>" <?php echo $target_text; ?>><?php echo $btn_text ?></a>
	<?php
	}	
    }
    
    function whatsapp_share_load_textdomain(){
	
    load_plugin_textdomain('whatsapp_share', false, 'whatsapp_share/languages/');
    }
}
