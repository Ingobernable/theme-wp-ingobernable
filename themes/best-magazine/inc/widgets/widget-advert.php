<?php 
class best_magazine_adv extends WP_Widget
{
    function __construct(){
		$widget_ops = array('description' => __( 'Displays Advertisements', "best-magazine" ));
		$control_ops = array('width' => 400, 'height' => 500);
		parent::__construct(false,$name=sprintf(__( '%s Advertisement', "best-magazine" ), WDWT_TITLE ),$widget_ops,$control_ops);
	}

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
				$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : esc_html( $instance['title'] ) );
					$bannerPath=json_decode ($instance['bannerPath'],true);
					$bannerUrl=json_decode ($instance['bannerUrl'],true);
					$bannerTitle=json_decode ($instance['bannerTitle'],true);
					$bannerAlt=json_decode ($instance['bannerAlt'],true);
				echo $before_widget;
				if ( $title )
					echo $before_title . $title . $after_title;
					///iner widget html
					if(count($bannerPath))
					foreach($bannerPath as $key => $value) {
if ($bannerPath[$key] <> '') { ?>
<?php if ($bannerTitle[$key] == '') $bannerTitle[$key] = "advertisement";
	  if ($bannerAlt[$key] == '') $bannerAlt[$key] = "advertisement"; ?>
	<a href="<?php echo $bannerUrl[$key] ?>" ><img src="<?php echo $bannerPath[$key]; ?>" alt="<?php echo $bannerAlt[$key]; ?>" title="<?php echo $bannerTitle[$key]; ?>" /></a>
<?php };
					}
echo $after_widget;
				
		}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		$instance['bannerPath'] = $new_instance['bannerPath'];
		$instance['bannerUrl'] = $new_instance['bannerUrl'];
		$instance['bannerTitle'] = $new_instance['bannerTitle'];
		$instance['bannerAlt'] = $new_instance['bannerAlt'];
		return $instance;
		
		}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		
			$instance = wp_parse_args( (array) $instance, array('title'=>__('Advertisement', "best-magazine"), 'bannerPath'=>'', 'bannerUrl'=>'', 'bannerTitle'=>'', 'bannerAlt'=>'') );
			$title = esc_html($instance['title']);
			
			$bannerPath=json_decode ($instance['bannerPath'],true);
			$bannerUrl=json_decode ($instance['bannerUrl'],true);
			$bannerTitle=json_decode ($instance['bannerTitle'],true);
			$bannerAlt=json_decode ($instance['bannerAlt'],true);
			# Title
			
			
			?>
			<script>
			/// vercel imput@ split anerl @st pathi  url-i titli gtnel max count@ sarqel et qanakov sarqel
			if(typeof(create_inputs)!='function'){
				function get_next_id(main_div){
					fildsets=jQuery(main_div).find('fieldset');
					fildsets.each(function(index, element) {
						next_id=parseInt(this.id)+1;
					});
					return  next_id
					
				}
				function get_baner_path_id(main_div){
					return jQuery(main_div).find('.curent_widget_bannerPath_id').val();					
				}
				function get_baner_url_id(main_div){
					return jQuery(main_div).find('.curent_widget_bannerUrl_id').val();					
				}
				function get_baner_title_id(main_div){
					return jQuery(main_div).find('.curent_widget_bannerTitle_id').val();					
				}
				function get_baner_alt_id(main_div){
					return jQuery(main_div).find('.curent_widget_bannerAlt_id').val();					
				}
				
				function add_banner(button){
					
					var main_div=button.parentNode;
					var next_number=get_next_id(main_div);
					var banner_path_id=get_baner_path_id(main_div);
					var banner_url_id=get_baner_url_id(main_div);
					var banner_title_id=get_baner_title_id(main_div);
					var banner_alt_id=get_baner_alt_id(main_div);
					
					main_div=jQuery("#"+main_div.getAttribute('id'))
					
					fildset=jQuery("<fieldset></fieldset>").attr('id', next_number);
					
					legend=jQuery("<legend></legend>").attr('align','left').text('Banner '+next_number);
					
					Remove_div=jQuery("<div class=\"Remove_Banner\" style=\"display: block; float: right; margin-top: -30px; background-color: inherit; padding: 0 5px;\" onclick=\"remove_element(this)\"></div>").attr('class','Remove_Banner').text('Remove');
					
					p_elem_1=jQuery("<p></p>");					
					label_elem_1=jQuery("<label></label>").attr("for",banner_path_id+'_'+next_number).text('Path');
					br_elem_1=jQuery("<br>");
					inpu_elem_1=jQuery("<input onchange=\"create_inputs(this)\" type=\"text\"/>").attr('id',banner_path_id+'_'+next_number).attr('class','widefat banner_path');
					
					p_elem_2=jQuery("<p></p>");					
					label_elem_2=jQuery("<label></label>").attr("for",banner_url_id+'_'+next_number).text('Url');
					br_elem_2=jQuery("<br>");
					inpu_elem_2=jQuery("<input onchange=\"create_inputs(this)\" type=\"text\"/>").attr('id',banner_url_id+'_'+next_number).attr('class','widefat banner_url');


					p_elem_3=jQuery("<p></p>");					
					label_elem_3=jQuery("<label></label>").attr("for",banner_title_id+'_'+next_number).text('Title');
					br_elem_3=jQuery("<br>");
					inpu_elem_3=jQuery("<input onchange=\"create_inputs(this)\" type=\"text\"/>").attr('id',banner_title_id+'_'+next_number).attr('class','widefat banner_title');

					p_elem_4=jQuery("<p></p>");					
					label_elem_4=jQuery("<label></label>").attr("for",banner_alt_id+'_'+next_number).text('Alt');
					br_elem_4=jQuery("<br>");
					inpu_elem_4=jQuery("<input onchange=\"create_inputs(this)\" type=\"text\"/>").attr('id',banner_alt_id+'_'+next_number).attr('class','widefat banner_alt');
					
					
					p_elem_1.append(label_elem_1);
					p_elem_1.append(br_elem_1);
					p_elem_1.append(inpu_elem_1);
					
					p_elem_2.append(label_elem_2);
					p_elem_2.append(br_elem_2);
					p_elem_2.append(inpu_elem_2);
					
					p_elem_3.append(label_elem_3);
					p_elem_3.append(br_elem_3);
					p_elem_3.append(inpu_elem_3);			
					
					p_elem_4.append(label_elem_4);
					p_elem_4.append(br_elem_4);
					p_elem_4.append(inpu_elem_4);
					
					fildset.append(legend);					
					fildset.append(Remove_div);
					fildset.append(p_elem_1);
					fildset.append(p_elem_2);
					fildset.append(p_elem_3);
					fildset.append(p_elem_4);
					
					main_div.append(fildset);
					jQuery( fildset ).after(jQuery(button ) );
					insert_filling_inputs(main_div);
					
				}
				function create_inputs(input){
					main_div=input.parentNode.parentNode.parentNode;
					insert_filling_inputs(main_div);																
				}
				function if_last_baner(main_div){					
					if(jQuery(main_div).find('fieldset').length>1)
					return false;
					return true;
					
				}
				function remove_element(baner){
					main_div=baner.parentNode.parentNode;
					par_fildset=baner.parentNode;
					if(!if_last_baner(par_fildset.parentNode))
					par_fildset.parentNode.removeChild(par_fildset);
					insert_filling_inputs(jQuery(main_div));		
				}
				
				function insert_filling_inputs(main_div){
					var banner_path_id=get_baner_path_id(main_div);
					var banner_url_id=get_baner_url_id(main_div);
					var banner_title_id=get_baner_title_id(main_div);
					var banner_alt_id=get_baner_alt_id(main_div);
					
					var inserted_baner_path={}
					var inserted_baner_url={}
					var inserted_baner_title={}
					var inserted_baner_alt={}
					
					fildsets=jQuery(main_div).find('fieldset');
					
					fildsets.each(function(index, element) {
						var id_for_cur_inputs=jQuery(this).attr('id');
						jQuery(this).find('.banner_path').each(function(index, element) {	
							inserted_baner_path[''+id_for_cur_inputs+'']=jQuery(this).val();							
						});
						jQuery(this).find('.banner_url').each(function(index, element) {
							inserted_baner_url[''+id_for_cur_inputs+'']=jQuery(this).val();							
						});
						jQuery(this).find('.banner_title').each(function(index, element) {
							inserted_baner_title[''+id_for_cur_inputs+'']=jQuery(this).val();							
						});
						jQuery(this).find('.banner_alt').each(function(index, element) {
							inserted_baner_alt[''+id_for_cur_inputs+'']=jQuery(this).val();							
						});
						
					});	
					
					jQuery('#'+banner_path_id).val(JSON.stringify(inserted_baner_path));
					jQuery('#'+banner_url_id).val(JSON.stringify(inserted_baner_url));
					jQuery('#'+banner_title_id).val(JSON.stringify(inserted_baner_title));
					jQuery('#'+banner_alt_id).val(JSON.stringify(inserted_baner_alt));
													
				}
			}
			
			</script>
				<style>
			
		.best_magazine_fieldset{
			border: 2px solid #4f9bc6 ;/*#CCA383 1462a5*/
			width: 93%;
			background:  #fafbfd;
			padding: 13px;
			margin-top: 20px;	
			
			-webkit-border-radius: 8px;
			-moz-border-radius: 8px;
			border-radius: 8px;
		}     
		.best_magazine_fieldset .Remove_Banner{
			color:#F00;
			font-weight:bold;
			cursor:pointer;
		}   
			</style>
			<?php 
			echo '<p><label for="' . $this->get_field_id('title') . '">' .  __('Title', "best-magazine" ).':' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>'; ?>
			<div id="<?php echo $this->get_field_id('title') ?>_div">
			<?php if(count($bannerPath)){ 
			foreach($bannerPath as $key =>$value){

			?>
				<fieldset class="best_magazine_fieldset" id="<?php echo $key ?>">
				<legend align="left"><?php echo __('Banner',"best-magazine"); ?> <?php echo $key ?></legend>
				<div class="Remove_Banner" style="display: block; float: right; margin-top: -30px; background-color: inherit; padding: 0 5px;" onclick="remove_element(this)"><?php echo __('Remove',"best-magazine"); ?></div>
				<p><label for="<?php echo $this->get_field_id('bannerPath') ?>_<?php echo $key ?>"><?php echo __('Path',"best-magazine"); ?></label><br /><input abstype='path' class="widefat banner_path" onchange="create_inputs(this)"  id="<?php echo $this->get_field_id('bannerPath')?>_<?php echo $key ?>" name="<?php echo  $this->get_field_name('bannerPath')?>_<?php echo $key ?>" type="text" value="<?php echo $value ?>" />
				<p><label for="<?php echo $this->get_field_id('bannerUrl') ?>_<?php echo $key ?>"><?php echo __('Url',"best-magazine"); ?></label><br /><input abstype='url' class="widefat banner_url" onchange="create_inputs(this)" id="<?php echo $this->get_field_id('bannerUrl')?>_<?php echo $key ?>" name="<?php echo  $this->get_field_name('bannerPath')?>_<?php echo $key ?>" type="text" value="<?php echo $bannerUrl[$key]; ?>" />
				<p><label for="<?php echo $this->get_field_id('bannerTitle') ?>_<?php echo $key ?>"><?php echo __('Title',"best-magazine"); ?></label><br /><input abstype='title' class="widefat banner_title" onchange="create_inputs(this)" id="<?php echo $this->get_field_id('bannerTitle'); ?>_<?php echo $key ?>" name="<?php echo  $this->get_field_name('bannerPath'); ?>_<?php echo $key ?>" type="text" value="<?php echo $bannerTitle[$key]; ?>" />
				<p><label for="<?php echo $this->get_field_id('bannerAlt') ?>_<?php echo $key ?>"><?php echo __('Alt',"best-magazine"); ?></label><br /><input abstype='alt' class="widefat banner_alt" onchange="create_inputs(this)" id="<?php echo $this->get_field_id('bannerAlt')?>_<?php echo $key ?>" name="<?php echo  $this->get_field_name('bannerPath')?>_<?php echo $key ?>" type="text" value="<?php echo $bannerAlt[$key]; ?>" />
				</fieldset>
			
			<?php }}else {?>
				<fieldset class="best_magazine_fieldset" id="1">
				<legend align="left"><?php echo __('Banner 1',"best-magazine"); ?></legend>
				<div class="Remove_Banner" style="display: block; float: right; margin-top: -30px; background-color: inherit; padding: 0 5px;" onclick="remove_element(this)"><?php echo __('Remove',"best-magazine"); ?></div>
				<p><label for="<?php echo $this->get_field_id('bannerPath') ?>_1"><?php echo __('Path',"best-magazine"); ?></label><br /><input abstype='path' class="widefat banner_path" onchange="create_inputs(this)"  id="<?php echo $this->get_field_id('bannerPath')?>_1" name="<?php echo  $this->get_field_name('bannerPath')?>_1" type="text" value="" />
				<p><label for="<?php echo $this->get_field_id('bannerUrl') ?>_1"><?php echo __('Url',"best-magazine"); ?></label><br /><input abstype='url' class="widefat banner_url" onchange="create_inputs(this)" id="<?php echo $this->get_field_id('bannerUrl')?>_1" name="<?php echo  $this->get_field_name('bannerPath')?>_1" type="text" value="" />
				<p><label for="<?php echo $this->get_field_id('bannerTitle') ?>_1"><?php echo __('Title',"best-magazine"); ?></label><br /><input abstype='title' class="widefat banner_title" onchange="create_inputs(this)" id="<?php echo $this->get_field_id('bannerTitle'); ?>_1" name="<?php echo  $this->get_field_name('bannerPath'); ?>_1" type="text" value="" />
				<p><label for="<?php echo $this->get_field_id('bannerAlt') ?>_1"><?php echo __('Alt',"best-magazine"); ?></label><br /><input abstype='alt' class="widefat banner_alt" onchange="create_inputs(this)" id="<?php echo $this->get_field_id('bannerAlt')?>_1" name="<?php echo  $this->get_field_name('bannerPath')?>_1" type="text" value="" />
				</fieldset>
				<?php  } ?>
				<input type="button" onclick="add_banner(this)" value="<?php echo __('Add Banner',"best-magazine"); ?>" />
				<input type="hidden" value="<?php echo $this->get_field_id('bannerPath') ?>" class="curent_widget_bannerPath_id" />
				<input type="hidden" value="<?php echo $this->get_field_id('bannerUrl') ?>" class="curent_widget_bannerUrl_id" />
				<input type="hidden" value="<?php echo $this->get_field_id('bannerTitle') ?>" class="curent_widget_bannerTitle_id" />
				<input type="hidden" value="<?php echo $this->get_field_id('bannerAlt') ?>" class="curent_widget_bannerAlt_id" />
			</div>
			<?php	
			echo '<input class="widefat" id="' . $this->get_field_id('bannerPath') . '" name="' . $this->get_field_name('bannerPath') . '" type="hidden" value=\'' .$instance['bannerPath'] . '\' />';
			echo '<input class="widefat" id="' . $this->get_field_id('bannerUrl') . '" name="' . $this->get_field_name('bannerUrl') . '" type="hidden" value=\'' . ($instance['bannerUrl']) . '\' />';
			echo '<input class="widefat" id="' . $this->get_field_id('bannerTitle') . '" name="' . $this->get_field_name('bannerTitle') . '" type="hidden" value=\'' . ($instance['bannerTitle']) . '\' />';
			echo '<input class="widefat" id="' . $this->get_field_id('bannerAlt') . '" name="' . $this->get_field_name('bannerAlt') . '" type="hidden" value=\'' .( $instance['bannerAlt']) . '\' />';
		}

}// end web_buis_adv class
add_action('widgets_init', create_function('', 'return register_widget("best_magazine_adv");'))
?>