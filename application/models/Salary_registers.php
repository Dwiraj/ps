	<?php 

	 /**
		* @Class 				Salary_registers
		* @package			CodeIgniter
	 	* @subpackage		Model
	 	* @category			Model
	 	* @author				Dwiraj Chauhan
	 	* @link					localhost
		*/
	 	class Salary_registers extends CI_Model
	 	{

	 /**
		* @function get_register_list()
		* @param 
		*	@return array
		* 
		* this function is use for show list of all distinct month of year's salary register store in database
		*/
		public function get_register_list()
		{
			$this -> db -> distinct();
			$this -> db -> select('month, year, created_by, created_date,	last_updated_by,	last_updated');
			$this -> db -> from('salary_registers');
			$this -> db -> order_by("year", "desc");
			$this -> db -> order_by("month", "desc");
			$query = $this -> db -> get();
			return $query->result_array();
		}

	 /**
		* @function getlist()
		* @param array $parameters
		*	@return array
		* 
		* this function is use for show single row of salary register of specific  month and year 
		* for salary register store in database
		*/
		public function getlist($parameters)
		{
			$this -> db -> select('*');
			$this -> db -> from('salary_registers');
			$this -> db -> join('users', 'salary_registers.employee_id = users.id');
			$this -> db -> join('employees', 'salary_registers.employee_id = employees.employee_id');
			$this -> db -> where('user_status', 'Active');
			$this -> db -> where('user_level', '1');
			$this -> db -> where('month', $parameters['month']);
			$this -> db -> where('year', $parameters['year']);
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
		* @function createlist()
		* @param 
		*	@return array
		* 
		* this function is use for show list of all users to create salary register
		*/
		public function createlist($parameters)
		{

			$data = "SELECT * FROM employees JOIN users WHERE employees.employee_id = users.id AND start_date <= ? AND (current_status='Working' OR (current_status='Resigned' AND end_date >= ?)) ORDER BY first_name ASC ";
			
			$day = date("t", strtotime($parameters['year']."-".$parameters['year']."-01"));
			$query = $this -> db -> query($data, array("".$parameters['year']."-".$parameters['month']."-".$day."", "".$parameters['year']."-".$parameters['month']."-01"));
			return $query->result_array();
		}

	 /**
		* @function add_salary_register()
		* @param 
		*	@return array
		* 
		* this function is use for insert rows of salary register of specific  month and year 
		* for salary register and store it in database
		*/
		public function add_salary_register($parameters, $n)
		{
			for($i=1; $i<=$n; $i++)
			{
				$query = $this -> db -> insert('salary_registers', $parameters[$i]);
			}
			return $query;
		}

	 /**
		* @function update_salary_register()
		* @param array $parameters
		* @param string $index
		*	@return array
		* 
		* this function is use for update single row of salary register of specific  month and year 
		* for salary register store in database
		*/
		public function update_salary_register($parameters, $index)
		{
			for($i=1; $i<=$index; $i++)
			{
				$this	-> db -> where('employee_id', $parameters[$i]['employee_id']);
				$this	-> db -> where('month', $parameters[$i]['month']);
				$this	-> db -> where('year', $parameters[$i]['year']);
				$query = $this	-> db -> update('salary_registers', $parameters[$i]);
			}
			return $query;
		}

	 /**
	  * @function employee_salary_report
	  * @param array $parameters
	  * @return array 
	  *
	  * this method is use for the fetch data of employee salary record from database 
	  */
	 public function employee_salary_report($parameters)
	 {

	 	$m = $parameters['s_month'];
	 	$result = array();
	 	for($i = $parameters['s_year']; $i <= $parameters['e_year']; $i++)
	 	{
	 		for ($j=$m; $j <= 12; $j++) 
	 		{ 
	 			$this -> db -> select('*');
	 			$this -> db -> from('salary_registers');
	 			$this -> db -> where('employee_id', $parameters['employee_id']);
	 			$this -> db -> where("month", $j);
	 			$this -> db -> where("year", $i);
	 			$query = $this -> db -> get();
	 			array_push($result, $query->result_object());
	 			if($i == $parameters['e_year'] && $j == $parameters['e_month'])
	 			{
	 				break;
	 			}
	 			
	 		}
	 		if($i != $parameters['e_year'])
	 		{
	 			$m = 1;
	 		}
	 	}
	 	return $result;
	 }

	 /**
		* @function delete_salary_register()
		* @param string $month 
		* @param string $year
		*	@return array
		* 
		* this function is use for delete salary register of specific month and year
		*/
		public function delete_salary_register($month, $year)
		{
			$this	-> db -> where('month', $month);
			$this	-> db -> where('year', $year);
			$query = $this -> db -> delete('salary_registers');
			return $query;
		}

	 /**
		* @function employee_tds_report()
		* @param array $parameters
		*	@return array
		* 
		* this function is use for show employees TDS report as in pdf
		*/
		public function employee_tds_report($parameters)
		{
			$this -> db -> select('*');
			$this -> db -> from('salary_registers');
			$this -> db -> join('users', 'salary_registers.employee_id = users.id');
			$this -> db -> join('employees', 'salary_registers.employee_id = employees.employee_id');
			$this -> db -> where('user_status', 'Active');
			$this -> db -> where('user_level', '1');
			$this -> db -> where('tds!=', '0');
			$this -> db -> where('month', $parameters['month']);
			$this -> db -> where('year', $parameters['year']);
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
	}
	?>