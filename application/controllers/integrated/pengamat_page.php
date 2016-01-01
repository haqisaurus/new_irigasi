<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengamat_page extends CI_Controller {

	public function index()
	{
		$this->load->library('irigasi/wide');
		$data['regions'] 		= $this->wide->getAllWide();

		$template['content'] = $this->load->view('frontend/pages/home', $data, true); 
		$template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
		$template['sideBar'] = $this->load->view('frontend/part/nav-right', '', true);
		$this->load->view('frontend/master', $template);
	}

	// water section =====================================================================================
		public function viewWater()
		{
			
			$year 		= $this->input->post('year');
			$month 		= $this->input->post('month');
			$regionID 	= $this->input->post('region-id');

			$this->form_validation->set_rules('year', 'Tahun', 'trim|xss_clean');
			$this->form_validation->set_rules('month', 'Bulan', 'trim|xss_clean');
			$this->form_validation->run();

			$this->load->library('irigasi/water');$this->load->library('irigasi/region');
			$data['regions'] 		= $this->region->getAllRegion();

			$data['table'] 	= array();
			$regionID 		= $regionID ? : $data['regions'][0]->id;
			$condition 		= array('region_id' => $regionID);
			
			$data['years'] 	= $this->water->getAllYear($condition);

			if ($_POST) {
				
				$conditionLike  = array('date' => $year . '-' . sprintf("%02d", $month));
				$data['table'] 	= $this->water->getAllWaterASC($condition, $conditionLike);
			}
			
			$template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
			$template['sideBar'] = $this->load->view('frontend/part/nav-right', '', true);
			$template['content'] = $this->load->view('frontend/pages/pengamat/debit-list', $data, true);
			$this->load->view('frontend/master', $template);
		}
	// END : water section =====================================================================================


	// debit andalan section =====================================================================================
		public function getDebitAndalan()
		{
			$this->load->library('irigasi/water');
			$this->load->library('irigasi/region');

			$regionID 		= $this->input->post('region-id') ? : null;
		
			$data['regions'] 		= $this->region->getAllRegion();
			$data['current_reg']	= $regionID ? $this->region->getSpecificRegion(array('id' => $regionID))->region_name : $data['regions'][0]->region_name;
			
			$template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
			$template['sideBar'] = $this->load->view('frontend/part/nav-right', '', true);
			$template['content'] = $this->load->view('frontend/pages/pengamat/data-andalan', $data, true);
			$this->load->view('frontend/master', $template);
		}

		public function ajaxGetDebitAndalan()
		{
			$this->load->library('irigasi/water');

			$regionID 		= $this->input->post('region-id') ? : null;
			$dataAndalan 	= $this->water->getDataAndalan($regionID);
			$resultAndalan 	= array();

			foreach ($dataAndalan as $key => $value) {
				array_push($resultAndalan, $value);
			}

			echo json_encode($resultAndalan);
		}
	// END : debit andalan section =====================================================================================

	// masa tanam ==================================================================================================
		public function plan()
		{
			$this->load->library('irigasi/region');
			$data['regions'] 		= $this->region->getAllRegion();

			$template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
			$template['sideBar'] = $this->load->view('frontend/part/nav-right', '', true);
			$template['content'] = $this->load->view('frontend/pages/pengamat/plan-form', $data, true);
			$this->load->view('frontend/master', $template);
		}

		public function planDataCalc()
		{
			$this->load->library('irigasi/region');
			$regionID 	= $this->input->post('region-id');
			
			$data['regions'] 		= $this->region->getAllRegion();
			$data['current_reg']	= $this->region->getSpecificRegion(array('id' => $regionID))->region_name;
			$data['data'] 			= $_POST;

			$template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
			$template['sideBar'] = $this->load->view('frontend/part/nav-right', '', true);
			$template['content'] = $this->load->view('frontend/pages/pengamat/plan-result', $data, true);
			$this->load->view('frontend/master', $template);

		}

		public function ajaxGetDataWaterDemand()
		{
			$this->load->library('irigasi/water');

			$regionID 	= $this->input->post('region-id');
			$year 		= $this->input->post('year');
			$startMonth = $this->input->post('month');
			$range 		= explode(',', $this->input->post('range'));
			$rice 		= explode(',', $this->input->post('rice'));
			$palawija 	= explode(',', $this->input->post('palawija'));
			$sugar 		= explode(',', $this->input->post('sugar'));
			$bero 		= explode(',', $this->input->post('bero'));

			
			$waterDemand = $this->water->planData($regionID, $year, $startMonth, $range, $rice, $palawija, $sugar, $bero);

			// =================== data andalan =============
			$dataAndalan = $this->water->getDataAndalan($regionID, $startMonth);
			
			$andalan = array();
			$neraca = array();
			$demand = array();

			foreach ($dataAndalan as $key => $value) {
				
				array_push($andalan, $value);
				array_push($demand, $waterDemand[$key]['data']['water-irigasi']);
				array_push($neraca, $value - $waterDemand[$key]['data']['water-irigasi']);
			}
			
			echo json_encode([$startMonth, $andalan, $demand, $neraca]);
		}

		public function listPlan()
		{
			$this->load->library('irigasi/plant');
			$data['table'] 		= $this->plant->getAllPlant();

			$template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
			$template['sideBar'] = $this->load->view('frontend/part/nav-right', '', true);
			$template['content'] = $this->load->view('frontend/pages/pengamat/plan-list', $data, true);
			$this->load->view('frontend/master', $template);
		}

		public function viewPlan($id)
		{
			$this->load->library('irigasi/region');
			$this->load->library('irigasi/water');
			$this->load->library('irigasi/plant');

			$dataPlant = (array) $this->plant->getSpesificPlant(array('plan_plant.id' => $id));
			// =================== data water demand =============

			$dataPlant['month']		= $dataPlant['start_month'];
			$dataPlant['rice']		= explode(',', $dataPlant['rice']);
			$dataPlant['palawija'] 	= explode(',', $dataPlant['palawija']);
			$dataPlant['sugar'] 	= explode(',', $dataPlant['sugar']);
			$dataPlant['bero'] 		= explode(',', $dataPlant['bero']);
			
			$data['data'] = $dataPlant;
			$data['current_reg']	= $this->region->getSpecificRegion(array('region.id' => $dataPlant['region_id']))->region_name;

			$template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
			$template['sideBar'] = $this->load->view('frontend/part/nav-right', '', true);
			$template['content'] = $this->load->view('frontend/pages/pengamat/plan-result', $data, true);
			$this->load->view('frontend/master', $template);

		}

		public function ajaxGetWide()
		{
			$this->load->library('irigasi/region');

			$regionID = $this->input->post('region-id');

			$data = $this->region->getRegionWide($regionID);
			
			echo json_encode($data);
		}
	// END : masa tanam ==================================================================================================

	
}