<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Region {

	var $CI = null;

	public function __construct()
    {
        // Do something with $params
    	$this->CI =& get_instance();
        // using model
		$this->CI->load->model('region_model');
		$this->CI->load->model('wide_model');
    }

    // ADMIN SIDE
    public function getAllRegion($condition = array(), $limit = null, $offset = null)
    {
		return $this->CI->region_model->find($condition, $limit, $offset)->result();
    }

    public function getSpecificRegion($condition = array(), $limit = null, $offset = null)
	{
		return $this->CI->region_model->find($condition, $limit, $offset)->row();
	}

	public function updateRegion($data = array())
	{
		if (isset($data['id'])) {

			$result = $this->CI->region_model->update(array('region.id' => $data['id']), $data);

			if ($result['status']) {
				$text 		= 'Data daerah baru berhasil diupdate';
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
				$text 		= 'Terjadi kesalahan pada saat mengupdate data daerah.';
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
			$result = $this->CI->region_model->insert($data);
			if ($result['status']) {
				$text 		= 'Data daerah baru berhasil dimasukan';
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
				$text 		= 'Terjadi kesalahan pada saat memasukan data daerah.';
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

	public function deleteRegion($regionID = 0)
	{
		$result = $this->CI->region_model->delete(array('region.id' => $regionID));
		
		if ($result['status']) {
			$text 		= 'Data region berhasil dihapus';
			$message 	= array(
				'status' 		=> 1, 
				'data' 			=> $regionID, 
				'text'			=> $text,
				'notification' 	=> '<div class="row">
							            <div class="col-lg-12">
							            	<div class="alert alert-success">
			                                	' . $text . '
			                            	</div>
			                            </div>
			                        </div>');
		} else {
			$text 		= 'Terjadi kesalahan pada penghapusan data region.';
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

	public function getRegionWide($regionID)
	{
		return $this->CI->wide_model->findRegionWide(array('region_id' => $regionID))->row();
	}

	public function getJuruRegion($condition = array(), $limit = null, $offset = null)
	{
		$data = $this->CI->region_model->findRelRegion($condition);
		return $data->result();
		# code...
	}
	// END : ADMIN SIDE
}