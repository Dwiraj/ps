<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 /**
	* @Class Admin
 	*
	* @package CodeIgniter
 	* @subpackage	Controller
 	* @category	Controller
 	* @author	Dwiraj Chauhan
 	* @link	localhost
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
		$parameters['event'] = $this -> Users -> event();
		$parameters['month_event'] = $this -> Users -> month_event();
		$parameters['css'] =  array('core', 'bootstrap.min');
		$parameters['js'] =  array('jquery-2.1.4.min','bootstrap.min');
		$parameters['title'] 	= "Admin welcome";
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
												'first_name'  => $this -> input -> post('first_name'),
												'last_name' 	=> $this -> input -> post('last_name'),
												'email' 			=> $this -> input -> post('email'),
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
				redirect('admin/manageuser');
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
		$parameters['css'] 		=  array('core', 'bootstrap.min');
		$parameters['js'] 		= array('jquery-2.1.4.min','form_validation', 'bootstrap.min');
		$parameters['title'] 	= "Add new user";
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
		$parameters['query'] 	= $this -> Users -> get_data();
		$parameters['css'] 		=  array('core', 'bootstrap.min');
		$parameters['js'] 		= array('jquery-2.1.4.min','table_search', 'bootstrap.min');
		$parameters['title'] 	= "View all admin";
		$this -> load_view('admin/manageuser', $parameters);
	}

 /**
	*	@function deleteuser
	*	@param int $id
	* @return void
	*
	*	delete user from database
	*/
	public function deleteuser($id)
	{
		$this -> Users -> delete_user($id);
		redirect('employee');
	}

/**
	*	@function	update
	*	@param int $id
	* @return void
	*	
	*	update user detail to database
	*/
	public function update($id = 0)
	{
		$parameters = array(
												'id'				 => $this -> input -> post('uid'),
												'first_name' => $this -> input -> post('first_name'),
												'last_name'	 => $this -> input -> post('last_name'),
												'email'			 => $this -> input -> post('email'),
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
		$parameters['query'] 	= $this -> Users -> update_user($tmp);
		$parameters['css'] 		=  array('core', 'bootstrap.min');
		$parameters['js'] 		= array('jquery-2.1.4.min','form_validation', 'bootstrap.min');
		$parameters['title'] 	= "update user";
		$this -> load_view('admin/update', $parameters);			
	}

}
?>