	<?php

		defined('BASEPATH') OR exit('No direct script access allowed');

		/**
		* @Class Salary_register
	 	*
		* @package		CodeIgniter
	 	* @subpackage	Controller
	 	* @category	  	Controller
	 	* @author		Dwiraj Chauhan
	 	* @link			localhost
		*/
		class Salary_register extends MY_Controller 
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
			 * @param
			 * @return void
			 *
			 * index is use for show list of all the salary register
			 */
			public function index()
			{
				$parameters['title'] 	= "Salary Register list";
				$parameters['query'] 	= $this -> Salary_registers -> get_register_list();
				$this->load_view('salary_register/salary_register_list', $parameters);
			}

			/**
			 * @function registerlist
			 * @param
			 * @return void
			 *
			 * function is use for show list of all the salary register is already saved
			 */
			public function registerlist()
			{
				$parameters['month'] 	= $this -> input -> get('m');
				$parameters['year']  	= $this -> input -> get('y');
				$parameters['title'] 	= "Update salary Register";
				$parameters['query']	= $this -> Salary_registers -> getlist($parameters);
				$this->load_view('salary_register/editregister', $parameters);
			}

			/**
			 * @function createregisterlist
			 * @param
			 * @return void
			 *
			 * function is use for show create new salary register form
			 */
			public function createregisterlist()
			{
				$parameters['title'] 	= "create salary Register";
				$this->load_view('salary_register/create_salary_register', $parameters);
			}

			/**
			 * @function getlist
			 * @param
			 * @return void
			 *
			 * function is use for show create new salary register form from Ajax
			 */
			public function getlist()
			{
				$parameters['month'] 	=	$this -> input -> post('month');
				$parameters['year'] 	=	$this -> input -> post('year');
				$parameters['error'] = "";

				// result store boolean if salary register is already store in database
				$result	= $this -> Salary_registers -> getlist($parameters);
				if($result == false)
				{
					// if no rows return
					$parameters['query']  = $this -> Salary_registers ->createlist($parameters);
				}
				else
				{
					switch ($parameters['month']) 
					{
						case '1':
							$mon = "January";
							break;
						case '2':
							$mon = "February";
							break;
						case '3':
							$mon = "March";
							break;
						case '4':
							$mon = "April";
							break;
						case '5':
							$mon = "May";
							break;
						case '6':
							$mon = "June";
							break;
						case '7':
							$mon = "July";
							break;
						case '8':
							$mon = "August";
							break;
						case '9':
							$mon = "September";
							break;
						case '10':
							$mon = "October";
							break;
						case '11':
							$mon = "November";
							break;
						case '12':
							$mon = "December";
							break;
					}
					//if row already exist
					$parameters['error'] = "Salary register for ".$mon.", ".$parameters['year']." is already created";
				}
				echo json_encode($parameters);
			}

			/**
			 * @function add_salary_register
			 * @param
			 * @return void
			 *
			 * function is use for create new salary register
			 */
			public function add_salary_register()
			{
				$index = $this -> input -> post('index');
				$n = 0;
				$parameters = array ();
				for($i=1; $i<=$index; $i++)
				{
					$check_checkbox = $this -> input -> post('autoload'.$i.'');
					if($check_checkbox != "")
					{
						$n++;
						$parameters[$n] = array(
												'employee_id' 	=> $this -> input -> post('uid'.$i.''),
												'base_salary' 	=> $this -> input -> post('base_salary'.$i.''),
												'bonus'			=> $this -> input -> post('bonus'.$i.''),
												'pt'			=> $this -> input -> post('pt'.$i.''),
												'esi'			=> $this -> input -> post('esi'.$i.''),
												'tds'			=> $this -> input -> post('tds'.$i.''),
												'total'			=> $this -> input -> post('total'.$i.''),
												'working_days'	=> $this -> input -> post('working_days'.$i.''),
												'month'			=> $this -> input -> post('month'),
												'year'			=> $this -> input -> post('year'),
												'created_by'	=> $this -> session -> userdata['logged_in']['id'],
												'created_date' 	=> date('Y-m-d')
									   			);
					}
				}
				$this -> Salary_registers -> add_salary_register($parameters, $n);
				redirect('salary-register-list');
			}

		 /**
			* @function update_salary_register
	 		* @param 
	 		* @return void
	 		*
			* function is use for update salary register in database
			*/
			public function update_salary_register()
			{
				$index = $this -> input -> post('index');
				echo $index;
				$parameters = array ();
				for($i=1; $i<=$index; $i++)
				{
					$parameters[$i] = array(
											'employee_id' 		=> $this -> input -> post('uid'.$i.''),
											'base_salary' 		=> $this -> input -> post('base_salary'.$i.''),
											'bonus'			 	=> $this -> input -> post('bonus'.$i.''),
											'pt'				=> $this -> input -> post('pt'.$i.''),
											'esi'				=> $this -> input -> post('esi'.$i.''),
											'tds'				=> $this -> input -> post('tds'.$i.''),
											'total'			 	=> $this -> input -> post('total'.$i.''),
											'working_days'		=> $this -> input -> post('working_days'.$i.''),
											'month'			 	=> $this -> input -> post('month'),
											'year'			 	=> $this -> input -> post('year'),
											'created_by'	 	=> $this -> input -> post('created_by'.$i.''),
											'created_date' 		=> $this -> input -> post('created_date'.$i.''),
											'last_updated_by' 	=> $this -> session -> userdata['logged_in']['id'],
											'last_updated' 		=> date('Y-m-d')
										);
				}
				$result = $this -> Salary_registers -> update_salary_register($parameters, $index);
				redirect('salary-register-list');
			}

			/**
			 * @function delete_salary_register
			 * @param
			 * @return void
			 *
			 * function is use for delete salary register in database
			 */
			public function delete_salary_register()
			{
				$month 	= $this -> input -> get('m'); 
				$year 	=	$this -> input -> get('y');
				$this -> Salary_registers -> delete_salary_register($month, $year);
				redirect('salary-register-list');				
			}

		}
	?>