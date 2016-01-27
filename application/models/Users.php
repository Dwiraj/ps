	<?php 

	 /**
		* @Class 				Users
		* @package			CodeIgniter
	 	* @subpackage		Model
	 	* @category			
	 	* @author				Dwiraj Chauhan
	 	* @link					localhost
		*/
		class Users extends CI_Model
		{
		 /**
			* @function authenticate()
		* @param string $parameters
		*	@return array
			*
			* this function is for login and check email and password
			*/
			public function authenticate($parameters)
			{
				$this -> db -> select('*');
	 			$this -> db -> from('users');
	 			$this -> db -> where('email', $parameters['email']);
	 			$this -> db -> where('password', md5($parameters['password']));
				$this -> db -> where('user_status', 'Active');
	 			$this -> db -> limit(1);
	 			
	 			$query = $this -> db -> get();
	 			if($query -> num_rows() == 1)
				{
				  return $query->row();
		   	}
		   	else
				{
				  return false;
				}
			}

		 /**
			* @function get_data()
			* @param
			*	@return array
			*
			* this function is for show user list to admin only
			*/
			public function get_data()
			{
				$this -> db -> select('*');
				$this -> db -> from('users');
				$this -> db -> where('user_level', '2');
				$this -> db -> where('user_status', 'Active');
				$this -> db -> order_by("user_level", "desc");
				$query = $this -> db -> get();
				return $query->result_array();
			}

		 /**
			*	@function update_user()
			* @param int $id
			*	@return array
			*
			* this function is for get single user data from database to update form
			*/
			public function update_user($id)
			{
				$this -> db -> select('*');
				$this -> db -> from('users');
	 			$this -> db -> where('id', $id);
				$query = $this -> db -> get();
				return $query->row();
			}

		 /**
			*	@function delete_user()
			* @param int $id
			*	@return void
			*
			* this function is to delete user from database
			*/
			public function delete_user($id)
			{
				// $this -> db -> delete ('users', array('id' => $id));
				
				$this -> db -> set('user_status', 'Deleted');
				$this	-> db -> where('id', $id);
				$this	-> db -> update('users');
			}

		 /**
			*	@function adduser()
			* @param array $parameters
			*	@return void
			*
			* this function is for insert new user to database
			*/
			public function adduser($parameters)
			{
				$this -> db -> insert('users', $parameters);
			} 

		 /**
			*	@function update()
			* @param array $parameters
			*	@return void
			*
			* this function is for update single user in database
			*/
			public function update($parameters)
			{
				$this	-> db -> where('id', $parameters['id']);
				$this	-> db -> update('users', $parameters);
			} 

		 /**
			*	@function last_login()
			* @param int $id
			*	@return void
			*
			* this function is used to update last login of user
			*/
			public function last_login($id)
			{
				$this -> db -> set('last_login', date('Y-m-d H:i:s'));
				$this	-> db -> where('id', $id);
				$this	-> db -> update('users');
			}

		 /**
			*	@function event()
			* @param 
			*	@return array
			*
			* this method is use for show birthdate event
			*/
			public function event()
			{
				$day = date("d");
				$month = date("m");
				$this -> db -> select('employee_id, first_name, last_name, dob');
	 			$this -> db -> from('employees');
	 			$this -> db -> join('users', 'employees.employee_id = users.id');
	 			$this -> db -> where('DAY(dob)', $day);
	 			$this -> db -> where('MONTH(dob)', $month);
	 			$this -> db -> order_by('first_name', 'asc');
	 			$query = $this -> db -> get();
	 			if($query -> num_rows() <= 0)
				{
				  return false;
		   		}
		   		else
				{
				  return $query -> result_array();
				}
			}

		 /**
			*	@function month_event()
			* @param 
			*	@return array
			*
			* this method is use for show birthdate event
			*/
			public function month_event()
			{
				$day = date("d");
				$month = date("m");
				$this -> db -> select('employee_id, first_name, last_name, dob');
	 			$this -> db -> from('employees');
	 			$this -> db -> join('users', 'employees.employee_id = users.id');
	 			$this -> db -> where('MONTH(dob)', $month);
	 			$this -> db -> where('DAY(dob)>=', $day);
	 			$this -> db -> order_by('first_name', 'asc');
	 			$query = $this -> db -> get();
	 			if($query -> num_rows() <= 0)
				{
				  return false;
		   		}
		   		else
				{
				  return $query -> result_array();
				}
			}

		 /**
			*	@function user_exist()
			* @param array $parameters
			*	@return boolean
			*
			* this function is used check user already exist or not
			*/
			public function user_exist($parameters)
			{
				$this -> db -> select('email');
	 			$this -> db -> from('users');
	 			$this -> db -> where('id!=', $parameters['id']);
	 			$this -> db -> where('email', $parameters['email']);
	 			$this -> db -> limit(1);

	 			$query = $this -> db -> get();
	 			if($query -> num_rows() > 0)
				{
				  return false;
		   	}
		   	else
				{
				  return true;
				}
			}

		 /**
			*	@function add_user_exist()
			* @param array $parameters
			*	@return boolean 
			*
			* this function is used check user already exist or not
			*/
			public function add_user_exist($parameters)
			{
				$this -> db -> select('email');
	 			$this -> db -> from('users');
	 			$this -> db -> where('email', $parameters['email']);
	 			$this -> db -> limit(1);

	 			$query = $this -> db -> get();
	 			if($query -> num_rows() > 0)
				{
				  return false;
		   	}
		   	else
				{
				  return true;
				}
			}

		 /**
			*	@function change_password()
			* @param string $password
			*	@return void
			*
			* this method is used to update password of user
			*/
			public function change_password($password)
			{
				$id = $this -> session -> userdata['logged_in']['id'];
				$this -> db -> set('password', $password);
				$this	-> db -> where('id', $id);
				$this	-> db -> update('users');
			}

		}
	?>