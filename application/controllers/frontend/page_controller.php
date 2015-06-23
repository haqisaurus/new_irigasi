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

		date_default_timezone_set('UTC');

		$qMonth = '02';
		$qYear = '1998';
		// kurang id daerah
		// getlongest day in a month

		$years = $this->water_model->findYear(array('region_id' => $id))->result();
		$dayInMounth = array();
		$maxMonthInYear = '';

		foreach ($years as $key => $year) {
			if($year->tahun > 1000) {
				$dayInMounth[$key] = cal_days_in_month(CAL_GREGORIAN, $qMonth, $year->tahun);
				if($year->tahun%4 == 0) $maxMonthInYear = $year->tahun;
			}

			
		}

		$thisMonth = date('F',strtotime($maxMonthInYear . '-' . $qMonth . '-1'));
		$countDate = max($dayInMounth);
		
		
		$dataTR = '';
		foreach ($years as $key => $year) {
			$dataTR .= '<tr>
			            	<td style="width: 40px;">' . ($key + 1) . '</td>
			            	<td style="width: 60px;">' . $year->tahun . '</td>'
							. $this->dataTD($countDate, $qMonth, $year->tahun, $id) . 
			            '</tr>';
		}

		$dataDate = $this->dataDate($countDate, $qMonth, $year->tahun, $id);

		$data = array();
		$data['years'] = $years;
		$data['table'] = '<table class="table-global">
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Name</th>
                <th colspan="15">' . $thisMonth . ' 1</th>
                <th colspan="' . ($countDate - 15) . '">' . $thisMonth . ' 2</th>
            </tr>
            ' . $dataDate 
             . $dataTR . '
        </table>';

		$this->template['content'] = $this->load->view('frontend/pages/data-region', $data, true);
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

	private function dataDate($countDate, $month, $year, $id)
	{
		$dataDate = '<tr>';

		for ($i=1; $i <= $countDate; $i++) { 

			$dataDate .= "<td> hari ke - " .  $i . "</td>";
		}
		$dataDate .= '</tr>';
		return $dataDate;
	}

	private function addOrdinalNumberSuffix($num) {
		if (!in_array(($num % 100),array(11,12,13))){
			switch ($num % 10) {
        // Handle 1st, 2nd, 3rd
				case 1:  return $num.'st';
				case 2:  return $num.'nd';
				case 3:  return $num.'rd';
			}
		}
		return $num.'th';
	}

	public function dataDetail($id)
	{
		$dataWater = $this->water_model->findWithRegion(array('water.id'=> $id))->row();
		$data = array();
		$data['detail'] = $dataWater;
		$this->template['content'] = $this->load->view('frontend/pages/data-detail', $data, true);
		$this->load->view('frontend/master', $this->template);
	}
}