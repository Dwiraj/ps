	<?php 

	 /**
		* @Class 				Employees
		* @package			CodeIgniter
	 	* @subpackage		Model
	 	* @category			Model
	 	* @author				Dwiraj Chauhan
	 	* @link					localhost
		*/
		class Employees extends CI_Model
		{

		 /**
			* @function addemployee
			* @param array $parameters
			*	@return string
			*
			* this function is for insert new user to database
			*/
			public function addemployee($parameters)
			{
				$result = $this -> db -> insert('employees', $parameters);
				return $result;
			}

		/**
			* @function get_data
			*	@return array
			*
			* this function is for show user list to admin only
			*/
			public function get_data()
			{
				$this -> db -> select('*');
				$this -> db -> from('employees');
				$this -> db -> join('users', 'employees.employee_id = users.id', 'right');
				$this -> db -> where('user_status', 'Active');
				$this -> db -> where('user_level', '1');
				$this -> db -> order_by("first_name", "asc");
				$query = $this -> db -> get(); 
	 			if($query -> num_rows() >= 0)
				{
				  return $query->result_array();
		   	}
		   	else
				{
				  return false;
				}
				
			}

		 /**
			* @function get_search
			* @param array
			*	@return array
			*
			* this function is for show search result to table
			*/
			public function get_search($data)
			{
				$this -> db -> select('*');
				$this -> db -> from('users');
				$this -> db -> join('employees', 'users.id = employees.employee_id', 'left outer');
				$this -> db -> where('user_status', 'Active');
				$this -> db -> where('user_level', '1');
				$this -> db -> like($data['searchtype'], $data['searchkeyword']);
				$this -> db -> order_by("first_name", "asc");
				$query = $this -> db -> get();
				return $query->result_array();
			}

		 /**
			* @function get_search_name
			* @param array
			*	@return array
			*
			* this function is for show search from name as result to table
			*/
			public function get_search_name($data)
			{
				$this -> db -> select('*');
				$this -> db -> from('users');
				$this -> db -> join('employees', 'users.id = employees.employee_id', 'left outer');
				$this -> db -> where('user_status', 'Active');
				$this -> db -> where('user_level', '1');
				$this -> db -> like('CONCAT(users.first_name, " ",users.last_name)', $data['searchkeyword']);
				$this -> db -> order_by("first_name", "asc");
				$query = $this -> db -> get();
				return $query->result_array();
			}

		 /**
			* @function get_searchsalary
			* @param array
			*	@return array
			*
			* this function is for show search result to table by min-max salary 
			*/
			public function get_searchsalary($data)
			{
				$this -> db -> select('*');
				$this -> db -> from('users');
				$this -> db -> join('employees', 'users.id = employees.employee_id', 'left outer');
				$this -> db -> where('user_status', 'Active');
				$this -> db -> where('user_level', '1');
				$this -> db -> where(''.$data['searchtype'].'>=', $data['min']); 
				$this -> db -> where(''.$data['searchtype'].'<=', $data['max']); 
				$this -> db -> order_by("first_name", "asc");
				$query = $this -> db -> get();
				return $query->result_array();
			}

		 /**
			* @function user_exist
			* @param int
			*	@return boolean
			*
			* this function is for check into database that user is already exist 
			*/
			public function user_exist($id)
			{
				$this -> db -> select('employee_id');
	 			$this -> db -> from('employees');
				$this -> db -> join('users', 'employees.employee_id = users.id');
	 			$this -> db -> where('employee_id', $id);
				$this -> db -> where('user_status', 'Active');
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
			* @function update_user
			* @param int
			*	@return array
			*
			* this function is for get single user data from database to update form
			*/
			public function update_user($id)
			{
				$this -> db -> select('*');
				$this -> db -> from('employees');
	 			$this -> db -> where('employee_id', $id);
				$query = $this -> db -> get();
				return $query->row();
			}

		 /**
			* @function update
			* @param array
			*	@return void
			*
			* this function is for update single user in database
			*/
			public function update($parameters)
			{
				$this	-> db -> where('employee_id', $parameters['employee_id']);
				$this	-> db -> update('employees', $parameters);
			} 

		 /**
			* @function add_image
			* @param array
			*	@return void
			*
			* this function is for update single user in database
			*/
			public function add_image($data, $id)
			{
				$this	-> db -> where('employee_id', $id);
				$this	-> db -> update('employees', array('profile_picture' => $data['file_name']));
			} 
		}
	?>