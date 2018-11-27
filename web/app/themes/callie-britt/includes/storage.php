<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('callie_britt_storage_get')) {
	function callie_britt_storage_get($var_name, $default='') {
		global $CALLIE_BRITT_STORAGE;
		return isset($CALLIE_BRITT_STORAGE[$var_name]) ? $CALLIE_BRITT_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('callie_britt_storage_set')) {
	function callie_britt_storage_set($var_name, $value) {
		global $CALLIE_BRITT_STORAGE;
		$CALLIE_BRITT_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('callie_britt_storage_empty')) {
	function callie_britt_storage_empty($var_name, $key='', $key2='') {
		global $CALLIE_BRITT_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($CALLIE_BRITT_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($CALLIE_BRITT_STORAGE[$var_name][$key]);
		else
			return empty($CALLIE_BRITT_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('callie_britt_storage_isset')) {
	function callie_britt_storage_isset($var_name, $key='', $key2='') {
		global $CALLIE_BRITT_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($CALLIE_BRITT_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($CALLIE_BRITT_STORAGE[$var_name][$key]);
		else
			return isset($CALLIE_BRITT_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('callie_britt_storage_inc')) {
	function callie_britt_storage_inc($var_name, $value=1) {
		global $CALLIE_BRITT_STORAGE;
		if (empty($CALLIE_BRITT_STORAGE[$var_name])) $CALLIE_BRITT_STORAGE[$var_name] = 0;
		$CALLIE_BRITT_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('callie_britt_storage_concat')) {
	function callie_britt_storage_concat($var_name, $value) {
		global $CALLIE_BRITT_STORAGE;
		if (empty($CALLIE_BRITT_STORAGE[$var_name])) $CALLIE_BRITT_STORAGE[$var_name] = '';
		$CALLIE_BRITT_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('callie_britt_storage_get_array')) {
	function callie_britt_storage_get_array($var_name, $key, $key2='', $default='') {
		global $CALLIE_BRITT_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($CALLIE_BRITT_STORAGE[$var_name][$key]) ? $CALLIE_BRITT_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($CALLIE_BRITT_STORAGE[$var_name][$key][$key2]) ? $CALLIE_BRITT_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('callie_britt_storage_set_array')) {
	function callie_britt_storage_set_array($var_name, $key, $value) {
		global $CALLIE_BRITT_STORAGE;
		if (!isset($CALLIE_BRITT_STORAGE[$var_name])) $CALLIE_BRITT_STORAGE[$var_name] = array();
		if ($key==='')
			$CALLIE_BRITT_STORAGE[$var_name][] = $value;
		else
			$CALLIE_BRITT_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('callie_britt_storage_set_array2')) {
	function callie_britt_storage_set_array2($var_name, $key, $key2, $value) {
		global $CALLIE_BRITT_STORAGE;
		if (!isset($CALLIE_BRITT_STORAGE[$var_name])) $CALLIE_BRITT_STORAGE[$var_name] = array();
		if (!isset($CALLIE_BRITT_STORAGE[$var_name][$key])) $CALLIE_BRITT_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$CALLIE_BRITT_STORAGE[$var_name][$key][] = $value;
		else
			$CALLIE_BRITT_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('callie_britt_storage_merge_array')) {
	function callie_britt_storage_merge_array($var_name, $key, $value) {
		global $CALLIE_BRITT_STORAGE;
		if (!isset($CALLIE_BRITT_STORAGE[$var_name])) $CALLIE_BRITT_STORAGE[$var_name] = array();
		if ($key==='')
			$CALLIE_BRITT_STORAGE[$var_name] = array_merge($CALLIE_BRITT_STORAGE[$var_name], $value);
		else
			$CALLIE_BRITT_STORAGE[$var_name][$key] = array_merge($CALLIE_BRITT_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('callie_britt_storage_set_array_after')) {
	function callie_britt_storage_set_array_after($var_name, $after, $key, $value='') {
		global $CALLIE_BRITT_STORAGE;
		if (!isset($CALLIE_BRITT_STORAGE[$var_name])) $CALLIE_BRITT_STORAGE[$var_name] = array();
		if (is_array($key))
			callie_britt_array_insert_after($CALLIE_BRITT_STORAGE[$var_name], $after, $key);
		else
			callie_britt_array_insert_after($CALLIE_BRITT_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('callie_britt_storage_set_array_before')) {
	function callie_britt_storage_set_array_before($var_name, $before, $key, $value='') {
		global $CALLIE_BRITT_STORAGE;
		if (!isset($CALLIE_BRITT_STORAGE[$var_name])) $CALLIE_BRITT_STORAGE[$var_name] = array();
		if (is_array($key))
			callie_britt_array_insert_before($CALLIE_BRITT_STORAGE[$var_name], $before, $key);
		else
			callie_britt_array_insert_before($CALLIE_BRITT_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('callie_britt_storage_push_array')) {
	function callie_britt_storage_push_array($var_name, $key, $value) {
		global $CALLIE_BRITT_STORAGE;
		if (!isset($CALLIE_BRITT_STORAGE[$var_name])) $CALLIE_BRITT_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($CALLIE_BRITT_STORAGE[$var_name], $value);
		else {
			if (!isset($CALLIE_BRITT_STORAGE[$var_name][$key])) $CALLIE_BRITT_STORAGE[$var_name][$key] = array();
			array_push($CALLIE_BRITT_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('callie_britt_storage_pop_array')) {
	function callie_britt_storage_pop_array($var_name, $key='', $defa='') {
		global $CALLIE_BRITT_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($CALLIE_BRITT_STORAGE[$var_name]) && is_array($CALLIE_BRITT_STORAGE[$var_name]) && count($CALLIE_BRITT_STORAGE[$var_name]) > 0) 
				$rez = array_pop($CALLIE_BRITT_STORAGE[$var_name]);
		} else {
			if (isset($CALLIE_BRITT_STORAGE[$var_name][$key]) && is_array($CALLIE_BRITT_STORAGE[$var_name][$key]) && count($CALLIE_BRITT_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($CALLIE_BRITT_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('callie_britt_storage_inc_array')) {
	function callie_britt_storage_inc_array($var_name, $key, $value=1) {
		global $CALLIE_BRITT_STORAGE;
		if (!isset($CALLIE_BRITT_STORAGE[$var_name])) $CALLIE_BRITT_STORAGE[$var_name] = array();
		if (empty($CALLIE_BRITT_STORAGE[$var_name][$key])) $CALLIE_BRITT_STORAGE[$var_name][$key] = 0;
		$CALLIE_BRITT_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('callie_britt_storage_concat_array')) {
	function callie_britt_storage_concat_array($var_name, $key, $value) {
		global $CALLIE_BRITT_STORAGE;
		if (!isset($CALLIE_BRITT_STORAGE[$var_name])) $CALLIE_BRITT_STORAGE[$var_name] = array();
		if (empty($CALLIE_BRITT_STORAGE[$var_name][$key])) $CALLIE_BRITT_STORAGE[$var_name][$key] = '';
		$CALLIE_BRITT_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('callie_britt_storage_call_obj_method')) {
	function callie_britt_storage_call_obj_method($var_name, $method, $param=null) {
		global $CALLIE_BRITT_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($CALLIE_BRITT_STORAGE[$var_name]) ? $CALLIE_BRITT_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($CALLIE_BRITT_STORAGE[$var_name]) ? $CALLIE_BRITT_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('callie_britt_storage_get_obj_property')) {
	function callie_britt_storage_get_obj_property($var_name, $prop, $default='') {
		global $CALLIE_BRITT_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($CALLIE_BRITT_STORAGE[$var_name]->$prop) ? $CALLIE_BRITT_STORAGE[$var_name]->$prop : $default;
	}
}
?>