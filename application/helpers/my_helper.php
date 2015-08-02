<?php 
// for checking user role cannot access some page
function checkUser($a = array()) {
	$CI =& get_instance();
	if ($CI->session->userdata('logged_in') && in_array($CI->session->userdata('logged_in')['role_id'], $a)) {
	}
	else
	{
		redirect('/');
	}
}