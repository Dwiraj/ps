<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 /**
	* @Class Admin
 	*
	* @package 		CodeIgniter
 	* @subpackage	Controller
 	* @category		Controller
 	* @author		Dwiraj Chauhan <dwiraj.k.chauhan25@gmail.com>
 	* @link			localhost
	*/
 	class Admin extends MY_Controller
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
		 * this function show welcome view file as default
		 */
		public function index()
		{
			$this->welcome();
		}

		/**
		 * @function welcome
		 * @return void
		 *
		 * this function show welcome view file
		 */
		public function welcome()
		{
			// check if user login or not
			$parameters['event'] 		= $this -> Users -> event();
			$parameters['month_event'] 	= $this -> Users -> month_event();
			$parameters['title'] 		= "Admin welcome";
			$this->load_view('admin/welcome', $parameters);
		}

		/**
		 * @function adduser
		 * @return void
		 *
		 * this function show add user form and validate all fields
		 */
		public function adduser()
		{
			$parameters = array(
								'first_name'  	=> $this -> input -> post('first_name'),
								'last_name' 	=> $this -> input -> post('last_name'),
								'email' 		=> $this -> input -> post('email'),
								'password' 		=> md5($this -> input -> post('password')),
								'user_level' 	=> $this -> input -> post('user_level')
								);

			// function call for checking validation true or false
			$result = $this -> check_validation('add');

			if($result != false)
			{
				// check for user is already exist or not
				if($this -> Users -> add_user_exist($parameters) == true)
				{
					$parameters = $this -> unset_array($parameters);
					// add user detail to database
					$this -> Users -> adduser($parameters);
					if($parameters['user_level'] == '1')
						redirect('employee');
					else
						redirect('admin-list');
				}
				else
				{
					// set error message for user is exist
					$parameters['error_msg'] = "User is already registered try with different email";
				}
			}
			else
			{
				$password  = $this -> input -> post('password');
				$cpassword = $this -> input -> post('cpassword');

				// check password and confirm password
				if($password != $cpassword)
				{
					$parameters['error_msg'] = "Please enter same password";
				}
			}
			$parameters['type'] = $this -> input -> post('user_level');
			$parameters['title']= "Add new user";
			$this->load_view('admin/adduser', $parameters);
		}

		/**
		 * @function view_admin
		 * @return void
		 *
		 * Show all admin to admin
		 */
		public function viewadmin()
		{
			$parameters['query'] = $this -> Users -> get_admins();
			$parameters['title'] = "View all admin";
			$this -> load_view('admin/manageuser', $parameters);
		}

		/**
		 * @function deleteuser
		 * @param int $id
		 * @return void
		 *
		 * delete user from database
		 */
		public function deleteuser($id)
		{
			$this -> Users -> delete_user($id);
			redirect('employee');
		}

		/**
		 * @function	update
		 * @param int $id
		 * @return void
		 *
		 * update user detail to database
		 */
		public function update($id = 0)
		{
			$parameters = array(
								'id'		 => $this -> input -> post('uid'),
								'first_name' => $this -> input -> post('first_name'),
								'last_name'	 => $this -> input -> post('last_name'),
								'email'		 => $this -> input -> post('email'),
								'user_level' => $this -> input -> post('user_level')
								);

			$result = $this -> check_validation('update');

			if($id == 0)
			{
				$tmp = $parameters['id'];
			}
			else
			{
				$tmp = $id;
			}

			if($result != false)
			{
				if($this -> Users -> user_exist($parameters) == true)
				{
					$parameters = $this -> unset_array($parameters);
					$this -> Users -> update($parameters);
					if($parameters['user_level'] == 2)
					{
						redirect('admin-list');
					}
					else
					{
						redirect('employee');
					}
				}
				else
				{
					$parameters['error_msg'] = "User is already registered";
				}
			}
			$parameters['query'] = $this -> Users -> update_user($tmp);
			$parameters['title'] = "update user";
			$this -> load_view('admin/update', $parameters);
		}

		/**********************************************************************************/
		public function ajax_list()
		{
			$list = $this->Users->get_datatables($_POST['level']);
			$data = array();
			$no = $_POST['start'];
			if($_POST['level'] == 2) {
				foreach ($list as $user) {
					$no++;
					$row = array();
					$row[] = $user->id;
					$row[] = $user->first_name;
					$row[] = $user->last_name;
					$row[] = $user->email;
					$row[] = $user->last_login ? date('jS F Y, g:i a', strtotime($user->last_login)) : "Not Login yet";

					//add html for action
					$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit('."'".$user->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					          <a class="btn btn-sm btn-danger" href="javascript:void()" title="Delete" onclick="delete_user('."'".$user->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

					$data[] = $row;
				}
			} else {
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
					$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit('."'".$employee->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  			  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_user('."'".$employee->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

					$data[] = $row;
				}
			}

			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->Users->count_all($_POST['level']),
				"recordsFiltered" => $this->Users->count_filtered($_POST['level']),
				"data" => $data,
			);
			//output to json format
			echo json_encode($output);
		}

		public function admin_add()
		{
			$parameters = $this->parameters();
			if ($this->check_validation("add")) {
				if ($this->Users->save($parameters))
					echo json_encode(array("status" => TRUE));
				else
					echo json_encode(array("status" => FALSE, 'errors' => 'sorry something went wrong, user can not insert at this time'));
			} else {
				echo json_encode(array("status" => FALSE, 'errors' => validation_errors()));
			}
		}

		public function edit($id)
		{
			$data = $this->Users->get_by_id($id);
			echo json_encode($data);
		}

		public function admin_update()
		{
			$parameters = $this->parameters();
			$page = "update";
			if(!empty($this->input->post('password')) && $this->input->post('password') == $this->input->post('cpassword'))
			{
				$page = "add";
				$parameters['password'] = md5($this -> input -> post('password'));
			}
			if ($this->check_validation($page)) {
				if ($this->Users->update(array('id' => $this->input->post('id')), $parameters))
					echo json_encode(array("status" => TRUE));
				else
					echo json_encode(array("status" => FALSE, 'errors' => 'sorry something went wrong, user can not update at this time'));
			} else {
				echo json_encode(array("status" => FALSE, 'errors' => validation_errors()));
			}
		}

		public function ajax_delete($id)
		{
			if($this->Users->delete_by_id($id))
				echo json_encode(array("status" => TRUE));
			else
				echo json_encode(array("status" => FALSE, 'errors' => 'sorry something went wrong, user can not deleted at this time'));

		}

		public  function parameters() {
			if($this -> input -> post('level') == 2) {
				$parameters = array(
					'first_name' 		=> $this->input->post('first_name'),
					'last_name' 		=> $this->input->post('last_name'),
					'email' 			=> $this->input->post('email'),
					'user_level' 		=> 2
				);
			} else {

				$parameters = array(
					'first_name' 		=> $this->input->post('first_name'),
					'last_name' 		=> $this->input->post('last_name'),
					'email' 			=> $this->input->post('email'),
					'user_level' 		=> 1,
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
			}
			return $parameters;
		}
	}
?>