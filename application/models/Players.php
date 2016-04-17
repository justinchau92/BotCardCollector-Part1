<?php

	class Players extends CI_Model {
		function __construct(){
			parent::__construct();
		}
		//returns array of all players
		function all() 
		{
			$this->db->order_by('Player', 'Peanuts');
			$query = $this->db->get('Players');
			return $query->result_array();
		}
		//returns array of specific player
		function getPlayer($player)
		{
			$st="Player = '".$player."'";
			$this->db->where($st, NULL, FALSE);  
			$player_array = $this->db->get('players')->result_array();
			return $player_array;

		}
		//check credentials
		function logon($user, $password)
		{
			$this->db->order_by('Player', 'Password');
			$st="Player='".$user."' AND Password = '".$password."'";
  			$this->db->where($st, NULL, FALSE);  
			$query = $this->db->get('Players');
			if(sizeof($query->result_array()) > 0){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
	

	}