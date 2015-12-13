<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class User {

	var $CI = null;

	public function __construct()
    {
        // Do something with $params
    	$this->CI =& get_instance();
        // using model
		$this->CI->load->model('user_model');
		$this->CI->load->model('role_model');
    }

    

    public function authentication($username, $password, $remember)
	{
		//query the database
		$result = $this->CI->user_model->login($username, $password);

		if($result)
		{
			$this->CI->session->set_userdata('logged_in', $result, $remember);
			return TRUE;
		}
		else
		{
			$this->CI->session->set_flashdata('invalid', '<div class="alert alert-danger"> Invalid <b>username</b> or <b>password</b>. </div>');
			return false;
		}
	}

	public function getAllUser($condition = array(), $limit = null, $offset = null)
	{
		return $this->CI->user_model->findWithRole($condition, $limit, $offset)->result();
	}

	public function getSpecificUser($condition = array(), $limit = null, $offset = null)
	{
		return $this->CI->user_model->findWithRole($condition, $limit, $offset)->row();
	}

	public function updateUser($data = array())
	{
		if (isset($data['id'])) {

			$result = $this->CI->user_model->update(array('user.id' => $data['id']), $data);

			if ($result['status']) {
				$text 		= 'Data user baru berhasil diupdate';
				$message 	= array(
					'status' 		=> 1, 
					'data' 			=> '', 
					'text'			=> $text,
					'notification' 	=> '<div class="row">
								            <div class="col-lg-12">
								            	<div class="alert alert-success">
				                                	' . $text . '
				                            	</div>
				                            </div>
				                        </div>');
			} else {
				$text 		= 'Terjadi kesalahan pada saat mengupdate data user.';
				$message 	= array(
					'status' 		=> 0, 
					'data' 			=> '', 
					'text '			=> $text,
					'notification' 	=> '<div class="row">
								            <div class="col-lg-12">
								                <div class="alert alert-danger">
								                    ' . $text . '
								                </div>
								            </div>
								        </div>');
			}
		} else {
			$result = $this->CI->user_model->insert($data);
			if ($result['status']) {
				$text 		= 'Data user baru berhasil dimasukan';
				$message 	= array(
					'status' 		=> 1, 
					'data' 			=> '', 
					'text'			=> $text,
					'notification' 	=> '<div class="row">
								            <div class="col-lg-12">
								            	<div class="alert alert-success">
				                                	' . $text . '
				                            	</div>
				                            </div>
				                        </div>');
			} else {
				$text 		= 'Terjadi kesalahan pada saat memasukan data user.';
				$message 	= array(
					'status' 		=> 0, 
					'data' 			=> '', 
					'text '			=> $text,
					'notification' 	=> '<div class="row">
								            <div class="col-lg-12">
								                <div class="alert alert-danger">
								                    ' . $text . '
								                </div>
								            </div>
								        </div>');
			}
		}
		
		
		
    	
    	$this->CI->session->set_flashdata('message', $message);

    	return $result['status'];
	}

	public function deleteUser($userID = 0)
	{
		$result = $this->CI->user_model->delete(array('user.id' => $userID));
		
		if ($result['status']) {
			$text 		= 'Data user berhasil dihapus';
			$message 	= array(
				'status' 		=> 1, 
				'data' 			=> $userID, 
				'text'			=> $text,
				'notification' 	=> '<div class="row">
							            <div class="col-lg-12">
							            	<div class="alert alert-success">
			                                	' . $text . '
			                            	</div>
			                            </div>
			                        </div>');
		} else {
			$text 		= 'Terjadi kesalahan pada penghapusan data user.';
			$message 	= array(
				'status' 		=> 0, 
				'data' 			=> '', 
				'text '			=> $text,
				'notification' 	=> '<div class="row">
							            <div class="col-lg-12">
							                <div class="alert alert-danger">
							                    ' . $text . '
							                </div>
							            </div>
							        </div>');
		}
    	
    	$this->CI->session->set_flashdata('message', $message);

    	return $result['status'];
	}
}

/* End of file User.php */