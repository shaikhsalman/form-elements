<?php 
/*
********************************************
@FORM ELEMENTS
********************************************
Author: Shaikh Salman
Author URI: http://shaikhsalman.net
Description: form element is the best way to use anywhere or in any CMS or Frameworks easily, without any strip tags
white spaces & etc
Version: Initial (1.0)
*/

class FORM_ELEMENTS {

	/*
	*
	*@OPTIONS - in array
	*if select (element) is visible then it will be showing
	*
	*/
	public $remove_secure_atts = null;

	/*
	*
	*@secure_atts
	*
	*
	*/
	private function secure_atts($secure_atts = null) {
		#get and 
		// $get_and = explode('&', $this->remove_secure_atts);

		// #get empty variable for attributes list(s)
		// $atts = '';

		// #get loop for split tags, slahes or etc
		// for ($x = 0; $x < count($get_and); $x++) {

		// 	$get =  $get_and[$x];
			
		// 	#strip or remove all tags
		// 	if ($get == 'tags') {
		// 		#allow all tags
		// 		$atts .= $secure_atts;
		// 	} else {
		// 		#deny all tags
		// 		$atts .= strip_tags($secure_atts);
		// 	}

		// }

		#deny all slashes
		//$atts .= stripslashes($secure_atts);
		//$atts .= htmlentities($secure_atts);

		return $secure_atts;
	}

	/*
	*
	*@get_element
	*set specific element with their own attributes
	*
	*/
	private function get_element($element_name, $attributes, $label_text = null) {
		switch ($element_name) {
			case 'input':
				return "<{$element_name} {$attributes} /> {$label_text}";
				break;
			case 'label' OR 'textarea' OR 'button' || "option" || "select":
				return "<{$element_name} {$attributes}>{$label_text}</{$element_name}>";
				break;
			default:
				return "Please choose element first";
				break;
		}
	}

	private function get_clean($clean) {
		#Replaces all spaces with nothing
		$string = str_replace(' ', '', $clean);

		#Removes special chars
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

		#Replaces multiple hyphens with single one
		$clean = preg_replace('/-+/', '-',$string);

		return $clean;
	}

	/*
	*
	*@has_attr
	*check if attributes are exists or not with thier own elements
	*it will be working on future
	*
	*/
	private function has_attr($atts,$hasAttr) {
		//$attr = strtolower($attr);
		$atts = $this->get_clean($atts);
		//$hasAttr = htmlentities($hasAttr);

		return (isset($hasAttr) === true && empty($hasAttr) === false) ? "{$atts}=\"{$hasAttr}\" " : '';
	}

	/*
	*
	*@get_atts
	*
	*/
	private function get_atts($args = null) {
		#get attributes string to an array
		$get_atts = explode('#A', $args);

		if (isset($get_atts[1]) === true && $get_atts[1] != null && $get_atts[1] != '') :
			#replace &'s values to an array
			$get_and = explode('&&', $get_atts[1]);

			#empty array
			$empty_array = array();

			#loop for attribute's values should be in single or duoble qoutes
			for ($i = 0; $i < count($get_and); $i++) {
				
				#get array again
				$slipt = explode('::', $get_and[$i]);

				$empty_array[] = $this->has_attr($slipt[0], $slipt[1]);
			}

			#get array for string
			$array_to_string = implode('', $empty_array);
		else :
			$array_to_string = null;
		endif;

		return $array_to_string;
	}

	/*
	*
	*@do_code
	*set element & get string for returning into an array
	*1st key is for label or value's text
	*2nd key is for attributes
	*
	*/
	private function do_code($element_name, $args = null) {

		$get_atts = explode('#A', $args);
		
		#set atts to print
		$array_to_string = $this->get_atts($args);

		#if find input element then return null label text
		$label_text = $get_atts[0];

		return $this->get_element($element_name, $this->secure_atts($array_to_string), $label_text);
	}

	/*
	*
	*@INPUT
	*
	*
	*/
	public function INPUT($args = null, $get_options = array()) {

		//$get_options = null;

		#if options are empty or null
		if (!empty($get_options)) :

			#set empty array
			$set_array = array();
			
			#slipts options one by one
			foreach ($get_options as $val) {

				$set_label = $this->LABEL($val);

				# set loop
				$set_array[] = $this->do_code('input', $set_label . $args);
			}

			# get array to string
			return $return_options = implode('', $set_array);
		else :
			# if options does not exists then return value will be null
			$return_options = null;

			# return rest elements
			return $this->do_code('input', $return_options . $args);
		endif;

	}

	/*
	*
	*@LABEL
	*
	*
	*/
	public function LABEL($args = null) {
		return $this->do_code('label', $args);
	}

	/*
	*
	*@TEXTAREA
	*
	*
	*/
	public function TEXTAREA($args = null) {
		return $this->do_code('textarea', $args);
	}

	/*
	*
	*@BUTTON
	*
	*
	*/
	public function BUTTON($args = null) {
		return $this->do_code('button', $args);
	}

	/*
	*
	*@SELECT
	*
	*
	*/
	public function SELECT($get_options = array(), $args = null) {
		#get options
		//$get_options = array('option 1', 'option 2', 'option 3');

		#if options are empty or null
		if (!empty($get_options)) :
			
			#set empty array
			$set_array = array();

			#slipts options one by one
			foreach ($get_options as $val) {

				#set loop
				$set_array[] = $this->do_code("option", $val);
			}

			#get array to string
			$return_options = implode('', $set_array);
			
			return $this->do_code("select", $return_options . $args);
		else:
			#if options does not exists 
			return 'Options are not exists [ie: $OPTIONS = array("option 1","option 2","option 3")]';
		endif;
	}

}
