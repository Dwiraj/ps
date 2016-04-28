	<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	   /**
		* @Class Employee
	 	*
		* @package		CodeIgniter
	 	* @subpackage	Controller
	 	* @category		Controller
	 	* @author		Dwiraj Chauhan <dwiraj.k.chauhan25@gmail.com>
	 	* @link			localhost
		*/
		class Employee extends MY_Controller
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
			 * this function show all user view file as default
			 */
			public function index()
			{
				$parameters['query'] = $this -> Employees -> get_employees();
				$parameters['title'] = "View all employee";
				$this->load_view('employee/viewemployee', $parameters);
			}

			/**
			 * @function ajax_list
			 * @param viod
			 * @return json object
			 *
			 * this function show all user view file as default
			 */
			public function ajax_list()
			{
				$list = $this->Employees->get_datatables();
				$data = array();
				$no = $_POST['start'];
				foreach ($list as $employee) {
					$no++;
					$row = array();
					$row[] = $employee->id;
					$row[] = $employee->first_name." ".$employee->last_name;
					$row[] = $employee->email;
					$row[] = $employee->position;
					$row[] = $employee->start_date;
					$row[] = $employee->current_status;
					$row[] = $employee->end_date;
					$row[] = $employee->last_login ? date('jS F Y, g:i a', strtotime($employee->last_login)) : "Not Login yet";

					//add html for action
					$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$employee->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  			  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$employee->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

					$data[] = $row;
				}

				$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->Employees->count_all(),
					"recordsFiltered" => $this->Employees->count_filtered(),
					"data" => $data,
				);
				//output to json format
				echo json_encode($output);
			}

			/**
			 * @function addedit
			 * @param
			 * @return void
			 *
			 * this function check and redirect add form or update form
			 */
			public function addedit()
			{
				$id = $this -> input -> get('id');

				//condition for check user already inserted or not
				if($this -> Employees -> user_exist($id) == false)
				{
					$this -> updateemployee($id);
				}
				else
				{
					$this -> addemployee();
				}
			}

			/**
			 * @function addemployee
			 * @param
			 * @return void
			 *
			 * this function show add employee detail form and insert into database
			 */
			public function addemployee()
			{
				$parameters = array(
									'employee_id' 	 	=> $this -> input -> post('uid'),
									'salutation' 		=> $this -> input -> post('salutation'),
									'father_name' 	 	=> $this -> input -> post('father_name'),
									'mother_name' 	 	=> $this -> input -> post('mother_name'),
									'salary' 			=> $this -> input -> post('salary'),
									'position'			=> $this -> input -> post('position'),
									'start_date' 		=> $this -> input -> post('start_date'),
									'current_status' 	=> $this -> input -> post('current_status'),
									'address'			=> $this -> input -> post('address'),
									'phone_no'			=> $this -> input -> post('phone_no'),
									'alternate_no'	 	=> $this -> input -> post('alternate_no'),
									'pan_no'			=> $this -> input -> post('pan_no'),
									'bank_account_no' 	=> $this -> input -> post('bank_account_no'),
									'qualification'  	=> $this -> input -> post('qualification'),
									'comment' 			=> $this -> input -> post('comment'),
									'profile_picture' 	=> "logo.ico",
									);
				$end_date = $this -> input -> post('end_date');
				$dob = $this -> input -> post('dob');
				// setting end date if user current status is resigned
				if(trim($end_date) != "" || trim($end_date) != "0000-00-00")
				{
					$parameters['end_date'] = trim($end_date);
				}
				if(trim($dob) != "" || trim($dob) != "0000-00-00")
				{
					$parameters['dob'] = trim($dob);
				}
				if($parameters['employee_id'] == "")
				{
					$parameters['employee_id'] = $this -> input -> get('id');
				}

				// function call for checking validation true or false
				$result = $this -> check_validation('employee_detail');

				if($result != false)
				{
					// condition for end date is set or not
					if($end_date != "" || $end_date == '0000-00-00')
					{
						// if end date is valid or not
						if($parameters['end_date'] < $parameters['start_date'])
						{
							$parameters['error_msg'] = "Please enter valid end date.";
						}
						else
						{
							$parameters = $this -> unset_array($parameters);
							// insert if end date is valid
							$this -> Employees -> addemployee($parameters);
							redirect('employee');
						}
					}
					else
					{
						$parameters = $this -> unset_array($parameters);
						// insert if user current status is working
						$this -> Employees -> addemployee($parameters);
						redirect('employee');
					}
				}
				$parameters['title'] = "Add employee detail";
				$this->load_view('employee/addemployee', $parameters);
			}

			/**
			 * @function getsearch
			 * @param
			 * @return void
			 *
			 * this function is for get data from database and view as search result
			 */
			public function getsearch()
			{
				$data = array (
								'searchtype' 	=> $this -> input -> post('searchtype'),
								'searchkeyword' => $this -> input -> post('searchkeyword'),
								);
				if($data['searchkeyword'] == '')
				{
					// if search keyword is empty than show all users
					$parameters['query'] = $this -> Employees -> get_employees();
				}
				else
				{
					if($data['searchtype'] == "first_name")
					{
						$parameters['query'] = $this -> Employees -> get_search_name($data);
					}
					else
					{
						// if search keyword have value than show similar user data
						$parameters['query'] = $this -> Employees -> get_search($data);
					}
				}
				echo json_encode($parameters);
			}

			/**
			 * @function getsearchsalary
			 * @param
			 * @return void
			 *
			 * this function is for get data from database and view as search result by min-max salary
			 */
			public function getsearchsalary()
			{
				$data = array (
								'searchtype' 	=> $this -> input -> post('searchtype'),
								'min' 			=> $this -> input -> post('min'),
								'max' 			=> $this -> input -> post('max')
								);
				if($data['searchtype'] == '')
				{
					// if search keyword is empty than show all users
					$parameters['query'] = $this -> Employees -> get_employees();
				}
				else
				{
					// if search keyword have value than show similar user data
					$parameters['query'] = $this -> Employees -> get_searchsalary($data);
				}
				echo json_encode($parameters);
			}

			/**
			 * @function updateemployee
			 * @param int $id
			 * @return void
			 *
			 * this function update employee
			 */
			public function updateemployee($id = 0)
			{
				$parameters = array(
									'salutation' 		=> $this -> input -> post('salutation'),
									'father_name' 	 	=> $this -> input -> post('father_name'),
									'mother_name' 	 	=> $this -> input -> post('mother_name'),
									'salary' 			=> $this -> input -> post('salary'),
									'position'			=> $this -> input -> post('position'),
									'start_date' 		=> $this -> input -> post('start_date'),
									'current_status' 	=> $this -> input -> post('current_status'),
									'address'			=> $this -> input -> post('address'),
									'phone_no'			=> $this -> input -> post('phone_no'),
									'alternate_no'	 	=> $this -> input -> post('alternate_no'),
									'pan_no'			=> $this -> input -> post('pan_no'),
									'bank_account_no' 	=> $this -> input -> post('bank_account_no'),
									'qualification'  	=> $this -> input -> post('qualification'),
									'comment' 			=> $this -> input -> post('comment')
									);
				// if id is not set then set tmp id
				if($id != 0)
				{
					$tmp = $id;
					$parameters['employee_id'] = $id;
				}
				if($parameters['current_status'] == "Resigned")
				{
					$end_date = $this -> input -> post('end_date');
					if(trim($end_date) != "" || trim($end_date) != "0000-00-00")
					{
						$parameters['end_date'] = trim($end_date);
					}
				}
				else
				{
					$parameters['end_date'] = NULL;
				}
				$dob = $this -> input -> post('dob');
				// setting end date if user current status is resigned

				if(trim($dob) != "" || trim($dob) != "0000-00-00")
				{
					$parameters['dob'] = trim($dob);
				}
				// function call for checking validation true or false
				$result = $this -> check_validation('employee_detail');

				if($result != false)
				{
					// checking for end date is set or not
					if($parameters['end_date'] != 0)
					{
						// checking with end date is proper or not
						if($parameters['end_date'] < $parameters['start_date'] || $parameters['end_date'] == '0000-00-00')
						{
							// set error message if end date is not valid
							$parameters['error_msg'] = "Please enter valid end date.";
						}
						else
						{
							$parameters = $this -> unset_array($parameters);
							$this -> Employees -> update($parameters);
							redirect('employee');
						}
					}
					else
					{
						$parameters = $this -> unset_array($parameters);
						$this -> Employees -> update($parameters);
						redirect('employee');
					}
				}
				$parameters['query'] = $this -> Employees -> update_user($tmp);
				$parameters['title'] = "Update employee";
				$this->load_view('employee/updateemployee', $parameters);
			}

			/**
			 * @function getsearchsalary
			 * @param $id string
			 * @return void
			 *
			 * this function is for get data from database and view as search result by min-max salary
			 */
			public function view_employee_detail($id = "")
			{
				$parameters['query'] = $this -> Users -> update_user($id);
				$parameters['query1'] = $this -> Employees -> update_user($id);
				$parameters['title'] = "Update employee";
				$this->load_view('employee/view_employee_detail', $parameters);
			}

		}
	?>