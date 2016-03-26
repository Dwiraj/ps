	<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	 /**
		* @Class User
	 	*
		* @package		CodeIgniter
	 	* @subpackage	Controller 
	 	* @category		
	 	* @author		Dwiraj Chauhan <dwiraj.k.chauhan25@gmail.com>
	 	* @link			localhost
		*/
	class User extends MY_Controller 
		{
			public function __construct()
			{
				parent::__construct();
			}

		/**
		 * @function index
		 * @param
		 * @return void
		 *
		 * this function show login view file as default
		 */
			public function index()
			{
				// check session sets or not 
				if($this -> session -> userdata('logged_in'))
				{
					redirect('user/welcome');	
				}
				$this -> login();
			}

		/**
		 * @function login
		 * @param
		 * @return void
		 *
		 * this function get data from login form and check them
		 */
			public function login()
			{
				// retrieve cookie 
				$uid = $this->input->cookie('login_email',TRUE);
		 		if (isset($uid)) 
		 		{
		 			// get data of user 
		 			$value = $this -> Users -> update_user($uid);
		 			// set session from cookie
		  			$this -> session -> set_userdata('logged_in',$value);
		  			// update last login of user
					$this -> Users -> last_login($uid);
					redirect('user/welcome');
		 		}	
				// get data from login form with post method
				$parameters = array(	
									'email' 	=> $this -> input -> post('email'),
									'password' 	=> $this -> input -> post('password')
									);
		
				$parameters['title'] = "User login";
				// Set form validation rules for each field
				$result = $this -> check_validation('login');
		
				// check for validation successful or not
				if($result == true)
				{
					// check user is valid or not
					$row = $this -> Users -> authenticate($parameters);
					if($row != false)
					{
						$last_login = $row -> last_login;
						if($last_login == "" || $last_login == "0000-00-00 00:00:00")
						{
							$last_login = "This is your first login";
						}
						else
						{
							$last_login = "Last login: ".date('jS F Y, g:i a', strtotime($row -> last_login));
						}
						// set values in array to set session
						$sess_array = array(
											'id' 		=> $row -> id,
											'first_name'=> $row -> first_name,
											'user_level'=> $row -> user_level,
											'last_login'=> $last_login
											);
						
						// set cookie if user checked remember me check box
						$remember = $this -> input -> post('rememberme');
						if ($remember !='') 
						{
							// array of user detail to store in cookie
							$cookie = array(
											'name'  => 'login_email',
											'value' => $row -> id,
											'expire'=> '3600',
											'path'  => '/'
											);
							// set cookie with $cookie array
							$this->input->set_cookie($cookie); 
						}
						// set session of user login 
						$this -> session -> set_userdata('logged_in',$sess_array);
	
						// update last login of user
						$this -> Users -> last_login($row -> id);
						redirect('user/welcome');
					}
					else
					{
						$parameters['error_msg'] = "Invalid email or password";
						$this->load_view('user/login', $parameters);
					}
				}
				else
				{
					$this->load_view('user/login', $parameters);
				}
			}
		

		/**
		 * @function welcome
		 * @param
		 * @return void
		 *
		 * print welcome message
		 */
			public function welcome()
			{
				
				$test = $this -> session -> userdata['logged_in']['user_level'];
		
				// condition for check user login or admin
				if($test == 1) 
				{
					if($this -> check_login() != 1)
					{
						redirect('user/logout');
					}
					else
					{
						$parameters['title'] = "User user";
						$this->load_view('user/welcome', $parameters);
					}
				} 
				else 
				{
					if($this -> check_login() != 2)
					{
						redirect('user/logout');
					}
					else
					{
						redirect('admin/welcome');
					}
				}
			}

		/**
		 * @function profile()
		 * @param
		 * @return void
		 *
		 *	this method is use for create a employee profile and show it's view file
		 */
			public function profile()
			{
				$this -> check_login();
				$id = $this -> session -> userdata['logged_in']['id'];
				$parameters['query'] 	= $this -> Users -> update_user($id);
				$parameters['query1']	= $this -> Employees -> update_user($id);
				if (empty($parameters['query1'])) 
				{
					$parameters['query1'] = "Not Set";
				}
				else
				{
					$notProvided = "<span class='h6'>(Not provideed)</span>";
					$parameters['position'] 		= $notProvided;
					$parameters['current_status'] 	= $notProvided;
					$parameters['contact'] 			= $notProvided;
					$parameters['address'] 			= $notProvided;
	        		$parameters['start_date'] 		= $notProvided;
	        		$parameters['dob'] 				= $notProvided;
					$parameters['profile_picture'] 	= "logo.ico";
	        		if(! empty($parameters['query1'] -> phone_no) || ! empty($parameters['query1'] -> alternate_no))
	        		{
	          			if(! empty($parameters['query1'] -> alternate_no))
	          			{
	              			$parameters['contact'] = "+91-".$parameters['query1'] -> phone_no."/".$parameters['query1'] -> alternate_no;
	          			}
	          			else
	          			{
	              			$parameters['contact'] = "+91-".$parameters['query1'] -> phone_no;
	          			}
	        		}
	        		if($parameters['query1'] -> start_date != "0000-00-00" || $parameters['query1'] -> start_date != "" || $parameters['query1'] -> start_date != null)
	        		{
	            		$parameters['start_date'] = date("d-m-Y", strtotime($parameters['query1'] -> start_date));
	            		if($parameters['start_date'] == "01-01-1970")
	            		{
	            			$parameters['start_date'] = "<span class='h6'>(Not provideed)</span>";
	            		}
	        		}
	        		if($parameters['query1'] -> dob != "0000-00-00" || $parameters['query1'] -> dob != "" || $parameters['query1'] -> dob != null)
	        		{
	           			$parameters['dob'] = date("d-m-Y", strtotime($parameters['query1'] -> dob));
	           			if($parameters['dob'] == "01-01-1970")
	           			{
	           				$parameters['dob'] = "<span class='h6'>(Not provideed)</span>";
	           			}
					}
	        		if(! empty($parameters['query1'] -> position))
	        		{
	            		$parameters['position'] = $parameters['query1'] -> position;
	        		}
	        		if(! empty($parameters['query1'] -> address))
	        		{
	            		$parameters['address'] = $parameters['query1'] -> address;
	        		}
	        		if(! empty($parameters['query1'] -> current_status))
	        		{
	            		$parameters['current_status'] = $parameters['query1'] -> current_status;
	        		}
	        		if(! empty($parameters['query1'] -> profile_picture))
	        		{
						$parameters['profile_picture'] = $parameters['query1'] -> profile_picture;
	        		}
				}
				$parameters['title'] 	= "View profile";
				$this -> load_view('profile', $parameters);
			}

		/**
		 * @function createprofile()
		 * @param
		 * @return void
		 *
		 * this method is use for create a employee profile from employee side
		 */
			public function createprofile()
			{
				$this -> check_login();
				$id = $this -> session -> userdata['logged_in']['id'];
				if($_SERVER["REQUEST_METHOD"] == "POST")
				{
					$parameters = array(												
										'employee_id'		=> $id,
										'address'			=> $this -> input -> post('address'),
										'dob'				=> $this -> input -> post('dob'),
										'phone_no'			=> $this -> input -> post('mobile'),
										'alternate_no'		=> $this -> input -> post('other'),
										'pan_no'			=> $this -> input -> post('pan'),
										'bank_account_no' 	=> $this -> input -> post('bank_acc'),
										'profile_picture' 	=> "logo.ico"
										);
					$result = $this -> Employees -> addemployee($parameters);
					if($result > 0)
					{
						redirect('user/profile');
					}
				}
				$parameters['title'] 	= "View profile";
				$this -> load_view('user/addprofile', $parameters);
			}

		/**
		 * @function change_password()
		 * @param
		 * @return void
		 *
		 * this method is use for change user password
		 */
			public function change_password()
			{
				$this -> check_login();
				$parameters = array(
									'oldpassword' 	=> md5($this -> input -> post('oldpassword')),
									'newpassword'	=> md5($this -> input -> post('newpassword')),
									'cpassword'		=> md5($this -> input -> post('cpassword'))
									);
				$this -> form_validation -> set_rules('oldpassword', 'old password', 'trim|required');
				$this -> form_validation -> set_rules('newpassword', 'new password', 'trim|required|matches[cpassword]');
				$this -> form_validation -> set_rules('cpassword', 'confirm password', 'trim|required');

				if ($this->form_validation->run() == true) 
				{
					$id = $this -> session -> userdata['logged_in']['id'];
					$query 	= $this -> Users -> update_user($id);
					if($query -> password == $parameters['oldpassword'])
					{
						$this -> Users -> change_password($parameters['newpassword']);
						$message = "Your password changed successfully..!!!";
 						echo "<script type='text/javascript'>alert('$message'); window.location.href='".base_url('user/welcome')."';  </script>";
					}
					else
					{
						$parameters['error_msg'] = "Invalid old password";
					}
				}
				$parameters['title'] = "Change password";
				$this -> load_view('change_password', $parameters);
			}

		/**
		 * @function photo_upload
		 * @param
		 * @return void
		 *
		 * This method use  to upload profile picture
		 */
			public function photo_upload()
			{
				$id 					= $this -> session -> userdata['logged_in']['id'];
				$config['upload_path'] 	= './assets/image/';
				chmod($config['upload_path'], 777);
				$config['allowed_types']= 'gif|jpg|png';
				$config['file_name'] 	= $id;
				$config['overwrite'] 	= TRUE;
				$config['max_size']		= '100';
				$config['max_width']  	= '1024';
				$config['max_height']  	= '768';

				$this->load->library('upload', $config);

				if ( ! $this -> upload -> do_upload())
				{
					$error = $this -> upload -> display_errors();
 					echo "<script type='text/javascript'>alert('$error'); window.location.href='".base_url('user/profile')."'; </script>";
				}
				else
				{
					$data = array('upload_data' => $this -> upload -> data());
					$this -> Employees -> add_image($data['upload_data'], $id);
					redirect('user/profile');
					/*echo "<script type='text/javascript'>
								alert('Your profile picture set successfully...!!!');
					 			window.location.href='".base_url('user/profile')."';
							</script>";*/
				}
			}

		/**
		 * @function development
		 * @return void
		 *
		 * this function use to display message on page which is on development process
		 */
			public function development()
			{
				echo "<h1>This page is under development</h1>";
			}

		/**
		 * @function logout
		 * @param
		 * @return void
		 *
		 * delete session and logout user
		 */
			public function logout()
			{
				// unset session
				$this -> session -> unset_userdata('logged_in');
				// delete cookie function call from MY_Controller
				delete_cookie("login_email");
				redirect('user/login');
			}
			
	}
?>