<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
// yrl?fwtfL6uO


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

    public function getAllWaterASC($condition = array(), $conditionLike = array(), $limit = null, $offset = null)
    {
		return $this->CI->water_model->findLikeWithRegionASC($condition, $conditionLike, $limit, $offset)->result();
    }

    public function getSpecificWater($condition = array(), $limit = null, $offset = null)
	{
		return $this->CI->water_model->findWithRegion($condition, $limit, $offset)->row();
	}

	public function getAllYear($condition = array())
	{
		return $this->CI->water_model->findYear($condition)->result();
	}

	public function updateWater($data = array())
	{
		$checkData = $this->getSpecificWater(array('date' => $data['date']));
		
		if ($checkData) {

			unset($data['id']);

			$result = $this->CI->water_model->update(array('water.date' => $data['date']), $data);

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

	public function newAndalan($regionID = 1, $monthStart = 1)
	{
		$data = array();
		$table = array();
		$dataCollection = array();

		$queryYear = array('region_id' => $regionID);
		$allYears = $this->CI->water_model->findYear($queryYear)->row();

		$year = $allYears->tahun;

		$startDay = '1-' . $monthStart . '-2015';
		$start = $month = strtotime($startDay);
		$end = strtotime('+11 month', $start);

		while($month <= $end) {
			// echo date('F', $month);
			$condition1 = ' region_id = ' . $regionID . ' and month(date) = ' . date('m', $month) . ' and dayofmonth( `date` ) < 16';
			$datas1 = $this->CI->water_model->intake($condition1)->result_array();
			$dataCollection[] = $datas1;

			$condition2 = ' region_id = ' . $regionID . ' and month(date) = ' . date('m', $month) . ' and dayofmonth( `date` ) >= 16';
			$datas2 = $this->CI->water_model->intake($condition2)->result_array();
			$dataCollection[] = $datas2;

			$month = strtotime("+1 month", $month);
		}

		$coloumnAndalan = (int) (0.8 * ($this->CI->water_model->findYear($queryYear)->num_rows() + 1)) - 1; //because coloumn start with 0 in computer
		$result = array();
		
		foreach ($dataCollection as $key => $data) {
			$result[] = $data[$coloumnAndalan]['intake'];
		}

		return $result;

	}

	// water demand
	public function getDataWaterDemand($year = null)
	{
		$this->CI->load->model('plant_model');

		$year = isset($year) ? : date('Y');

		$startMonth = '1-11-' . ($year - 1);
		$start = $month = strtotime($startMonth);
		$end = strtotime("+11 month", $start);

		$condition = array(
			'start >=' => date('Y-m-d', $start),
			'start <=' => date('Y-m-d', $end),
			// 'region_id' => 1
			);

		$data = $this->CI->plant_model->find($condition)->result();

		$result = array_map(function($item) {
			
			$month = strtotime($item->start);

			$newData = array(
				
				'month' => date('F', $month),
				'demand' => (($item->rice * 0.75) + ($item->palawija * 0.3) + ($item->sugar * 0.85) + ($item->bero * 0)) * 0.01,
				'irigasi' => ((($item->rice * 0.75) + ($item->palawija * 0.3) + ($item->sugar * 0.85) + ($item->bero * 0)) * 0.01) * 1.2,
				);

			return $newData;
		}, $data);
		
		return $result;
	}

	public function planData($regionID, $year, $startMonth, $range, $padi, $palawija, $tebu, $bero) 
	{
		$this->CI->load->model('settings_model');

		
		array_splice($range, 0, 1);
		$range =  array_map(function($el) { return $el * 2; }, $range);

		$irigasiNeed = 1.2;

		$data = $this->CI->settings_model->getItem('constant')->row();
		$constant = unserialize($data->value);
		
		$multiplyConstant['rice'] = array_merge($constant['rice'], $constant['rice'], $constant['rice']);
		$multiplyConstant['palawija'] = array_merge($constant['palawija'], $constant['palawija'], $constant['palawija']);
		$multiplyConstant['sugar'] = array_merge($constant['sugar'], $constant['sugar'], $constant['sugar']);
		$multiplyConstant['bero'] = array_merge($constant['bero'], $constant['bero'], $constant['bero']);
	
		$key = 0;
		$resultTMP = array();
		for ($i=0; $i < 24; $i++) { 
			if (in_array($i, $range)) $key++;
			
			$rsltMT[] = (($padi[$key] * $multiplyConstant['rice'][$i]) + ($palawija[$key] * $multiplyConstant['palawija'][$i]) + ($tebu[$key] * $multiplyConstant['sugar'][$i]) + ($bero[$key] * $multiplyConstant['bero'][$i]));			
			
		}
		
		$startDay 	=  '1-' . $startMonth . '-' . $year;
		$start 		= $month = strtotime($startDay);
		$end 		= strtotime('+11 month', $start);
		$n 			= 0;
		$result 	= array();

		while($month <= $end) {
			
			$result[date('F', $month) . ' 1'] = array_shift($rsltMT);
			$result[date('F', $month) . ' 2'] = array_shift($rsltMT);
			
			$month = strtotime("+1 month", $month);
			$n++;
		}
		
		return $result;
	}

	// SELECT * FROM water WHERE date > ((SELECT MAX(date) FROM water) - INTERVAL 15 day) and region_id = 1
	public function allocation($regionID = 1, $growth = 0, $mature = 0, $harvest = 0, $palawija = 0, $sugar = 0, $bero = 0)
	{
		$this->CI->load->model('settings_model');
		$this->CI->load->model('water_model');
		$data = $this->CI->settings_model->getItem('constant')->row();
		$constant = unserialize($data->value);
		
	
		
	   	$debit = $this->CI->water_model->lastMonthDebit($regionID);

		$debitKeb = 	($growth * $constant['rice'][1]) + 
					($mature * $constant['rice'][5]) + 
					($harvest * $constant['rice'][7]) + 
					($palawija * $constant['palawija'][0]) + 
					($sugar * $constant['sugar'][0]) + 
					($bero * $constant['bero'][0]);

		$total = ($debitKeb) ? $debit / ($debitKeb * 1.1) : 0;

		if ($total >= 1) {
			return round($debitKeb);
		} else {
			return round($debitKeb * $total);
		}
		
	}

	public function saveAllocationData($data)
	{
		$this->CI->load->model('allocation_model');

		$insertData = array(
			'region_id' 		=> $data->region_id,
			'periode' 			=> $data->periode,
			'year' 				=> date('Y'),
			'rice_growth_fase' 	=> $data->growth,
			'rice_mature_fase' 	=> $data->mature,
			'rice_harvest_face' => $data->harvest,
			'palawija' 			=> $data->palawija,
			'sugar' 			=> $data->sugar,
			'bero' 				=> $data->bero,
			);

		$this->CI->allocation_model->save($insertData);
	}

	// END : ADMIN SIDE
}