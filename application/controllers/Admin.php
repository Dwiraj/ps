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
			$parameters['query'] = $this -> Users -> get_data();
			$parameters['title'] = "View all admin";
			$this -> load_view('admin/manageuser', $parameters);
		}

		public function get_admin_list()
		{
			// DB table to use
			$table = 'users';

			// Table's primary key
			$primaryKey = 'id';

			// Array of database columns which should be read and sent back to DataTables.
			// The `db` parameter represents the column name in the database, while the `dt`
			// parameter represents the DataTables column identifier. In this case simple
			// indexes
			$columns = array(
				array( 'db' => 'id', 'dt' => 0 ),
				array( 'db' => 'first_name', 'dt' => 1 ),
				array( 'db' => 'last_name',  'dt' => 2 ),
				array( 'db' => 'email',   'dt' => 3 ),
				array(
					'db' => 'last_login',
					'dt' => 4,
					'formatter' => function( $d, $row ) {
						return date( 'jS M y', strtotime($d));
					}
				),
				array(
					'db' => 'last_login',
					'dt' => 5,
					'formatter' => function( $d, $row ) {
						$a = '<a href="admin/update/'. $row[0] .'"><button class="btn btn-info">Edit</button></a>
							  <a href="admin/deleteuser/'.$row[0].'"><button class="btn btn-danger btn-red">Delete</but		ton></a>';
						return $a;
					}
				)
			);

			// SQL server connection information
			$sql_details = array(
				'user' => 'root',
				'pass' => '',
				'db'   => 'ps',
				'host' => 'localhost'
			);


			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
             * If you just want to use the basic configuration for DataTables with PHP
             * server-side, there is no need to edit below this line.
             */

			include(APPPATH.'third_party/SSP.php' );

			echo json_encode(
				SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
			);
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
			$list = $this->Users->get_datatables();
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $user) {
				$no++;
				$row = array();
				$row[] = $user->id;
				$row[] = $user->first_name;
				$row[] = $user->last_name;
				$row[] = $user->email;
				$row[] = $user->last_login ? date('jS F Y, g:i a', strtotime($user->last_login)) : "Not Login yet";

				//add html for action
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$user->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$user->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

				$data[] = $row;
			}

			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->Users->count_all(),
				"recordsFiltered" => $this->Users->count_filtered(),
				"data" => $data,
			);
			//output to json format
			echo json_encode($output);
		}

		public function ajax_edit($id)
		{
			$data = $this->Users->get_by_id($id);
			echo json_encode($data);
		}

		public function ajax_add()
		{
			$parameters = array(
				'first_name'  	=> $this -> input -> post('first_name'),
				'last_name' 	=> $this -> input -> post('last_name'),
				'email' 		=> $this -> input -> post('email'),
				'password' 		=> md5($this -> input -> post('password')),
				'user_level' 	=> $this -> input -> post('user_level')
			);
			$insert = $this->Users->save($parameters);
			echo json_encode(array("status" => TRUE));
		}

		public function ajax_update()
		{

			$parameters = array(
				'first_name'  	=> $this -> input -> post('first_name'),
				'last_name' 	=> $this -> input -> post('last_name'),
				'email' 		=> $this -> input -> post('email'),
				'user_level' 	=> $this -> input -> post('user_level')
			);
			if(!empty($this->input->post('password')) && $this->input->post('password') == $this->input->post('cpassword'))
			{
				$parameters['password'] = md5($this -> input -> post('password'));
			}
			$this->Users->update(array('id' => $this->input->post('id')), $parameters);
			echo json_encode(array("status" => TRUE));
		}

		public function ajax_delete($id)
		{
			$this->Users->delete_by_id($id);
			echo json_encode(array("status" => TRUE));
		}

	}
?>