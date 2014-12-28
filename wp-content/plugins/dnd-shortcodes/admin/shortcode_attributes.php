<?php
require( '../../../../wp-load.php' );

if ( !current_user_can( 'author' ) && !current_user_can( 'editor' ) && !current_user_can( 'administrator' ) )
	die( 'Access denied' );

if ( empty( $_GET['shortcode'] ) ){
	die('Wrong call');
}

$type = (isset($_GET['type'])) ? $_GET['type'] : '';


	function ABdev_attributes_and_content($shortcode, $shortcode_string){
		$shortcode_string_exploded = explode(']', $shortcode_string, 2);
		$return['name'] = $shortcode;
		$return['attributes'] = str_replace('['.$shortcode, '', $shortcode_string_exploded[0]);
		$shortcode_string = explode(']', $shortcode_string, 2);
		$return['content'] = (isset($shortcode_string_exploded[1])) ? str_replace('[/'.$shortcode.']', '', $shortcode_string_exploded[1]) : '';
		return $return;
	}

	function ABdev_extract_from_to($from, $to, $content) {
		$value = explode($from,$content,2);
		if(isset($value[1]) && $value[1]!=''){
			$value = explode($to,$value[1],2);
			$value = $value[0];
			return $value;
		}
		return;
	}	

	function ABdev_generate_attr_fields($attributes, $load_data = array()) {
		$type = (isset($_GET['type'])) ? $_GET['type'] : '';

		$return = '';
		foreach ( $attributes as $attribute => $attribute_data ) {
			if(!empty($load_data)){
				$editing_value = ABdev_extract_from_to($attribute."='","'", $load_data['attributes']);
			}

			$attribute_info_default = (isset($attribute_data['default'])) ? $attribute_data['default'] : '';
			$attribute_value = (!empty($load_data)) ? $editing_value : $attribute_info_default;
			$attribute_value = str_replace('*quot*', '"', $attribute_value);
			
			if($type!='column' || ($type=='column' && $attribute!='span')){
				$return .= '<tr>';
				$info_output = (isset($attribute_data['info'])) ? ' title="'.$attribute_data['info'].'"' : '';
				$info_class_output = (isset($attribute_data['info'])) ? 'dnd_attribute_with_info' : '';
				$return .= '<td class="dnd_with_label"><label class="'.$info_class_output.'" for="dnd_shortcode_attribute_'.$attribute.'"'.$info_output.'>'.$attribute_data['description'].'</label></td>';
				$attribute_type = (isset($attribute_data['type'])) ? $attribute_data['type'] : '';
				switch ($attribute_type) {
					case "checkbox":
						$return .= "<td><input type='checkbox' name='".$attribute."' value='1' id='dnd_shortcode_attribute_".$attribute."' class='dnd_shortcode_attribute' ".checked($attribute_value, 1, false)."/></td>";
						break;
					case "textarea":
						$return .= "<td><textarea name='".$attribute."' id='dnd_shortcode_attribute_".$attribute."' class='dnd_shortcode_attribute'>".$attribute_value."</textarea></td>";
						break;
					case "select":
						$return .= "<td><select name='".$attribute."' id='dnd_shortcode_attribute_".$attribute."' class='dnd_shortcode_attribute'>";
						foreach ( $attribute_data["values"] as $option_value => $option_name ) {
							$return .= "<option value='".$option_value."' ".selected($attribute_value, $option_value, false).">".$option_name."</option>";
						}
						$return .= "</select></td>";
						break;
					case "color":
						$return .= "<td><input type='text' name='".$attribute."' value='".$attribute_value."' class='dnd_shortcode_attribute dnd-colorpicker' data-default-color='".$attribute_info_default."'></td>";
						break;
					case "image":
						$return .= "<td><input type='text' name='".$attribute."' value='".$attribute_value."' class='dnd_shortcode_attribute' data-default-color='".$attribute_value."'>
							<input class='button upload_image_button' type='button' value='".__('Upload Image', "dnd-shortcodes")."'>
							</td>";
						break;
					case "media":
						$return .= "<td><input type='text' name='".$attribute."' value='".$attribute_value."' class='dnd_shortcode_attribute' data-default-color='".$attribute_value."'>
							<input class='button upload_image_button' type='button' value='".__('Upload Media', "dnd-shortcodes")."'>
							</td>";
						break;
					default:
						$return .= "<td><input type='text' name='".$attribute."' value='".$attribute_value."' id='dnd_shortcode_attribute_".$attribute."' class='dnd_shortcode_attribute'></td>";
						break;
				}
				$return .= '</tr>';
			}
		}
		return $return;
	}


	
	$shortcode = ABdevDND_shortcodes( $_GET['shortcode'] );
	
	$extract_att_cont = array();
	if(isset($_REQUEST['selected_content']) && $_REQUEST['selected_content'] != ''){
		$selected_content = urldecode($_REQUEST['selected_content']);
		$selected_content = htmlspecialchars_decode ( $selected_content ,ENT_QUOTES );
		$selected_content = str_replace('\\\\', '\\', $selected_content);
		$extract_att_cont = ABdev_attributes_and_content($_GET['shortcode'],$selected_content);
	}

	$edit_class_out = (isset($_GET['action']) && $_GET['action']=='edit') ? ' class="dnd_attributes_table_editing"' : '';

	$return = '<table id="dnd_attributes_table"'.$edit_class_out.'>';

	if(isset($_GET['action']) && $_GET['action']=='edit'){
		$return .= '<tr id="dnd_shortcode_title"><td colspan="2"><h3>'.$shortcode['description'].'</h3></td></tr>';
	}

	// Shortcode has help
	if ( !empty($shortcode['info']) && $type!='section' ) {
		$return .= '<tr id="dnd_shortcode_help"><td colspan="2"><p>'.$shortcode['info'].'</p></td></tr>';
	}

	// Shortcode has attributes
	if ( isset($shortcode['attributes']) && count( $shortcode['attributes'] ) ) {
		$return .= '<tbody class="dnd_shortcode_attributes">';
		$return .= ABdev_generate_attr_fields($shortcode['attributes'], $extract_att_cont);
		$return .= '</tbody>';
	}
	else{
		$return .= '<tr id="dnd_shortcode_help"><td colspan="2"><p>'.__("This shortcode doesn't have attributes", 'dnd-shortcodes').'</p></td></tr>';
	}

	// Wrapping with child
	if( isset($shortcode['child']) && $shortcode['child'] != '' && $type!='section' ){
		$child_name = $shortcode['child'];
		$return .= '<input type="hidden" name="dnd_shortcode_child_name" id="dnd_shortcode_child_name" value="'.$child_name.'" />';
		
		$children = array();
		if(!empty($extract_att_cont)){
			$children = trim($extract_att_cont['content'], '['.$child_name);
			$children = explode('['.$child_name, $children);
		}

		$i=0;
		do{
			$child_shortcode = (!empty($children)) ? ABdev_attributes_and_content($child_name,$children[$i]) : array();
			$child = ABdevDND_shortcodes( $child_name );
			$return .= '<tbody class="dnd_shortcode_child">';
			$child_title_no = $i + 1;
			$return .= '<tr><td colspan="2" class="dnd_child_title"><div><h4>' . $shortcode['child_title'] . ' <span>' . $child_title_no . '</span></h4><span class="dnd_child_remove_link">'.__('Remove', 'dnd-shortcodes').'</span></div></td></tr>';
			$return .= ABdev_generate_attr_fields($child['attributes'], $child_shortcode);
			if(isset($child['content'])){
				$child_content_default = (isset($child['content']['default'])) ? $child['content']['default'] : '';
				$child_content = (!empty($child_shortcode)) ? $child_shortcode['content'] : $child_content_default;
				$child_content = str_replace('*quot*', '"', $child_content);
				$child_content = str_replace('*nl*', "<br>", $child_content);

				$child_content_desc = (isset($child['content']['description'])) ? $child['content']['description'] : __( 'Content', 'dnd-shortcodes' );
				$child_editor_class = (isset($child['content']['no_editor']) && $child['content']['no_editor']==1) ? '' : 'textarea_tinymce';

				$return .= '<tr><td class="dnd_with_label"><label>' . $child_content_desc . '</label></td><td><textarea name="dnd_shortcode_child_content" id="dnd_shortcode_child_content_'.uniqid().'" class="dnd_shortcode_child_content '.$child_editor_class.'">' . $child_content . '</textarea></td></tr>';
			}
			else{
				$return .= '<input type="hidden" name="dnd_shortcode_child_content" id="dnd_shortcode_child_content" value="false" />';
			}
			$return .= '</tbody>';
			$i++;
		}while($i<sizeof($children));

		$child_button = ( isset($shortcode['child_button']) && $shortcode['child_button'] != '' ) ? $shortcode['child_button'] : 'Add Child';
		$output_add_child_button = '<a href="#" class="button-primary" id="dnd_shortcode_add_child">' . $child_button . '</a>';
	}

	// Wrapping shortcode
	elseif (isset($shortcode['content'])) {
		$shortcode_content_default = (isset($shortcode['content']['default'])) ? $shortcode['content']['default'] : '';
		$shortcode_content = (!empty($extract_att_cont)) ? $extract_att_cont['content'] : $shortcode_content_default;
		$shortcode_content = str_replace('*quot*', '"', $shortcode_content);
		$shortcode_content = str_replace('*nl*', "<br>", $shortcode_content);

		$shortcode_content_desc = (isset($shortcode['content']['description'])) ? $shortcode['content']['description'] : __( 'Content', 'dnd-shortcodes' );
		$content_editor_class = (isset($shortcode['content']['no_editor']) && $shortcode['content']['no_editor']==1) ? '' : 'textarea_tinymce';

		// hide content if editing section or column 
		if(!in_array($type, array('section','column'))){
			$return .= '<tr><td class="dnd_with_label"><label>' . $shortcode_content_desc . '</label></td><td><textarea name="dnd_shortcode_content" id="dnd_shortcode_content_'.uniqid().'" class="dnd_shortcode_content '.$content_editor_class.'">' . $shortcode_content . '</textarea></td></tr>';
		}
	}

			
	if($type=='column'){
		$return .= '<tr><td>'.(isset($output_add_child_button) ? $output_add_child_button : '').'</td><td class="dnd_insert_shortcode_button"><a href="#" class="button-primary" id="dnd_save_column_settings">' . __( 'Save Column Settings', 'dnd-shortcodes' ) . '</a></td></tr>';
	}
	elseif($type=='section'){
		$return .= '<tr><td>'.(isset($output_add_child_button) ? $output_add_child_button : '').'</td><td class="dnd_insert_shortcode_button"><a href="#" class="button-primary" id="dnd_save_section_settings">' . __( 'Save Section Settings', 'dnd-shortcodes' ) . '</a></td></tr>';
	}
	elseif(isset($_GET['action']) && $_GET['action']=='edit'){
		$return .= '<tr><td>'.(isset($output_add_child_button) ? $output_add_child_button : '').'</td><td class="dnd_insert_shortcode_button"><a href="#" class="button-primary" id="dnd_save_changes">' . __( 'Save Changes', 'dnd-shortcodes' ) . '</a></td></tr>';
	}
	else{
		$return .= '<tr><td>'.(isset($output_add_child_button) ? $output_add_child_button : '').'</td><td class="dnd_insert_shortcode_button"><a href="#" class="button-primary" id="dnd_insert_shortcode">' . __( 'Insert Shortcode', 'dnd-shortcodes' ) . '</a></td></tr>';
	}

	$return .= '</table>';

	$return .= '<input type="hidden" name="dnd_action" id="dnd_action" value="'.$_GET['action'].'" /><input type="hidden" name="dnd_shortcode" id="dnd_shortcode" value="'.$_GET['shortcode'].'" /><div class="clear"></div>';


	$wrapper_class = (isset($_GET['action']) && $_GET['action']=='edit') ? 'attributes_scroll_div' : '';

	$return = '<div id="dnd_edit_shortcode_wrapper" class="'.$wrapper_class.'">'.$return.'</div>';
	
	echo $return;
