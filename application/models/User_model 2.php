<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class User_model extends CI_Model{
		// Log in
		public function login($username, $password){
			// Validate
			$this->db->where('username', $username);
            $this->db->where('password', $password);
            
			$result = $this->db->get('users');

			if($result->num_rows() == 1){
				return true;
			} else {
				return false;
			}
		}

		// Check username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('username', array('username' => $username));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}
	}