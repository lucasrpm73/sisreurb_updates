<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Samuel Xavier <samuelxavi@gmail.com>
 * @copyright 2019
**/

function reportError($string, $type = 'danger', $url = null, $oldPost = null){
	$CI =& get_instance();

	$erro = array();
	$erro['error_string'] 	= trim($string);
	$erro['error_type']		= $type;

	$CI->session->set_flashdata(array('error' => $erro));
	if(!empty($oldPost)){
		$CI->session->set_flashdata(array('oldPost' => $oldPost));
	}

	redirect(site_url($url));
}

function getError(){
	$CI =& get_instance();

	//Verifica se existe erro na sessão
	if($CI->session->flashdata('error')){
		return $CI->session->flashdata('error');
	} else {
		return array();
	}
}