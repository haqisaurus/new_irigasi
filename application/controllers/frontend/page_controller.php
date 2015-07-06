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

	// NEW DATA TABLE 
	public function dataWater($id='')
	{
		$data['regions'] = $this->region_model->find()->result();

		$qMonth = $this->input->post('month')?: '01';
		$qRegion = $this->input->post('region')?: $data['regions'][0]->id;

		$data['qMonth'] = $qMonth ? : '';
		$data['qRegion'] = $qRegion ? : '';
		$data['table'] = $this->generateTable($data['qMonth'], $data['qRegion']);

		$this->template['content'] = $this->load->view('frontend/pages/data-water', $data, true);
		$this->load->view('frontend/master', $this->template);
	}

	public function generateTable($month, $region)
	{
		$dayCount = cal_days_in_month(CAL_GREGORIAN, $month, 2000);

		$years = $this->water_model->findYear(array('region_id' => $region))->result();
		$table = '<table style="width: 5000px">';

		// header table`
		$time = strtotime(2000 . '-' . $month . '-01');
		$fMonth = date("F", $time);
		$table .= '<tr>
						<th rowspan="2"style="width: 70px;text-align: center"> Tahun </th>
						<th colspan="15">' .$fMonth. ' pertama </th>
						<th colspan="' .($dayCount-15). '"> ' .$fMonth. ' kedua </th>
					</tr>';
		$table .= '<tr>';
		for ($i=1; $i <= $dayCount; $i++) { 
				$table .= '<th style="text-align: center">Hari ' . $i . '</th>';
		}
		$table .= '</tr>';
		
		// data table 
		foreach ($years as $key => $year) {
			$table .= '<tr>';
			$table .= $this->generateTD($month, $year->tahun, $region);
			$table .= '</tr>';
		}

		$table .= '</table>';
		return $table;
	}

	public function generateTD($month, $year, $region)
	{
		$dayCount = cal_days_in_month(CAL_GREGORIAN, $month, 2000);

		
		$startDate = $year . '-' . $month . '-01';
		$endDate = $year . '-' . $month . '-' . $dayCount;
		$nextDate = $startDate;

		$td = '<td>' . $year . '</td>';
		while(strtotime($nextDate) <= strtotime($endDate))
		{
			if ($year > 1000) {
				$query = $this->water_model->find(array('date'=> $nextDate, 'region_id' => $region));
				$dataWater = $query->row();
				if ($query->num_rows() && (date("m",  strtotime($nextDate)) == $month)) {
					$td .= "<td><a href='" . base_url('data-detail/' . $dataWater->id) . "'>" . "Kanan : " .  $dataWater->right . " | Kiri : " . $dataWater->left . " | Limpas : " . $dataWater->limpas . "</a></td>";
				} else {
					$td .= "<td> none </td>";

				}
			}

			$nextDate = date("Y-m-d", strtotime("+1 day", strtotime($nextDate)));
		}

		return $td;
	}

	// data table 7-6-2015
	// public function dataWater($id='')
	// {

	// 	date_default_timezone_set('UTC');


	// 	$data['regions'] = $this->region_model->find()->result();
	// 	$queryYear = $data['regions'] ? array('region_id' => $data['regions'][0]->id) : array();
	// 	$data['years'] = $this->water_model->findYear($queryYear)->result();

	// 	$qMonth = $this->input->post('month')?: '01';
	// 	$qYear = $this->input->post('year')?: $data['years'][0]->tahun;
	// 	$qRegion = $this->input->post('region')?: $data['regions'][0]->id;

	// 	$data['qMonth'] = $qMonth ? : '';
	// 	$data['qYear'] = $qYear ? : '';
	// 	$data['qRegion'] = $qRegion ? : '';

	// 	$query = array(
	// 		'YEAR(date)' => $data['qYear'],
	// 		'MONTH(date)' => $data['qMonth'],
	// 		'region_id' => $data['qRegion'],
	// 		);

	// 	$data['table'] = $this->water_model->findASCDate($query)->result();

	// 	$this->template['content'] = $this->load->view('frontend/pages/data-water', $data, true);
	// 	$this->load->view('frontend/master', $this->template);
	// }

	// private function dataTD($countDate, $month, $year, $id)
	// {
	// 	$dataTD = '';

	// 	for ($i=1; $i <= $countDate; $i++) { 

	// 		if ($year > 1000) {
	// 			$day = $year . '-' . $month . '-' . $i;
	// 			$data = $this->water_model->find(array('date'=> $day, 'region_id' => $id), 1, 0);
	// 			$dataWater = $data->row();
	// 			if ($data->num_rows()) {
	// 				$dataTD .= "<td><a href='" . base_url('data-detail/' . $dataWater->id) . "'>" . "Kanan : " .  $dataWater->right . " <br> Kiri : " . $dataWater->left . " <br> Limpas : " . $dataWater->limpas . "</a></td>";
	// 			} else {
	// 				$dataTD .= "<td class='none'> none </td>";

	// 			}
	// 		}
	// 	}

	// 	return $dataTD;
	// }
	// END: data table 7-6-2015
	public function inputWater()
	{
		$data = array();
		$data['regions'] = $this->region_model->find()->result();

		$this->template['content'] = $this->load->view('frontend/pages/data-entri', $data, true);
		$this->load->view('frontend/master', $this->template);
	}

	public function doInputWater()
	{
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
		$data = array();
		$data['regions'] = $this->region_model->find()->result();
		$data['update'] = $this->water_model->findWithRegion(array('water.id' => $id), 1, 0)->row();
		$this->template['content'] = $this->load->view('frontend/pages/data-edit', $data, true);
		$this->load->view('frontend/master', $this->template);
	}

	public function doEditWater()
	{
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
		$data = array();

		$this->template['content'] = $this->load->view('frontend/pages/account-detail', $data, true);
		$this->load->view('frontend/master', $this->template);
	}
}