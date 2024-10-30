<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if(!class_exists('ith_vc_hover_effect'))
{
	class ith_vc_hover_effect
	{	
		
		public  $image_size,$desktop_column,$tablet_column,$mobile_column,$effect,$gutter,$bg_color,$link_open_check,$caption_align,$it_h_custom_css,$it_h_custom_class,$hlink,$rand_id;
		
		function __construct()
		{
			add_action('vc_before_init',array($this,'createShortcodes'));
			add_shortcode( 'ith_hover_effect', array( $this, 'renderShortcode' ) );
			add_shortcode( 'ith_hover_effect_item', array( $this, 'renderitemShortcode' ) );
		}
		// Shortcode function
		function createShortcodes()
		{
			include( 'class_it_hover_effect.php' );

			if(function_exists('vc_map'))
			{
				// Parent container
				vc_map( array(
					"name" => __( 'Image Hover Effect', ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
					"base" => "ith_hover_effect",
					"icon" => ITH_VC_HOVER_EFFECT_ROOT_VC_URL .'/img/icon.png',
					"as_parent" => array( 'only' => 'ith_hover_effect_item' ),
					"js_view" => 'VcColumnView',
					"content_element" => true,
					'is_container' => true,
					'container_not_allowed' => false,
					"category" => __('iThemelandco Addons', ITH_VC_HOVER_EFFECT_TEXTDOMAIN  ),
					"params" => array(
						
						
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Hover Effect",  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  ),
							"description" => __("Choose your hover effect",  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  ),
							"param_name" => "effect",
							"value" => array(
								__("Push Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"push-up",
								__("Slide Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"slide-up",
								__("Reveal Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"reveal-up",
								__("Fade In" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"fade",
								__("Hinge Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"hinge-up",
								__("Flip Horizontal" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"flip-horiz",
								__("Shutter Out Horizontal" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"shutter-out-horiz",
								__("Fold Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"fold-up",
								__("Zoom In" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"zoom-in", 
								__("Blur" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"blur",
								__("Blocks Rotate Left" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"blocks-rotate-left",
								__("Strip Shutter Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"strip-shutter-up",
								__("Pixel Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"pixel-up",
								__("Pivot In Top Left" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"pivot-in-top-left",
								__("Throw In Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"throw-in-up", 
								__("Blinds Horiz" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"blinds-horiz",
								__("Border Reveal" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"border-reveal",
								__("Image Zoom Center" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"image-zoom-center",
								__("Image Rotate Left" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"image-rotate-left",
								__("Book Open Horiz" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"book-open-horiz",
								__("Circle Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"circle-up",
								__("Shift Top Left" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"shift-top-left",
								__("Bounce In" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"bounce-in",
								__("Fall Away Horiz" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"fall-away-horiz",
								__("Modal Slide Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"modal-slide-up",
								__("Lightspeed In Left" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"lightspeed-in-left",
								__("Grad Radial In" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"grad-radial-in",
								__("Parallax Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"parallax-up",
								__("Stack Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"stack-up",
								__("Cube Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"cube-up",
								__("Dive" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"dive",
								__("Splash Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"splash-up",
								__("Switch Up" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"switch-up",
								__("Flash Top Left" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"flash-top-left",
								),
							"description" => __( 'Effect', ITH_VC_HOVER_EFFECT_TEXTDOMAIN   ),
							'group' => "Hover Settings"
						),
						array(
						   "type" => "colorpicker",
						   "class" => "",
						   "heading" => __("Overlay Background Color",  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  ),
						   "param_name" => "bg_color",
						   "value" => '',
						   "description" => __("Leave blank to ignore",  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  ),
						   'group' => "Hover Settings"
						  ),
						
						
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("<div class='it-main-heading'><span>Item Setting</span></div>Image Size",  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  ),
							"param_name" => "image_size",
							"value" => array(
								__("Thumbnail" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"thumbnail",
								__("Medium" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"medium",
								__("Large" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"larg",	
								__("Horizontal" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"it_hor_image",											
								__("Vertical" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"it_ver_image",	
								__("Square" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"it_rec_image",	
								__("Circle" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"it_round_image",	
								),
							"description" => __( 'Choose Size of images', ITH_VC_HOVER_EFFECT_TEXTDOMAIN   ),
							'group' => "Hover Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Desktop Column",  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  ),
							"param_name" => "desktop_column",
							"value" => array(
								__("1 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"12",
								__("2 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"6",
								__("3 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"4",
								__("4 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"3",
								__("6 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"2",
								__("12 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"1",	
								),
							"description" => __( 'Desktop Column', ITH_VC_HOVER_EFFECT_TEXTDOMAIN   ),
							'group' => "Hover Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Tablet Column",  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  ),
							"param_name" => "tablet_column",
							"value" => array(
								__("1 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"12",
								__("2 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"6",
								__("3 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"4",
								__("4 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"3",
								__("6 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"2",
								__("12 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"1",	
								),
							"description" => __( 'Tablet Column', ITH_VC_HOVER_EFFECT_TEXTDOMAIN   ),
							'group' => "Hover Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Mobile Column",  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  ),
							"param_name" => "mobile_column",
							"value" => array(
								__("1 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"12",
								__("2 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"6",
								__("3 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"4",
								__("4 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"3",
								__("6 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"2",
								__("12 Column" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"1",	
								),
							"description" => __( 'Mobile Column', ITH_VC_HOVER_EFFECT_TEXTDOMAIN   ),
							'group' => "Hover Settings"
						),  
						array(
							"type" => "it_number",
							"class" => "",
							"heading" => __("Gutter", ITH_VC_HOVER_EFFECT_TEXTDOMAIN  ),
							"param_name" => "gutter",
							"value" =>'5',
							"description" =>  __("Gutter", ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
							'group' => "Hover Settings",
						),
						
						array(
						   "type" => "checkbox",
						   "class" => "",
						   "heading" => __("Open Links In New Tab?",  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  ),
						   "param_name" => "link_open_check",
						   "value" => array(
							__("" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"true"          
						   ),
						   "description" => '',
						   'group' => "Hover Settings"
						),
						
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("<div class='it-main-heading'><span>Heading and Description Settings</span></div> Heading And Description Align",  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  ),
							"param_name" => "caption_align",
							"value" => array(
								__("Top Left" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"it-caption-top-left",
								__("Top Center" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"it-caption-top-center",
								__("Top Right" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"it-caption-top-right",
								__("Middle Center" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"it-caption-middle",
								__("Bottom Left" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"it-caption-bottom-left",
								__("Bottom Center" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"it-caption-bottom-center",
								__("Bottom Right" ,  ITH_VC_HOVER_EFFECT_TEXTDOMAIN  )=>"it-caption-bottom-right",
								),
							"description" => __( 'Align of heading and description on image', ITH_VC_HOVER_EFFECT_TEXTDOMAIN   ),
							'group' => "Hover Settings"
						),
						array(
								"type" => "textfield",
								"heading" => __( 'Custom Class', ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
								"param_name" => "it_h_custom_class",
								"description" => __( 'Type your custom Class here', ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
								'group' => "Custom CSS",
							),
						array(
								"type" => "textarea",
								"heading" => __( 'Custom CSS', ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
								"param_name" => "it_h_custom_css",
								"description" => __( 'Type your custom CSS here', ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
								'group' => "Custom CSS",
							),

					)
					));
				// Nested Element
				vc_map( array(
						"name" => __( 'Image Hover Item', ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
						"base" => "ith_hover_effect_item",
						"icon" => ITH_VC_HOVER_EFFECT_ROOT_VC_URL .'/img/icon.png',
						"as_child" => array( 'only' => 'ith_hover_effect' ),
						"content_element" => true,
						'container_not_allowed' => false,
						"params" => array(
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Image",  ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
								"param_name" => "gallery",
								"description" => __( 'Choose you images for gallery', ITH_VC_HOVER_EFFECT_TEXTDOMAIN   ),
							),
							array(
								"type" => "textfield",
								"heading" => __( 'Title', ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
								"param_name" => "htitle",
								"description" => __( 'Title', ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
							),
							array(
								"type" => "textarea",
								"heading" => __( 'Description', ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
								"param_name" => "hdescription",
								"description" => __( 'Description', ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
							),
							array(
								"type" => "textfield",
								"heading" => __( 'Image Link', ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
								"param_name" => "hlink",
								"description" => __( 'http://www.example.com', ITH_VC_HOVER_EFFECT_TEXTDOMAIN ),
							),
							)
						));	
			}
		}
		// Shortcode handler function for  Parent
		function renderShortcode($atts, $content = null)
		{
			$image_size=
			$desktop_column=
			$tablet_column=
			$mobile_column=
			$effect=
			$gutter=
			$bg_color=
			$link_open_check=
			$caption_align=
			$it_h_custom_css=
			$it_h_custom_class=
			$output='';
			
			extract(shortcode_atts( array(
				'image_size'=>'thumbnail',
				'desktop_column'=>'12',
				'tablet_column'=>'12',
				'mobile_column'=>'12',
				'effect'=>'push-up',
				'gutter'=>'5',
				'bg_color'=>'#dfb9b9',
				'link_open_check'=>'false',
				'caption_align'=>'it-caption-top-left',
				'it_h_custom_css'=>'',
				'it_h_custom_class'=>'',
				),$atts));
			$circle = "";
			$this->image_size=$image_size;
			$this->desktop_column=$desktop_column;
			$this->tablet_column=$tablet_column;
			$this->mobile_column=$mobile_column;
			$this->effect=$effect;
			$this->gutter=$gutter;
			$this->bg_color=$bg_color;
			$this->link_open_check=$link_open_check;
			$this->caption_align = $caption_align;
			$this->it_h_custom_css=$it_h_custom_css;
			$this->it_h_custom_class=$it_h_custom_class;

			$this->rand_id=rand(0,1000);
			$output = '<div class="it-row">';
			
			$output .= do_shortcode($content);
			
			
			$output.='</div>';
			
			$this->ith_hover_custom_css();
			return $output;	
		}
		// Shortcode handler function for  Nested
		function renderitemShortcode($atts, $content = null)
		{
			$gallery=
			$htitle=
			$hdescription=
			$hlink=
			$output='';
			
			extract(shortcode_atts( array(
				'gallery'=>'',
				'htitle'=>'',
				'hdescription'=>'',
				'hlink'=>'',
				),$atts));
				
			$this->hlink=$hlink;
				
			$output .='<div class="it-col it-col-lg-'.$this->desktop_column.' it-col-md-'.$this->tablet_column.' it-col-xs-'.$this->mobile_column.' it-style-'. $this->rand_id .' '.$this->it_h_custom_class.'" >';
			
			$image_thumb_size=$this->image_size;
			if ($this->image_size=='it_round_image')
				$image_thumb_size = 'it_rec_image';
			
			$img = wp_get_attachment_image_src( $gallery, $image_thumb_size);
			
			//die($this->link_open_check);
			$link_open='';
			if ($this->link_open_check == 'true') {
                $link_open = "_blank";
            } else {
               $link_open = "_self";
            }
			$link='';
			if($hlink!=''){
				$link='<a target="'.$link_open.'" href="'.$hlink.'"></a>';
			}
			$output.='<div class="it-hover-'.$this->effect.'"><img src="'.$img[0].'" alt="'.$htitle.'">
							<div class="it-caption">
								<div class="it-catption-table '.$this->caption_align.'">						  
									<div class="it-captoin-table-cell">
										<h3>'.$htitle.'</h3>
										<p>'.$hdescription.'</p>
									</div>
								</div>
							</div>'.$link.'
						</div>';
			$output .='</div>';

			return $output;	
		}
		// function for  Custom CSS
		function ith_hover_custom_css()  {
			///die($this->hlink);
			$inline_css='';
			wp_enqueue_style('it-custom-css', ITH_VC_HOVER_EFFECT_ROOT_VC_URL . '/css/custom-css.css', array() , null); 
			
			if(strpos($this->effect,'reveal') !== FALSE || strpos($this->effect,'shutter') !== FALSE || strpos($this->effect,'blocks') !== FALSE || strpos($this->effect,'strip') !== FALSE || strpos($this->effect,'pixel') !== FALSE || strpos($this->effect,'blinds') !== FALSE || strpos($this->effect,'border') !== FALSE || strpos($this->effect,'book') !== FALSE || strpos($this->effect,'circle') !== FALSE || strpos($this->effect,'grad') !== FALSE || strpos($this->effect,'splash') !== FALSE || strpos($this->effect,'flash') !== FALSE){
				if(strpos($this->effect,'grad') !== FALSE){
					if(strpos($this->effect,'grad-radial-in') !== FALSE){
						$inline_css.='
						.it-style-'.$this->rand_id.' .it-hover-grad-radial-in:before{
								background-image: -webkit-radial-gradient(transparent 0%, '.$this->bg_color.' 100%);
								background-image: radial-gradient(transparent 0%, '.$this->bg_color.' 100%);
								z-index: 1;
						}';
					}else if(strpos($this->effect,'grad-radial-out') !== FALSE){
						$inline_css.='
						.it-style-'.$this->rand_id.' .it-hover-grad-radial-out:before{
								background-image: -webkit-radial-gradient('.$this->bg_color.' 0%, transparent 100%);
							    background-image: radial-gradient('.$this->bg_color.' 0%, transparent 100%);
								z-index: 1;
						}';
					}else if(strpos($this->effect,'grad-up') !== FALSE){
						$inline_css.='
						.it-style-'.$this->rand_id.' .it-hover-grad-up:before{
								background-image: -webkit-linear-gradient(top, transparent 0%, '.$this->bg_color.' 100%);
    							background-image: linear-gradient(to bottom, transparent 0%, '.$this->bg_color.' 100%);
								z-index: 1;
						}';
					}else if(strpos($this->effect,'grad-down') !== FALSE){
						$inline_css.='
						.it-style-'.$this->rand_id.' .it-hover-grad-down:before{
								background-image: -webkit-linear-gradient(bottom, transparent 0%, '.$this->bg_color.' 100%);
   								background-image: linear-gradient(to top, transparent 0%, '.$this->bg_color.' 100%);
								z-index: 1;
						}';
					}else if(strpos($this->effect,'grad-left') !== FALSE){
						$inline_css.='
						.it-style-'.$this->rand_id.' .it-hover-grad-left:before{
								background-image: -webkit-linear-gradient(left, transparent 0%, '.$this->bg_color.' 100%);
    							background-image: linear-gradient(to right, transparent 0%, '.$this->bg_color.' 100%);
								z-index: 1;
						}';
					}else if(strpos($this->effect,'grad-right') !== FALSE){
						$inline_css.='
						.it-style-'.$this->rand_id.' .it-hover-grad-right:before{
								background-image: -webkit-linear-gradient(right, transparent 0%, '.$this->bg_color.' 100%);
    							background-image: linear-gradient(to left, transparent 0%, '.$this->bg_color.' 100%);
								z-index: 1;
						}';
					}else if(strpos($this->effect,'grad-top-left') !== FALSE){
						$inline_css.='
						.it-style-'.$this->rand_id.' .it-hover-grad-top-left:before{
								background-image: -webkit-linear-gradient(-45deg, transparent 0%, '.$this->bg_color.' 100%);
    							background-image: linear-gradient(-45deg, transparent 0%, '.$this->bg_color.' 100%);
								z-index: 1;
						}';
					}else if(strpos($this->effect,'grad-top-right') !== FALSE){
						$inline_css.='
						.it-style-'.$this->rand_id.' .it-hover-grad-top-right:before{
								background-image: -webkit-linear-gradient(45deg, transparent 0%, '.$this->bg_color.' 100%);
    							background-image: linear-gradient(45deg, transparent 0%, '.$this->bg_color.' 100%);
								z-index: 1;
						}';
					}else if(strpos($this->effect,'grad-bottom-left') !== FALSE){
						$inline_css.='
						.it-style-'.$this->rand_id.' .it-hover-grad-bottom-left:before{
								background-image: -webkit-linear-gradient(--45deg, transparent 0%, '.$this->bg_color.' 100%);
    							background-image: linear-gradient(-135deg, transparent 0%, '.$this->bg_color.' 100%);
								z-index: 1;
						}';
					}else if(strpos($this->effect,'grad-bottom-right') !== FALSE){
						$inline_css.='
						.it-style-'.$this->rand_id.' .it-hover-grad-bottom-right:before{
								background-image: -webkit-linear-gradient(-45deg, transparent 0%, '.$this->bg_color.' 100%);
    							background-image: linear-gradient(135deg, transparent 0%, '.$this->bg_color.' 100%);
								z-index: 1;
						}';
					}
				}
				else{
					$inline_css.='
					/*Heading Main Color*/
					.it-style-'.$this->rand_id.' [class^="it-hover-"]:before,
					.it-style-'.$this->rand_id.' [class*=" it-hover-"]:before,
					.it-style-'.$this->rand_id.' [class^="it-hover-"]:after,
					.it-style-'.$this->rand_id.' [class^="it-hover-"] .it-caption:before,
					.it-style-'.$this->rand_id.' [class^="it-hover-"] .it-caption:after{
						background-color:'.$this->bg_color.';
						
					}';
				}
			}else{
			$inline_css.='
				/*Heading Main Color*/
				.it-style-'.$this->rand_id.' [class^="it-hover-"] .it-caption, 
				.it-style-'.$this->rand_id.' [class*=" it-hover-"] .it-caption{
					background-color:'.$this->bg_color.';
					
				}';
			}
			if($this->image_size=='it_round_image'){
			 $inline_css.='
			 .it-style-'.$this->rand_id.' [class^="it-hover-"],
			 .it-style-'.$this->rand_id.' [class*=" it-hover-"]{
			  	border-radius: 50%;
			  }';
		   }
   

				/*Heading Main Color*/
				$inline_css.='
				.it-style-'.$this->rand_id.'{
					line-height: 0;
					padding-right:'.round($this->gutter / 2).'px;
					padding-left:'.round($this->gutter / 2).'px;
					margin-bottom:'.$this->gutter.'px
				}';
			
			$inline_css .= $this->it_h_custom_css;
				
			wp_add_inline_style( 'it-custom-css', $inline_css );
		}

	}
}
$GLOBALS['ith_vc_hover_effect'] = new ith_vc_hover_effect;
?>