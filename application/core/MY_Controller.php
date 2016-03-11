<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	 /**
		* @Class 		My_Controller
	 	*
		* @package		CodeIgniter
	 	* @subpackage	Controller
	 	* @category		
	 	* @author		Dwiraj Chauhan
	 	* @link			localhost
		*/
		class MY_Controller extends CI_Controller 
		{
			public function __construct()
			{
				parent::__construct();
				// load all model used 
				$this -> load -> model('Users');
				$this -> load -> model('Employees');
				$this -> load -> model('Salary_registers');
				// load library of javascript 
				$this -> load -> library('javascript');
				// load helper
				$this -> load -> helper('form');
				$this -> load -> helper('url');
				$this -> load -> helper('cookie');
			}

			/**
			 * @function check_login
			 * @param mixed
			 * @return string
			 *
			 * this function check if user login or not
			 */
			public function check_login()
			{
				// if user not loging or session is not set
				if (!$this -> session -> userdata('logged_in')) 
				{
					redirect('user/login');
				}
				$usertype = $this -> session -> userdata['logged_in']['user_level'];
				return $usertype;
			}

			/**
			 * @function load_view
			 * @param string $view_file,
			 * @param array $parameters
			 * @return void
			 *
			 * this function for show view filess
			 */
			public function load_view($view_file, $parameters)
			{
				if($this -> session -> userdata('logged_in'))
				{
					$parameters['userset'] = "set";
					$parameters['footer'] = $this -> session -> userdata['logged_in']['last_login'];
					$parameters['user'] = $this -> session -> userdata['logged_in']['first_name'];
					$parameters['user_level'] = $this -> session -> userdata['logged_in']['user_level'];
				}
				else
				{
					$parameters['userset'] = "";
					$parameters['footer'] = "";
					$parameters['user'] = "";
					$parameters['user_level'] ="";
				}
				$this -> load -> view('header', $parameters);
				$this -> load -> view($view_file, $parameters);
				$this -> load -> view('footer', $parameters);
			}

			/**
			 * @function check_validation
			 * @param string $page
			 * @return boolean
			 *
			 * this function show validation errors
			 */
			public function check_validation($page)
			{
				$this->form_validation->set_error_delimiters('<div class="error">','</div>');
				if($page == 'login')
				{
					$this ->	form_validation -> set_rules('email','email', 'trim|required|valid_email');
					$this ->	form_validation -> set_rules('password', 'password', 'trim|required');
				}
				else if($page == 'employee_detail')
				{
					$this ->	form_validation -> set_rules('salary','salary', 'trim|required|numeric');
					$this ->	form_validation -> set_rules('position', 'Position', 'trim|required');
					$this ->	form_validation -> set_rules('start_date', 'start date', 'trim|required');
					$this ->	form_validation -> set_rules('current_status', 'current status', 'trim|required');
					$this ->	form_validation -> set_rules('end_date', 'end date', 'trim');
				}
				else
				{
					$this -> 	form_validation -> set_rules('first_name', 'first name', 'trim|required|max_length[12]');
					$this ->	form_validation -> set_rules('last_name', 'last name', 'trim|required|max_length[12]');
					$this ->	form_validation -> set_rules('email','email', 'trim|required|valid_email');
					$this ->	form_validation -> set_rules('user_level', 'user type', 'trim|required');
					if($page == 'add')
					{
						$this ->	form_validation -> set_rules('password', 'password', 'trim|required|matches[cpassword]');
						$this ->	form_validation -> set_rules('cpassword', 'confirm password', 'trim|required');
					}
				}
		
				if($this->form_validation->run() == false)
				{
					return false;
				}
				else
				{
					return true;
				}
			}

			/**
			 * @function return pdf_head()
			 * @param mixed
			 * @return string $pdf_head
			 *
			 * this method is use for set PDF report header
			 */
			public function pdf_head()
			{
				$pdf_head = '<p align="center"><img src='.image_path('logo.png').'></p>';
 				return $pdf_head;
			}

			/**
			 * @function return pdf_foot()
			 * @param mixed
			 * @return string $pdf_foot
			 *
			 * this method is use for set PDF report footer
			 */
			public function pdf_foot()
			{
				$pdf_foot =  '<p align="center"><b>PROFESSIONAL SOFTTECH</b><br/>
		    						302 to 305, Shivalik 8, Opp. Paradise Hall, Near Sadhuvasvani Road, Rajkot – 360005, Gujarat, INDIA.<br/>
		    						Email: info@professionalsofttech.com - Website: www.professionalsofttech.com<br/>
									<b>Phone: +91 281 2571717</b></p>';
				return $pdf_foot;
			}

			/**
			 * @function unset_array
			 * @param array
			 * @return mixed
			 *
			 * this method is use for unset empty values or an array
			 */
			public function unset_array($parameters)
			{
				foreach ($parameters as $key => $value) 
				{
					if($value == "")
					{
						$parameters[$key] = NULL;
					}
				}
				return $parameters;
			}
	
		}
	?>