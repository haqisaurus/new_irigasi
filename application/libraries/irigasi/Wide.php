<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Wide {

	var $CI = null;

	public function __construct()
    {
        // Do something with $params
    	$this->CI =& get_instance();
        // using model
		$this->CI->load->model('wide_model');
    }

    // ADMIN SIDE
    public function getAllWide($condition = array(), $limit = null, $offset = null)
    {
		return $this->CI->wide_model->findWithRegion($condition, $limit, $offset)->result();
    }

    public function getSpecificWide($condition = array(), $limit = null, $offset = null)
	{
		return $this->CI->wide_model->findWithRegion($condition, $limit, $offset)->row();
	}

	public function updateWide($data = array())
	{
		if (isset($data['id'])) {

			$result = $this->CI->wide_model->update(array('wide.id' => $data['id']), $data);

			if ($result['status']) {
				$text 		= 'Data luas baru berhasil diupdate';
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
				$text 		= 'Terjadi kesalahan pada saat mengupdate data luas.';
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
			$result = $this->CI->wide_model->insert($data);
			if ($result['status']) {
				$text 		= 'Data luas baru berhasil dimasukan';
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
				$text 		= 'Terjadi kesalahan pada saat memasukan data luas.';
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

	public function deleteWide($wideID = 0)
	{
		$result = $this->CI->wide_model->delete(array('wide.id' => $wideID));
		
		if ($result['status']) {
			$text 		= 'Data luas berhasil dihapus';
			$message 	= array(
				'status' 		=> 1, 
				'data' 			=> $wideID, 
				'text'			=> $text,
				'notification' 	=> '<div class="row">
							            <div class="col-lg-12">
							            	<div class="alert alert-success">
			                                	' . $text . '
			                            	</div>
			                            </div>
			                        </div>');
		} else {
			$text 		= 'Terjadi kesalahan pada penghapusan data luas.';
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
	// END : ADMIN SIDE
}