<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Water {

	var $CI = null;

	public function __construct()
    {
        // Do something with $params
    	$this->CI =& get_instance();
        // using model
		$this->CI->load->model('water_model');
    }

    // ADMIN SIDE
    public function getAllWater($condition = array(), $conditionLike = array(), $limit = null, $offset = null)
    {
		return $this->CI->water_model->findLikeWithRegion($condition, $conditionLike, $limit, $offset)->result();
    }

    public function getSpecificWater($condition = array(), $limit = null, $offset = null)
	{
		return $this->CI->water_model->findWithRegion($condition, $limit, $offset)->row();
	}

	public function updateWater($data = array())
	{
		if (isset($data['id'])) {

			$result = $this->CI->water_model->update(array('water.id' => $data['id']), $data);

			if ($result['status']) {
				$text 		= 'Data debit air baru berhasil diupdate';
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
				$text 		= 'Terjadi kesalahan pada saat mengupdate data debit air.';
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
			$result = $this->CI->water_model->insert($data);
			if ($result['status']) {
				$text 		= 'Data debit air baru berhasil dimasukan';
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
				$text 		= 'Terjadi kesalahan pada saat memasukan data debit air.';
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

	public function deleteWater($waterID = 0)
	{
		$result = $this->CI->water_model->delete(array('water.id' => $waterID));
		
		if ($result['status']) {
			$text 		= 'Data debit air berhasil dihapus';
			$message 	= array(
				'status' 		=> 1, 
				'data' 			=> $waterID, 
				'text'			=> $text,
				'notification' 	=> '<div class="row">
							            <div class="col-lg-12">
							            	<div class="alert alert-success">
			                                	' . $text . '
			                            	</div>
			                            </div>
			                        </div>');
		} else {
			$text 		= 'Terjadi kesalahan pada penghapusan data debit air.';
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