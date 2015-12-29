<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Plant {

	var $CI = null;

	public function __construct()
    {
        // Do something with $params
    	$this->CI =& get_instance();
        // using model
		$this->CI->load->model('plant_model');
    }

    // ADMIN SIDE
    public function getAllPlant($condition = array(), $limit = null, $offset = null)
    {
		return $this->CI->plant_model->findWithRegion($condition, $limit, $offset)->result();
    }

    public function getSpesificPlant($condition = array(), $limit = null, $offset = null)
    {
    	return $this->CI->plant_model->findWithRegion($condition, $limit, $offset)->row();
    }

    public function updatePlant($data = array())
	{
		if (isset($data['id'])) {

			$result = $this->CI->plant_model->update(array('plant.id' => $data['id']), $data);

			if ($result['status']) {
				$text 		= 'Data plant baru berhasil diupdate';
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
				$text 		= 'Terjadi kesalahan pada saat mengupdate data plant.';
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
			$result = $this->CI->plant_model->insert($data);
			if ($result['status']) {
				$text 		= 'Data plant baru berhasil dimasukan';
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
				$text 		= 'Terjadi kesalahan pada saat memasukan data plant.';
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

	public function deletePlant($plantID = 0)
	{
		$result = $this->CI->plant_model->delete(array('plant.id' => $plantID));
		
		if ($result['status']) {
			$text 		= 'Data plant berhasil dihapus';
			$message 	= array(
				'status' 		=> 1, 
				'data' 			=> $plantID, 
				'text'			=> $text,
				'notification' 	=> '<div class="row">
							            <div class="col-lg-12">
							            	<div class="alert alert-success">
			                                	' . $text . '
			                            	</div>
			                            </div>
			                        </div>');
		} else {
			$text 		= 'Terjadi kesalahan pada penghapusan data plant.';
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
