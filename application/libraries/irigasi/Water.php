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
		$this->CI->load->model('allocation_model');
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
			$insertData = array(
				'year' 				=> date('Y'),
				'rice_growth_fase' 	=> $growth,
				'rice_mature_fase' 	=> $mature,
				'rice_harvest_face' => $harvest,
				'palawija' 			=> $palawija,
				'sugar' 			=> $sugar,
				'bero' 				=> $bero,
				'year' 				=> $this->CI->input->post('year'),
				'periode' 			=> $this->CI->input->post('periode'),
				'region_id' 		=> $regionID,
				'k_factor' 			=> $total,
				'result' 			=> $debitKeb,
				'update_at' 		=> date('Y-m-d H:i:s'),
			);

			$this->CI->allocation_model->save($insertData);
			return array('debit' => round($debitKeb), 'k_factor' => $total);
		} else {
			$insertData = array(
				'year' 				=> date('Y'),
				'rice_growth_fase' 	=> $growth,
				'rice_mature_fase' 	=> $mature,
				'rice_harvest_face' => $harvest,
				'palawija' 			=> $palawija,
				'sugar' 			=> $sugar,
				'bero' 				=> $bero,
				'year' 				=> $this->CI->input->post('year'),
				'periode' 			=> $this->CI->input->post('periode'),
				'region_id' 		=> $regionID,
				'k_factor' 			=> $total,
				'result' 			=> $debitKeb * $total,
				'update_at' 		=> date('Y-m-d H:i:s'),
			);
			$this->CI->allocation_model->save($insertData);
			return array('debit' => round($debitKeb * $total), 'k_factor' => $total);
		}
		
// ALTER TABLE `plan_plant` ADD `k_factor` FLOAT NOT NULL DEFAULT '0' AFTER `bero`, ADD `result` FLOAT NOT NULL DEFAULT '0' AFTER `k_factor`;
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
			'insert_date' 		=> date('Y-m-d H:i:s'),
			'update_at' 		=> date('Y-m-d H:i:s'),
			);

		$this->CI->allocation_model->save($insertData);
	}

	public function calcKinerja($planData)
	{
		$this->CI->load->model('water_model');
		$this->CI->load->model('allocation_model');
		$this->CI->load->library('irigasi/region');


		$allocationData = $this->CI->allocation_model->findOneYear($planData['year'], $planData['region_id'], $planData['start_month'])->result_array();
		$listDebitActual = array_map(function($e) {  
			return $e['avgDebit'];
		}, $this->CI->water_model->findOneYear($planData['year'] . '-' . $planData['start_month'] . '-01', $planData['region_id'], $planData['start_month'])->result_array());

		$listDebitRencana = $this->calculateAlokasi($listDebitActual, $allocationData);
		
		// $debitRencanaMt1 = array_slice($allocationData, 1);
		$rice = explode(',', $planData['rice']);
		$palawija = explode(',', $planData['palawija']);
		$sugar = explode(',', $planData['sugar']);
		$bero = explode(',', $planData['bero']);
		
		$predict = [
			[$rice[0], $palawija[0], $sugar[0], $bero[0]],
			[$rice[1], $palawija[1], $sugar[1], $bero[1]],
			[$rice[2], $palawija[2], $sugar[2], $bero[2]],
		];
		$current = $this->allocActual($allocationData, $planData['range']);

		$wide = $this->CI->region->getRegionWide($planData['region_id'])->total_wide;
		$month = date('n');
	    $day = date('j');

	    if($day < 16) {
	        $month = ($month * 2) - 2;
	    } else {
	        $month = ($month * 2) - 1;
	    }

		$Plan = $listDebitActual[$month];
		$Current = $listDebitRencana[$month];

		$totalActual1 = array_sum($current[0]); 
		$totalActual2 = array_sum($current[1]); 
		$totalActual3 = array_sum($current[2]); 

		$result = array();

		foreach ($current as $key => $value) {
			

			
			$ipp = array_sum($predict[$key]);
			$ipc = array_sum($current[$key]);
			$ip = $ipp/$ipc;
			// echo '<pre>' . print_r($ip,1) . '</pre>';

			$ippp = $predict[$key][0];
			$ippm = $current[$key][0];
			$padi = ($ippp == 0) ? 0 : $ippp/$ippm ;
			$intensitas = 100 * ($totalActual1 + $totalActual2 + $totalActual3) / $wide;
			// echo '<pre>' . print_r($padi,1) . '</pre>';
			// echo '<pre>' . print_r($intensitas,1) . '</pre>';
			$mt = [$ip, $padi, $intensitas];
			array_push($result, $mt);
		}

		return $result;
	}
	public function allocationYear($planData)
	{
		$this->CI->load->model('allocation_model');
		$this->CI->allocation_model->findOneYear($year, $regionID, $planData['start_month']);
	}
	public function calculateAlokasi($debitData='', $allocationData)
	{
		$this->CI->load->model('settings_model');
		$data = $this->CI->settings_model->getItem('constant')->row();
		$constant = unserialize($data->value);

		$collection = [];

		foreach ($allocationData as $key => $alloc) {
			$debitKeb = ($alloc['rice_growth_fase'] * $constant['rice'][1]) + 
						($alloc['rice_mature_fase'] * $constant['rice'][5]) + 
						($alloc['rice_harvest_face'] * $constant['rice'][7]) + 
						($alloc['palawija'] * $constant['palawija'][0]) + 
						($alloc['sugar'] * $constant['sugar'][0]) + 
						($alloc['bero'] * $constant['bero'][0]);
			$debitTersedia = $debitData[$key];
			$k_factor = $debitTersedia / (1.1 * $debitKeb);
			$debitRencana = ($k_factor >= 1) ? $debitKeb : ($k_factor * $debitKeb);
			array_push($collection, round($debitRencana));
		}
		return $collection;
	}

	public function allocActual($allocationData, $range)
	{
		$collection = ['rice' => [], 'palawija' => [], 'sugar' => [], 'bero' => []];
		$range = explode(',', $range);

		foreach ($allocationData as $key => $alloc) {
			array_push($collection['rice'], $alloc['rice_growth_fase'] + $alloc['rice_mature_fase'] + $alloc['rice_harvest_face']);
			array_push($collection['palawija'], $alloc['palawija']);
			array_push($collection['sugar'], $alloc['sugar']);
			array_push($collection['bero'], $alloc['bero']);
		}
	
		$length1 = (count(range($range[0] + 1, $range[1] + 1))) * 2;
		$length2 = (count(range($range[1] + 2 , $range[2] + 1))) * 2;
		$length3 = (count(range($range[2] + 1 , 11))) * 2;
	
		$tmpRiceMT1 = array_slice($collection['rice'], ($range[0] * 2), $length1);
		$tmpRiceMT2 = array_slice($collection['rice'], (($range[1] + 2) * 2), $length2);
		$tmpRiceMT3 = array_slice($collection['rice'], (($range[2] + 1) * 2), $length3);
		
		$tmpPalawijaMT1 = array_slice($collection['palawija'], $range[0] * 2, $length1);
		$tmpPalawijaMT2 = array_slice($collection['palawija'], $range[1] * 2, $length2);
		$tmpPalawijaMT3 = array_slice($collection['palawija'], $range[2] * 2, $length3);

		$tmpSugarMT1 = array_slice($collection['sugar'], $range[0] * 2, $length1);
		$tmpSugarMT2 = array_slice($collection['sugar'], $range[1] * 2, $length2);
		$tmpSugarMT3 = array_slice($collection['sugar'], $range[2] * 2, $length3);

		$tmpBeroMT1 = array_slice($collection['bero'], $range[0] * 2, $length1);
		$tmpBeroMT2 = array_slice($collection['bero'], $range[1] * 2, $length2);
		$tmpBeroMT3 = array_slice($collection['bero'], $range[2] * 2, $length3);

		$tmpRiceMT1 = $tmpRiceMT1 ? max($tmpRiceMT1) : null;
		$tmpRiceMT2 = $tmpRiceMT2 ? max($tmpRiceMT2) : null;
		$tmpRiceMT3 = $tmpRiceMT3 ? max($tmpRiceMT3) : null;

		$tmpPalawijaMT1 = $tmpPalawijaMT1 ? max($tmpPalawijaMT1) : null;
		$tmpPalawijaMT2 = $tmpPalawijaMT2 ? max($tmpPalawijaMT2) : null;
		$tmpPalawijaMT3 = $tmpPalawijaMT3 ? max($tmpPalawijaMT3) : null;

		$tmpSugarMT1 = $tmpSugarMT1 ? max($tmpSugarMT1) : null;
		$tmpSugarMT2 = $tmpSugarMT2 ? max($tmpSugarMT2) : null;
		$tmpSugarMT3 = $tmpSugarMT3 ? max($tmpSugarMT3) : null;

		$tmpBeroMT1 = $tmpBeroMT1 ? max($tmpBeroMT1) : null;
		$tmpBeroMT2 = $tmpBeroMT2 ? max($tmpBeroMT2) : null;
		$tmpBeroMT3 = $tmpBeroMT3 ? max($tmpBeroMT3) : null;

		return array(
				[$tmpRiceMT1, $tmpPalawijaMT1, $tmpSugarMT1, $tmpBeroMT1],
				[$tmpRiceMT2, $tmpPalawijaMT2, $tmpSugarMT2, $tmpBeroMT2],
				[$tmpRiceMT3, $tmpPalawijaMT3, $tmpSugarMT3, $tmpBeroMT3],
			);
	}

	public function avgAct($planData)
	{
		$this->CI->load->model('water_model');
		$this->CI->load->model('allocation_model');
		$this->CI->load->library('irigasi/region');

		$allocationData = $this->CI->allocation_model->findOneYear($planData['year'], $planData['region_id'], $planData['start_month'])->result_array();
		$listDebitActual = array_map(function($e) {  
			return $e['avgDebit'];
		}, $this->CI->water_model->findOneYear($planData['year'] . '-' . $planData['start_month'] . '-01', $planData['region_id'], $planData['start_month'])->result_array());

		$listDebitRencana = $this->calculateAlokasi($listDebitActual, $allocationData);
		
		$range = explode(',', $planData['range']);

		$length1 = (count(range($range[0] + 1, $range[1] + 1))) * 2;
		$length2 = (count(range($range[1] + 2 , $range[2] + 1))) * 2;
		$length3 = (count(range($range[2] + 1 , 11))) * 2;
		
		$actualMT1 = array_slice($listDebitActual, ($range[0] * 2), $length1);
		$actualMT2 = array_slice($listDebitActual, (($range[1] + 2) * 2), $length2);
		$actualMT3 = array_slice($listDebitActual, (($range[2] + 1) * 2), $length3);
		
		$rencanaMT1 = array_slice($listDebitRencana, ($range[0] * 2), $length1);
		$rencanaMT2 = array_slice($listDebitRencana, (($range[1] + 2) * 2), $length2);
		$rencanaMT3 = array_slice($listDebitRencana, (($range[2] + 1) * 2), $length3);

		$avgActMT1 = array_sum($actualMT1)/ count($actualMT1);
		$avgActMT2 = array_sum($actualMT2)/ count($actualMT2);
		$avgActMT3 = array_sum($actualMT3)/ count($actualMT3);

		$avgRencMT1 = array_sum($rencanaMT1)/ count($rencanaMT1);
		$avgRencMT2 = array_sum($rencanaMT2)/ count($rencanaMT2);
		$avgRencMT3 = array_sum($rencanaMT3)/ count($rencanaMT3);		
		
		return [
			'actual' => [round($avgActMT1), round($avgActMT2), round($avgActMT3)], 
			'rencana' => [round($avgRencMT1), round($avgRencMT2), round($avgRencMT3)],
			];
	}

	public function indexDebitPeriode($planData='')
	{
		$this->CI->load->model('allocation_model');
		$this->CI->load->model('water_model');

		$allocationData = $this->CI->allocation_model->findOneYear($planData['year'], $planData['region_id'], $planData['start_month'])->result_array();
		$listDebitActual = array_map(function($e) {  
			return $e['avgDebit'];
		}, $this->CI->water_model->findOneYear($planData['year'] . '-' . $planData['start_month'] . '-01', $planData['region_id'], $planData['start_month'])->result_array());

		$listDebitRencana = $this->calculateAlokasi($listDebitActual, $allocationData);
		$range = explode(',', $planData['range']);
		$monthList = range(0, 23);

		$length1 = (count(range($range[0] + 1, $range[1] + 1))) * 2 + 1;
		$length2 = (count(range($range[1] + 2 , $range[2] + 1))) * 2;
		$length3 = (count(range($range[2] + 1 , 11))) * 2;

		$key = array_search($planData['start_month'], array_keys($monthList));
		$output1 = array_slice($monthList, $key); 
		$output2 = array_slice($monthList, 0, $key); 
		$newMonthList = array_merge($output1, $output2);
		
		$MT1 = array_slice($newMonthList, ($range[0] * 2), $length1);
		$MT2 = array_slice($newMonthList, (($range[1] + 2) * 2 - 1), $length2);
		$MT3 = array_slice($newMonthList, (($range[2] + 1) * 2 - 1), $length3);

		$month = date('n');
        $day = date('j');
		if($day < 16) {
            $month = ($month * 2) - 2 - 1;
        } else {
            $month = ($month * 2) - 1 - 1;
        }

        $kinerja = $this->calcKinerja($planData);

        $result = [];
        if (in_array($month, $MT1)) {
        	$result['mt'] = 1;
        	$result['data'] = $kinerja[0];
        	$result['index_debit'] = $listDebitActual[$month] / $listDebitRencana[$month];
        } elseif (in_array($month, $MT2)) {
        	$result['mt'] = 2;
        	$result['data'] = $kinerja[1];
        	$result['index_debit'] = $listDebitActual[$month] / $listDebitRencana[$month];
        } elseif (in_array($month, $MT3)) {
        	$result['mt'] = 3;
        	$result['data'] = $kinerja[2];
        	$result['index_debit'] = $listDebitActual[$month] / $listDebitRencana[$month];
        } 

        return $result;
	}
	// END : ADMIN SIDE
}