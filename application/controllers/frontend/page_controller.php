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
		$start_date = $qYear . '-' . $qMonth . '-01';
		$end_date = $qYear . '-' . $qMonth . '-' . $countDate;
		
		$dataTR = '';
		foreach ($years as $key => $year) {
			$dataTR .= '<tr>
			            	<td style="width: 40px;">' . ($key + 1) . '</td>
			            	<td style="width: 60px;">' . $year->tahun . '</td>'
							. $this->dataTD($start_date, $end_date, $year->tahun, $id) . 
			            '</tr>';
		}

		$data = array();
		$data['years'] = $years;
		$data['table'] = '<table class="table-global">
            <tr>
                <th >No</th>
                <th >Name</th>
                <th colspan="15">' . $thisMonth . ' 1</th>
                <th colspan="' . ($countDate - 15) . '">' . $thisMonth . ' 2</th>
            </tr>
            ' . $dataTR . '
        </table>';

		$this->template['content'] = $this->load->view('frontend/pages/data-region', $data, true);
		$this->load->view('frontend/master', $this->template);
	}

	private function dataTD($startDate, $endDate, $year, $id)
	{
		$dataTD = '';
		$nextDate = $startDate;

		while(strtotime($nextDate) <= strtotime($endDate))
		{
			if ($year > 1000) {
				$dataWater = $this->water_model->find(array('date'=> $nextDate, 'region_id' => $id))->row();
				if ($dataWater->date) {
					$dataTD .= "<td><a href='" . base_url('data-detail/' . $dataWater->id) . "'>" . "Kanan : " . $dataWater->date . $nextDate .  $dataWater->right . " | Kiri : " . $dataWater->left . " | Limpas : " . $dataWater->limpas . "</a></td>";
				} else {
					$dataTD .= "<td> none </td>";

				}
			}
			$nextDate = date ("Y-m-d", strtotime("+1 day", strtotime($nextDate)));
		}

		return $dataTD;
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