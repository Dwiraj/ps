<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 	/**
	* @Class Report
 	*
	* @package 		CodeIgniter
 	* @subpackage	Controller
 	* @category		Controller
 	* @author		Dwiraj Chauhan
 	* @link			localhost
	*/
 	class Report extends MY_Controller 
 	{
 		public function __construct()
 		{
 			parent::__construct();
 			if($this -> check_login() != 2)
 			{
 				redirect('user/logout');
 			}
 		}

	   /**
		* @function index
		* @return void
		*
		* blank
		*/
		public function index()
		{

		}

	   /**
		* @function viewpdf()
		* @param
		* @return void
		*
		* this method is use for view plain html page with data
		*/
		public function viewpdf()
		{
			$parameters['month'] 	= $this -> input -> get('m');
			$parameters['year']  	= $this -> input -> get('y');
			$parameters['query']	= $this -> Salary_registers -> getlist($parameters);
			$this->load->view('salary_register_report', $parameters);
		}

	   /**
		* @function createpdf()
		* @param
		* @return void
		*
		* this function is use for create a PDF file
		*/
		public function createpdf()
		{
			$parameters['month'] 	= $this -> input -> get('m');
			$parameters['year']  	= $this -> input -> get('y');
			// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
			$pdfFilePath = "SalaryRegister_".$parameters['month']."_".$parameters['year'].".pdf";

			ini_set('memory_limit','32M'); // boost the memory limit if it's low

			$parameters['query']	= $this -> Salary_registers -> getlist($parameters);
			$html = $this->load->view('salary_register_report', $parameters, true);

			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			$pdf->SetHeader($this -> pdf_head());
			$pdf->SetFooter($this -> pdf_foot()); // Add a footer for good measure
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'D'); // I - open a PDF file in browser // F - to save file // D - to download file

		}

		/**
		 * @function viewpdf()
		 * @param
		 * @return void
		 *
		 * this method is use for view plain html page with data
		 */
		public function employee_salary_record()
		{
			$parameters['query'] 	= $this -> Employees -> get_data();
			$parameters['title'] 	= "Employee salary record";
			$this -> load_view('report/employee_salary_record', $parameters);
		}

		/**
		 * @function employee_salary_report
		 * @param
		 * @return void
		 *
		 * this method is use for fetch data of employee salary record from database
		 */
		public function employee_salary_report()
		{

			$s_date	= $this -> input -> post('s_date'); // s_date means start date
			$e_date	= $this -> input -> post('e_date'); // e_date means end date
			$parameters = array(
								'employee_id' 	=> $this -> input -> post('employee_id'),
								's_month' 	  	=> date('n', strtotime( $s_date)),
								's_year'		=> date('Y', strtotime( $s_date)),
								'e_month' 		=> date('n', strtotime( $e_date)),
								'e_year' 		=> date('Y', strtotime( $e_date))
								);

			$parameters['result'] = $this -> Salary_registers -> employee_salary_report($parameters);
			echo json_encode($parameters);
		}

		/**
		 * @function employee_salary_report__view
		 * @param
		 * @return void
		 *
		 * this method is use for generate employee salary record PDF file
		 *
		 */
		public function employee_salary_report_view()
		{
			$id = $this -> input -> get('id');
			$s_date = $this -> input -> get('s');
			$e_date = $this -> input -> get('e');

			$parameters = array(
								'employee_id' 	=> $id,
								's_month' 	 	=> date('n', strtotime( $s_date)),
								's_year' 		=> date('Y', strtotime( $s_date)),
								'e_month' 		=> date('n', strtotime( $e_date)),
								'e_year' 		=> date('Y', strtotime( $e_date))
								);

			// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
			$pdfFilePath = "Employee_salary_report.pdf";

			ini_set('memory_limit','32M'); // boost the memory limit if it's low

			$parameters['result'] 	= $this -> Salary_registers -> employee_salary_report($parameters);
			$parameters['user'] 	= $this -> Users -> update_user($id);
			$parameters['employee'] = $this -> Employees -> update_user($id);
			$html = $this -> load -> view('report/employee_salary_record_slip', $parameters, true);

			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			$pdf->SetHeader($this -> pdf_head());
			$pdf->SetFooter($this -> pdf_foot());   // Add a footer for good measure
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'D'); // I - open a PDF file in browser // F - to save file // D - to download file

		}

		/**
		 * @function create_tds_pdf
		 * @param
		 * @return void
		 *
		 * this method is use for generate employee TDS record PDF file
		 *
		 */
		public function create_tds_pdf()
		{

			$parameters['month'] = $this -> input -> get('m');
			$parameters['year']  = $this -> input -> get('y');


			// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
			$pdfFilePath = "Employee_salary_report.pdf";

			ini_set('memory_limit','32M'); // boost the memory limit if it's low

			$parameters['result'] = $this -> Salary_registers -> employee_tds_report($parameters);
			$html = $this -> load -> view('report/employee_tds_report', $parameters, true);

			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			$pdf->SetHeader($this -> pdf_head());
			$pdf->SetFooter($this -> pdf_foot());   // Add a footer for good measure
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'I'); // I - open a PDF file in browser // F - to save file // D - to download file

		}
	}
?>