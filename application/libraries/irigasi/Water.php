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

	public function getDataAndalan($regionID = null, $monthStart = 1)
	{
		$this->CI->load->model('region_model');

		$data = array();
		$table = array();
		$dataCollection = array();

		$region = $this->CI->region_model->find()->row();
		$regionID = $regionID?: $region->id;

		$queryYear = $region ? array('region_id' => $regionID) : array();
		$allYears = $this->CI->water_model->findYear($queryYear)->result();

		$year = $allYears[0]->tahun;

		$startDay = '1-' . $monthStart . '-2015';
		$start = $month = strtotime($startDay);
		$end = strtotime('+11 month', $start);

		while($month <= $end) {
			
			$dataCollection[date('F', $month)] = array();

			// collecting first half of month
			$coloumn1 = array();
			// collecting second half of month
			$coloumn2 = array();

			// ============= FROM FIRST MONTH UNTIL HALF MONTH ===========
			foreach ($allYears as $key => $value1) {

				$startFirst = strtotime($value1->tahun . '-' .  date('F', $month) . '-1' );
				$endFirst = strtotime('+14 day',  $startFirst);
			
				// define half 
				$half1 = array(	
								date('Y-m-d', $startFirst), 
								date('Y-m-d', $endFirst), 
								$regionID
							);

				array_push($coloumn1, $this->CI->water_model->debitIntake($half1)->row());
			}

			// =========== HALF UNTIL LAST =================
			foreach ($allYears as $key => $value2) {

				$startSecond = strtotime('+1 day',  strtotime($value2->tahun . '-' . date('m-d', $endFirst)));
				$endSecond = strtotime('last day of',  strtotime($value2->tahun . '-' . date('m-d', $endFirst)));

				$half2 = array(
								date('Y-m-d', $startSecond), 
								date('Y-m-d', $endSecond), 
								$regionID
							);

				array_push($coloumn2, $this->CI->water_model->debitIntake($half2)->row());
			}


			array_push($dataCollection[date('F', $month)], $coloumn1);
			array_push($dataCollection[date('F', $month)], $coloumn2);

			$month = strtotime("+1 month", $month);
		}
		// echo "<pre>" . print_r($dataCollection, 1) . "</pre>";
		// ======================================================================================================
		$result = array();

		$coloumnAndalan = round(0.8 * (count($allYears) + 1)) - 1; //because coloumn start with 0 in computer
       	
       	// echo $coloumnAndalan;
       	foreach ($dataCollection as $key => $bulan) {

            $intakeCollection = array();

        	foreach ($bulan as $key => $setBulan) {

        		$intakeCollection = array_map(function($obj) { 

        			$intake = empty($obj) ? 1110 : $obj->intake;
        			return round($intake, 4);

        		}, $setBulan);

        		rsort($intakeCollection);
        		$andalanVal = isset($intakeCollection[$coloumnAndalan]) ? $intakeCollection[$coloumnAndalan] : min($intakeCollection);
            	
            	array_push($result, $andalanVal);
        	}
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
				// 'start' => $item->start,
				// 'end' => $item->end,
				// 'rice' => $item->rice * 0.75,
				// 'palawija' => $item->palawija * 0.3,
				// 'sugar' => $item->sugar * 0.85,
				// 'bero' => $item->bero,
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

		// $regionID 	= 1;
		// $year 		= 2015;
		// $startMonth = 11;
		// $range 		= [3,7,11];

		// $padi 		= array(400, 300, 200);
		// $palawija 	= array(200, 400, 100);
		// $tebu 		= array(100, 500, 200);
		// $bero 		= array(0, 0, 0);
		array_splice($range, 0, 1);

		$WaterNeed = 0.01;
		$irigasiNeed = 1.2;

		$rsltMT1 = 0;
		$rsltMT2 = 0;
		$rsltMT3 = 0;

		$rsltMT1 = ((($padi[0] * 0.75) + ($palawija[0] * 0.3) + ($tebu[0] + 0.85) + ($bero[0] * 0)) * 0.01);
		$rsltMT2 = ((($padi[1] * 0.75) + ($palawija[1] * 0.3) + ($tebu[1] + 0.85) + ($bero[1] * 0)) * 0.01);
		$rsltMT3 = ((($padi[2] * 0.75) + ($palawija[2] * 0.3) + ($tebu[2] + 0.85) + ($bero[2] * 0)) * 0.01);


		$resultAllMT = array(
				array(
					'water-demand' => $rsltMT1,
					'water-irigasi' => $rsltMT1 * $irigasiNeed,
					),
				array(
					'water-demand' => $rsltMT2,
					'water-irigasi' => $rsltMT2 * $irigasiNeed,
					),
				array(
					'water-demand' => $rsltMT3,
					'water-irigasi' => $rsltMT3 * $irigasiNeed,
					),
			);
		
		$startDay 	=  '1-' . $startMonth . '-' . $year;
		$start 		= $month = strtotime($startDay);
		$end 		= strtotime('+11 month', $start);
		$n 			= 0;
		$key 		= 0;
		$result 	= array();
		
		while($month <= $end) {
			
			$data1 = array(
				'month' 	=> date('F', $month) . ' 1',
				'data' 		=> $resultAllMT[$key],
				);
			$data2 = array(
				'month' 	=> date('F', $month) . ' 2',
				'data' 		=> $resultAllMT[$key],
				);

			array_push($result, $data1, $data2);
			// echo $key;
			if($key < 2 && $n == $range[$key]) $key++;

			$month = strtotime("+1 month", $month);
			$n++;
		}
		
		return $result;
	}
	// END : ADMIN SIDE
}