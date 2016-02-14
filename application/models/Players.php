<?php

	class Players extends CI_Model {
		function __construct(){
			parent::__construct();
		}

		function all() 
		{
			$this->db->order_by('Player', 'Peanuts');
			$query = $this->db->get('Players');
			return $query->result_array();
		}

	}