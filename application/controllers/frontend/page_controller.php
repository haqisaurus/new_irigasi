<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_controller extends CI_Controller {

	var $template = array();
	var $limit = 20;

	public function __construct()
	{
		parent::__construct();
		// using model
		$this->load->model('water_model');
		$this->load->model('region_model');
		$this->load->model('plant_model');
		
		//Do your magic here
		$data['region'] = $this->region_model->find()->result();
		$this->template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
		$this->template['sideBar'] = $this->load->view('frontend/part/nav-right', $data, true);

	}

	public function index($offset = null)
	{

		$data = array();
		$offset = $offset ?  $this->uri->segment(2) : 0;

		$this->template['content'] = $this->load->view('frontend/pages/home', $data, true);
		$this->load->view('frontend/master', $this->template);
	}

	public function dataRegion($id='')
	{
		$data = array();
		$data['wides'] = $this->region_model->regionWithWide(array('region.id' => $id))->result();
		$data['totalWide'] = $this->region_model->regionWithTotalWide(array('region.id' => $id))->row();

		$this->template['content'] = $this->load->view('frontend/pages/data-region', $data, true);
		$this->load->view('frontend/master', $this->template);
	}

	/***********************************************/
	/** haqisaurus 8/2/2015 11:57:31 AM: end disabled **/
	/***********************************************/
	// NEW DATA TABLE 
	// public function dataWater($id='')
	// {
	// 	$data['regions'] = $this->region_model->find()->result();

	// 	$qMonth = $this->input->post('month')?: '01';
	// 	$qRegion = $this->input->post('region')?: $data['regions'][0]->id;

	// 	$data['qMonth'] = $qMonth ? : '';
	// 	$data['qRegion'] = $qRegion ? : '';
	// 	$data['table'] = $this->generateTable($data['qMonth'], $data['qRegion']);

	// 	$this->template['content'] = $this->load->view('frontend/pages/data-water', $data, true);
	// 	$this->load->view('frontend/master', $this->template);
	// }

	// public function generateTable($month, $region)
	// {
	// 	$dayCount = cal_days_in_month(CAL_GREGORIAN, $month, 2000);

	// 	$years = $this->water_model->findYear(array('region_id' => $region))->result();
	// 	$table = '<table style="width: 5000px">';

	// 	// header table`
	// 	$time = strtotime(2000 . '-' . $month . '-01');
	// 	$fMonth = date("F", $time);
	// 	$table .= '<tr>
	// 					<th rowspan="2"style="width: 70px;text-align: center"> Tahun </th>
	// 					<th colspan="15">' .$fMonth. ' pertama </th>
	// 					<th colspan="' .($dayCount-15). '"> ' .$fMonth. ' kedua </th>
	// 				</tr>';
	// 	$table .= '<tr>';
	// 	for ($i=1; $i <= $dayCount; $i++) { 
	// 			$table .= '<th style="text-align: center">Hari ' . $i . '</th>';
	// 	}
	// 	$table .= '</tr>';
		
	// 	// data table 
	// 	foreach ($years as $key => $year) {
	// 		$table .= '<tr>';
	// 		$table .= $this->generateTD($month, $year->tahun, $region);
	// 		$table .= '</tr>';
	// 	}

	// 	$table .= '</table>';
	// 	return $table;
	// }

	// public function generateTD($month, $year, $region)
	// {
	// 	$dayCount = cal_days_in_month(CAL_GREGORIAN, $month, 2000);

		
	// 	$startDate = $year . '-' . $month . '-01';
	// 	$endDate = $year . '-' . $month . '-' . $dayCount;
	// 	$nextDate = $startDate;

	// 	$td = '<td>' . $year . '</td>';
	// 	while(strtotime($nextDate) <= strtotime($endDate))
	// 	{
	// 		if ($year > 1000) {
	// 			$query = $this->water_model->find(array('date'=> $nextDate, 'region_id' => $region));
	// 			$dataWater = $query->row();
	// 			if ($query->num_rows() && (date("m",  strtotime($nextDate)) == $month)) {
	// 				$td .= "<td><a href='" . base_url('data-detail/' . $dataWater->id) . "'>" . "Kanan : " .  $dataWater->right . " | Kiri : " . $dataWater->left . " | Limpas : " . $dataWater->limpas . "</a></td>";
	// 			} else {
	// 				$td .= "<td> none </td>";

	// 			}
	// 		}

	// 		$nextDate = date("Y-m-d", strtotime("+1 day", strtotime($nextDate)));
	// 	}

	// 	return $td;
	// }
	/***********************************************/
	/** haqisaurus 8/2/2015 11:57:31 AM: end disabled **/
	/***********************************************/


	// data table 7-6-2015
	public function dataWater($id='')
	{
		checkUser(array(1, 2));

		date_default_timezone_set('UTC');


		$data['regions'] = $this->region_model->find()->result();
		$queryYear = $data['regions'] ? array('region_id' => $data['regions'][0]->id) : array();
		$data['years'] = $this->water_model->findYear($queryYear)->result();

		$qMonth = $this->input->post('month')?: '01';
		$qYear = $this->input->post('year')?: $data['years'][0]->tahun;
		$qRegion = $this->input->post('region')?: $data['regions'][0]->id;

		$data['qMonth'] = $qMonth ? : '';
		$data['qYear'] = $qYear ? : '';
		$data['qRegion'] = $qRegion ? : '';

		$query = array(
			'YEAR(date)' => $data['qYear'],
			'MONTH(date)' => $data['qMonth'],
			'region_id' => $data['qRegion'],
			);

		$table['table'] = $this->water_model->findASCDate($query)->result();

		$data['table'] = $this->load->view('frontend/part/table', $table, true);
		$this->template['content'] = $this->load->view('frontend/pages/data-water', $data, true);
		$this->load->view('frontend/master', $this->template);
	}

	private function dataTD($countDate, $month, $year, $id)
	{
		$dataTD = '';

		for ($i=1; $i <= $countDate; $i++) { 

			if ($year > 1000) {
				$day = $year . '-' . $month . '-' . $i;
				$data = $this->water_model->find(array('date'=> $day, 'region_id' => $id), 1, 0);
				$dataWater = $data->row();
				if ($data->num_rows()) {
					$dataTD .= "<td><a href='" . base_url('data-detail/' . $dataWater->id) . "'>" . "Kanan : " .  $dataWater->right . " <br> Kiri : " . $dataWater->left . " <br> Limpas : " . $dataWater->limpas . "</a></td>";
				} else {
					$dataTD .= "<td class='none'> none </td>";

				}
			}
		}

		return $dataTD;
	}
	// END: data table 7-6-2015
	public function inputWater()
	{
		checkUser(array(1, 2));

		$data = array();
		$data['regions'] = $this->region_model->find()->result();

		$this->template['content'] = $this->load->view('frontend/pages/data-entri', $data, true);
		$this->load->view('frontend/master', $this->template);
	}

	public function doInputWater()
	{
		checkUser(array(1, 2));

		$regionID = $this->input->post('region-id');
		$date = $this->input->post('date');
		$left = $this->input->post('left');
		$right = $this->input->post('right');
		$limpas = $this->input->post('limpas');
		

		$this->form_validation->set_rules('region-id', 'Nama daerah', 'trim|required|xss_clean');
		$this->form_validation->set_rules('date', 'Tanggal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('left', 'Kanan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('right', 'Kiri', 'trim|required|xss_clean');
		$this->form_validation->set_rules('limpas', 'Limpas', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$data = array();
			$data['regions'] = $this->region_model->find()->result();
			$data['region_id'] = $regionID;
			$this->template['content'] = $this->load->view('frontend/pages/data-entri', $data, true);
			$this->load->view('frontend/master', $this->template);
		}
		else
		{
			$data = array(
				'region_id' => $regionID,
				'date' => $date,
				'left' => $left,
				'right' => $right,
				'limpas' => $limpas,
				);

			$result = $this->water_model->insert($data);

			if ($result['status']) {
				$message = array('status' => 1, 'data' => $result['id'], 'msg' => 'Data berhasil dimasukan');
			} else {
				$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
			}
        	
        	$this->session->set_flashdata('message', $message);

			redirect('entri-water');
		}
	}

	public function editWater($id='')
	{
		checkUser(array(1, 2));

		$data = array();
		$data['regions'] = $this->region_model->find()->result();
		$data['update'] = $this->water_model->findWithRegion(array('water.id' => $id), 1, 0)->row();
		$this->template['content'] = $this->load->view('frontend/pages/data-edit', $data, true);
		$this->load->view('frontend/master', $this->template);
	}

	public function doEditWater()
	{
		checkUser(array(1, 2));

		$id = $this->input->post('id');
		$regionID = $this->input->post('region-id');
		$date = $this->input->post('date');
		$left = $this->input->post('left');
		$right = $this->input->post('right');
		$limpas = $this->input->post('limpas');
		

		$this->form_validation->set_rules('region-id', 'Nama daerah', 'trim|required|xss_clean');
		$this->form_validation->set_rules('date', 'Tanggal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('left', 'Kanan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('right', 'Kiri', 'trim|required|xss_clean');
		$this->form_validation->set_rules('limpas', 'Limpas', 'trim|required|xss_clean');


		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$data = array();
			$data['update'] = $this->water_model->find(array('water.id' => $id))->row();
			$this->template['content'] = $this->load->view('backend/pages/water/update', $data, true);
			$this->load->view('backend/master', $this->template);
		}
		else
		{
			$data = array(
				'region_id' => $regionID,
				'date' => $date,
				'left' => $left,
				'right' => $right,
				'limpas' => $limpas,
				);


			$result = $this->water_model->update(array('water.id' => $id), $data);

			if ($result['status']) {
				$message = array('status' => 1, 'data' => $result['id'], 'msg' => 'Data berhasil diperbarui');
			} else {
				$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
			}
        	
        	$this->session->set_flashdata('message', $message);

			redirect('data-water');
		}

	}
	public function dataDetail($id)
	{
		$dataWater = $this->water_model->findWithRegion(array('water.id'=> $id))->row();
		$data = array();
		$data['detail'] = $dataWater;
		$this->template['content'] = $this->load->view('frontend/pages/data-detail', $data, true);
		$this->load->view('frontend/master', $this->template);
	}

	public function showLogin()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('account-detail');
		} else {
			$data = array();

			$this->template['content'] = $this->load->view('frontend/pages/login', $data, true);
			$this->load->view('frontend/master', $this->template);
		}
	}

	public function accountDetail()
	{
		checkUser(array(1, 2));

		$data = array();

		$this->template['content'] = $this->load->view('frontend/pages/account-detail', $data, true);
		$this->load->view('frontend/master', $this->template);
	}

	// plant suggesion page 

	public function plantView()
	{
		checkUser(array(1, 2));

		$data = array();
		$condition = array();
		$data['table'] = $this->plant_model->find($condition)->result();

		$this->template['content'] = $this->load->view('frontend/pages/plant-view', $data, true);
		$this->load->view('frontend/master', $this->template);	
	}

	public function plantEdit($id = 0)
	{
		checkUser(array(1, 2));

		$data = array();
		$condition = array('id' => $id);
		$data['update'] = $this->plant_model->find($condition)->row();

		$this->template['content'] = $this->load->view('frontend/pages/plant-edit', $data, true);
		$this->load->view('frontend/master', $this->template);	
	}

	public function plantUpdate()
	{
		checkUser(array(1, 2));

		$id = $this->input->post('id');
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$period = $this->input->post('period');

		$rice = $this->input->post('rice');
		$palawija = $this->input->post('palawija');
		$sugar = $this->input->post('sugar');

		$this->form_validation->set_rules('year', 'Tahun', 'trim|required|xss_clean');
		$this->form_validation->set_rules('period', 'Pediode', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$data = array();
			$condition = array('id' => $id);

			$data['update'] = $this->plant_model->find($condition)->row();

			$this->template['content'] = $this->load->view('frontend/pages/plant-edit', $data, true);
			$this->load->view('frontend/master', $this->template);
		}
		else
		{
			$data = array(
				'year' => $year . ' ' . $month . ' ' . $period,
				'rice' => $rice,
				'palawija' => $palawija,
				'sugar' => $sugar,
				);

			$condition = array('id' => $id);

			$result = $this->plant_model->update($condition, $data);

			if ($result['status']) {
				$message = array('status' => 1, 'data' => $result['id'], 'msg' => 'Data berhasil dimasukan');
			} else {
				$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
			}
        	
        	$this->session->set_flashdata('message', $message);

			redirect('plant-view');
		}
	}

	public function plant()
	{
		$data = array();
		$data['regions'] = $this->region_model->find()->result();
		$data['wide'] = $this->region_model->find()->result();

		$this->template['content'] = $this->load->view('frontend/pages/plant-entri', $data, true);
		$this->load->view('frontend/master', $this->template);	
	}

	public function plantEntry()
	{
		checkUser(array(1, 2));
		
		$regionID = $this->input->post('region-id');
		$startMonth = $this->input->post('startmonth');
		$endMonth = $this->input->post('endmonth');
		$half = $this->input->post('half');
		

		$rice = $this->input->post('rice');
		$palawija = $this->input->post('palawija');
		$sugar = $this->input->post('sugar');
		$bero = $this->input->post('bero');

		$this->form_validation->set_rules('startmonth', 'Bulan Awal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('endmonth', 'Bulan Akhir', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rice', 'Padi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('palawija', 'Palawija', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sugar', 'Tebu', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bero', 'Bero', 'trim|required|xss_clean');

		
		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$data = array();

			$this->template['content'] = $this->load->view('frontend/pages/plant-entri', $data, true);
			$this->load->view('frontend/master', $this->template);
		}
		else
		{

			// $this->db->_error_message(); redirect('plant-view');
			// $this->db->_error_number(); redirect('plant-view');

			$start = $month = strtotime($startMonth);
			$end = strtotime($endMonth);
			$collection = array();
			$insertTime = date('Y-m-d h:i:s');

			while($month <= $end)
			{
				$data = array(
					'start' => date('Y-m-d', $month),
					'end' => date('Y-m-d', $month),
					'rice' => $rice,
					'palawija' => $palawija,
					'sugar' => $sugar,
					'region_id' => $regionID,
					'half' => $half,
					'insert_date' => $insertTime,
					);

			    array_push($collection, $data);

			    $data = array(
					'start' => date('Y-m-d', $month),
					'end' => date('Y-m-d', $month),
					'rice' => $rice,
					'palawija' => $palawija,
					'sugar' => $sugar,
					'region_id' => $regionID,
					'half' => 2,
					'insert_date' => $insertTime,
					);

			    array_push($collection, $data);

			    $month = strtotime("+1 month", $month);

			}
			
			$result = $this->plant_model->save($collection);

			if ($result['status']) {
				$message = array('status' => 1, 'data' => $result['data'], 'msg' => 'Data berhasil dimasukan');
			} else {
				$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
			}
        	
        	$this->session->set_flashdata('message', $message);
        	// echo "<pre>" . print_r($message, 1) . "</pre>";
			redirect('plant-view');
		}
	}

	// by plant
	public function ajaxGetWaterDemand()
	{
		setlocale(LC_ALL, 'IND');
		$year = $this->input->post('year') ? : date('Y');

		$startMonth = '1-11-' . $year;
		$start = $month = strtotime($startMonth);
		$end = strtotime("+11 month", $start);

		$condition = array(
			'start >=' => date('Y-m-d', $start),
			'start <=' => date('Y-m-d', $end),
			// 'region_id' => 1
			);

		$data = $this->plant_model->find($condition)->result();
		

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

		header('Content-Type: application/json');
		echo json_encode($result);

	}

	// END : PLANT PLAN
	public function dataViewCommon()
	{

		$data = array();
		$data['regions'] = $this->region_model->find()->result();
		$queryYear = $data['regions'] ? array('region_id' => $data['regions'][0]->id) : array();
		$data['years'] = $this->water_model->findYear($queryYear)->result();

		$qYear = $this->input->post('year')?: $data['years'][0]->tahun;
		$qRegion = $this->input->post('region')?: $data['regions'][0]->id;

		$data['qYear'] = $qYear ? : '';
		$data['qRegion'] = $qRegion ? : '';

		$condition = 'year(date)=' . $qYear . ' and region_id=' . $qRegion;

		$table['year'] = $data['qYear'];
		$table['table'] = $this->water_model->everyHalfMonth($condition)->result();
		
		$data['table'] = $this->load->view('frontend/part/table-common', $table, true);	

		$this->template['content'] = $this->load->view('frontend/pages/data-water-common', $data, true);
		$this->load->view('frontend/master', $this->template);

	}

	public function ajaxGetYearsByRegion()
	{
		$id = $this->input->post('region-id');
		$response = $this->water_model->findYear(array('region_id' => $id))->result();

		echo json_encode($response);
	}

	public function dataDebitAndalan()
	{
		checkUser(array(1, 2));
		
		$data = array();
		$table = array();
		$data['regions'] = $this->region_model->find()->result();
		$qRegion = $this->input->post('region')?: $data['regions'][0]->id;

		$queryYear = $data['regions'] ? array('region_id' => $qRegion) : array();
		$allYears = $this->water_model->findYear($queryYear)->result();

		$data['years'] = $allYears;
		$qYear = $this->input->post('year')?: $data['years'][0]->tahun;
		$qRegion = $this->input->post('region')?: $data['regions'][0]->id;
		
		$data['qYear'] = $qYear ? : '';
		$data['qRegion'] = $qRegion ? : '0';
		
		$dataCollection = array();
		for ($i=1; $i < 13; $i++) {

			// collecting first half of month
			$coloumn1 = array();
			foreach ($allYears as $key => $value) {
				$half1 = array(	
									$value->tahun . '-' . str_pad($i, 2, "0", STR_PAD_LEFT) . '-01', 
									$value->tahun .'-' . str_pad($i, 2, "0", STR_PAD_LEFT) . '-15', 
									$data['qRegion']
								);
				
				array_push($coloumn1, $this->water_model->debitIntake($half1)->row());
			}
			array_push($dataCollection, $coloumn1);

			// collecting second half of month
			$coloumn2 = array();
			foreach ($allYears as $key => $value) {
				$half2 = array(
									$value->tahun . '-' . str_pad($i, 2, "0", STR_PAD_LEFT) . '-16', 
									date("Y-m-t", strtotime($value->tahun . '-' . str_pad($i, 2, "0", STR_PAD_LEFT) . '-16')),
									$data['qRegion']
								);
				
				array_push($coloumn2, $this->water_model->debitIntake($half2)->row());
			}
			array_push($dataCollection, $coloumn2);
		}

		$table['years'] = $allYears;
		$table['table'] = $dataCollection;
		$data['table'] = $this->load->view('frontend/part/table-andalan', $table, true);	
		$this->template['content'] = $this->load->view('frontend/pages/data-andalan', $data, true);
		$this->load->view('frontend/master', $this->template);

		// foreach ($dataCollection as $key => $value) {
		// 	foreach ($allYears as $key => $year) {
		// 		if (isset($value[$key]->rentang)) {
		// 			echo $value[$key]->rentang . " # ";
		// 		}
		// 	}
		// 	echo "<pre>" . print_r(	'==============================================================================', 1) . "</pre>";
		// }
	}

	/** haqisaurus 10/14/2015 8:24:19 PM: get data debit andalan.**/
	public function ajaxGetDataDebitAndalan()
	{
		checkUser(array(1, 2));
		
		$data = array();
		$table = array();
		$data['regions'] = $this->region_model->find()->result();
		$qRegion = $this->input->post('region')?: $data['regions'][0]->id;

		$queryYear = $data['regions'] ? array('region_id' => $qRegion) : array();
		$allYears = $this->water_model->findYear($queryYear)->result();

		$data['years'] = $allYears;
		$qYear = $data['years'][0]->tahun;
		$qRegion = $this->input->post('region')?: $data['regions'][0]->id;
		
		$data['qYear'] = $qYear ? : '';
		$data['qRegion'] = $qRegion ? : '0';

		$qMonth = $this->input->post('month') ? : '1';
		$startDay =  $qMonth ? '1-' . $qMonth . '-' . $qYear : '1-1-2015';
		$dataCollection = array();


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
								$data['qRegion']
							);

				array_push($coloumn1, $this->water_model->debitIntake($half1)->row());
			}

			// =========== HALF UNTIL LAST =================
			foreach ($allYears as $key => $value2) {

				$startSecond = strtotime('+1 day',  strtotime($value2->tahun . '-' . date('m-d', $endFirst)));
				$endSecond = strtotime('last day of',  strtotime($value2->tahun . '-' . date('m-d', $endFirst)));

				$half2 = array(
								date('Y-m-d', $startSecond), 
								date('Y-m-d', $endSecond), 
								$data['qRegion']
							);

				array_push($coloumn2, $this->water_model->debitIntake($half2)->row());
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

		
		// for ($i=1; $i < 13; $i++) {

		// 	// collecting first half of month
		// 	$coloumn1 = array();
		// 	foreach ($allYears as $key => $value) {
		// 		$half1 = array(	
		// 							$value->tahun . '-' . str_pad($i, 2, "0", STR_PAD_LEFT) . '-01', 
		// 							$value->tahun .'-' . str_pad($i, 2, "0", STR_PAD_LEFT) . '-15', 
		// 							$data['qRegion']
		// 						);
				
		// 		array_push($coloumn1, $this->water_model->debitIntake($half1)->row());
		// 	}
		// 	array_push($dataCollection, $coloumn1);

		// 	// collecting second half of month
		// 	$coloumn2 = array();
		// 	foreach ($allYears as $key => $value) {
		// 		$half2 = array(
		// 							$value->tahun . '-' . str_pad($i, 2, "0", STR_PAD_LEFT) . '-16', 
		// 							date("Y-m-t", strtotime($value->tahun . '-' . str_pad($i, 2, "0", STR_PAD_LEFT) . '-16')),
		// 							$data['qRegion']
		// 						);
				
		// 		array_push($coloumn2, $this->water_model->debitIntake($half2)->row());
		// 	}
		// 	array_push($dataCollection, $coloumn2);
		// }
		// 
		// $result = array();
        // foreach ($dataCollection as $key => $value) {
        //     $date = $value[0] ? $value[0]->date : '';
        //     $month = date('d-F-Y', strtotime($date));
        //     $match = explode('-', $month);
        //     $string = '';
        //     if (is_array($match)) {
        //         $string = $match[1] . ' ' . ($match[0] == '01' ? '1' : '2') ;
        //     }

            
        //     $intakeCollection = array();
        //     foreach ($allYears as $key => $year) {
        //         if (isset($value[$key]->rentang)) {
        //                 $round = round($value[$key]->intake, 4);
        //                 array_push($intakeCollection, $round);
        //         }
        //     }
        //     array_push($result, min($intakeCollection));
        // }


		

		header('Content-Type: application/json');
		echo json_encode($result);
		// echo json_encode($dataCollection);
	}

	public function test()
	{
		$this->load->view('integrated/master');
		
	}
}