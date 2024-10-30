<?php
/*
Plugin Name: Image Hover Effect for VC
Plugin URI: http://ithemelandco.com/Plugins/Image-Hover-Effect-For-VC/
Description: Make Awesome & Beautiful Image Hover Effects. This Plugin Is A Visual Composer AddOn
Author: iThemelandco
Version: 1.0
Author URI: http://ithemelandco.com/
Text Domain: ith_vc_hover_effect
 */
if ( ! defined( 'ABSPATH' ) ) exit; 
define('plugin_dir_url_it_vc_hover_effect', plugin_dir_url( __FILE__ ));
define ('ITH_VC_HOVER_EFFECT_ROOT_VC_URL',plugins_url('', __FILE__));
define( 'ITH_VC_HOVER_EFFECT_ROOT_VC', dirname(__FILE__));

define ('ITH_VC_HOVER_EFFECT_TEXTDOMAIN','ith_vc_hover_effect');
//PERFIX
define ('ITH_VC_HOVER_EFFECT_FIELDS_PERFIX', 'ith-hover-effect' );

 

class ith_vc_hover_effect_plugin  {
	public function __construct() 
	{
		
		
		//Add Shortcode Post And Page
		add_filter('init', array( $this,'ith_vc_hover_effect_shortcodes_add_scripts'));
		
		//Add And Remove Param
		add_action( 'init', array( $this, 'integrateWithVC' ) );
		
		add_action('admin_enqueue_scripts',array($this,'ith_vc_hover_effect_admin_scripts'));
		// IMAGE SIZE
		add_image_size('it_hor_image', '760', '500', true);
		add_image_size('it_ver_image', '470', '630', true);
		add_image_size('it_rec_image', '500', '500', true);

		
		$this->includes();
	}
	

	
	//Add And Remove Param
	public function integrateWithVC() {
		// Check if Visual Composer is installed
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}
		if(function_exists('vc_add_shortcode_param')){
				vc_add_shortcode_param('it_number' , array($this, 'ith_number_settings_field' ) );
			}else if(function_exists('add_shortcode_param'))
			{
				add_shortcode_param('it_number' , array($this, 'ith_number_settings_field' ) );
			}
	}
	
	//Number Param 
	function ith_number_settings_field($settings, $value){
		$dependency = '';
		$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
		$min = isset($settings['min']) ? $settings['min'] : '';
		$max = isset($settings['max']) ? $settings['max'] : '';
		$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';		   
		$output = '<input name="'.$settings['param_name']
				.'" class="wpb_vc_param_value wpb-textinput '
				.$settings['param_name'].' '.$settings['type'].' '.$settings['class'].'" id="'
				.$settings['param_name'].'" type="number" min="'.$min.'" max="'.$max.'" value="'.$value.'" ' . $dependency . 'style="max-width:100px; margin-right: 10px;" />'.$suffix;
				
		return $output;
	}
		
	function ith_vc_hover_effect_admin_scripts()
		{
			
			wp_enqueue_style('it-backend-style', plugin_dir_url_it_vc_hover_effect .'/css/back-end/custom_css_back.css');
			
		}	
		
		
		
	public function includes()	{

		require_once( 'class/it_hover_effect.php');
		
	}
	
	function ith_vc_hover_effect_shortcodes_add_scripts() {
		if(!is_admin()) {
			/*Public Styles*/
			wp_enqueue_style(ITH_VC_HOVER_EFFECT_FIELDS_PERFIX.'hover_style', plugin_dir_url_it_vc_hover_effect.'/css/hover-effect/imagehover-styles.css');
					
			wp_enqueue_style(ITH_VC_HOVER_EFFECT_FIELDS_PERFIX.'it_style', plugin_dir_url_it_vc_hover_effect.'/css/style.css');
					
		
			/*SCRIPTS*/
			wp_enqueue_script('jquery');
			
			

			
		}else
		{
			
			
		}
	}
	
}
new ith_vc_hover_effect_plugin();
?>