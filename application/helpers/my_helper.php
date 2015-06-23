<?php 
// for checking user role cannot access some page
function checkUser($a, $b = null, $c = null, $d = null, $d = null) {
	$num = func_num_args();
	for ($i=0; $i < $num; $i++) { 
		$CI =& get_instance();
		if ($CI->session->userdata('logged_in')) {
			if ($CI->session->userdata('logged_in')['role_id'] != func_get_arg($i)) {
				redirect('dashboard');
			}
		}
		else
		{
			redirect('/');
		}
	}
}