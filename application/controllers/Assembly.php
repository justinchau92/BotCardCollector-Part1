<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assembly extends Application {

	

	
	public function index()
	{
            $this->load->library('session');
		$this->load->model('Players');
		$this->load->model('Game');
            $this->load->model('MAssembly');
            $this->load->helper('form');
           

            $Head_list = $this->MAssembly->get_player_Head($this->session->userdata('username'));
            $this->data['Head'] = form_dropdown('Piece', $Head_list, set_value('Piece'),'id = "Head"');

            $Body_list = $this->MAssembly->get_player_Body($this->session->userdata('username'));
            $this->data['Body'] = form_dropdown('Piece', $Body_list, set_value('Piece'),'id = "Body"');

            $Leg_list = $this->MAssembly->get_player_Leg($this->session->userdata('username'));
            $this->data['Leg'] = form_dropdown('Piece', $Leg_list, set_value('Piece'),'id = "Leg"');
            
		$this->data['assemble'] = "No bot selected";
            $this->data['user'] = $this->session->userdata('username');
            $this->data['pagebody'] = 'assembly';
            $this->render();

	}


      public function assemble($num1, $num2, $num3)
      {
            $this->load->library('session');
            $this->load->model('Players');
            $this->load->model('Game');
            $this->load->model('MAssembly');
            $this->load->helper('form');
           

            $Head_list = $this->MAssembly->get_player_Head($this->session->userdata('username'));
            $this->data['Head'] = form_dropdown('Piece', $Head_list, set_value('Piece'),'id = "Head"');

            $Body_list = $this->MAssembly->get_player_Body($this->session->userdata('username'));
            $this->data['Body'] = form_dropdown('Piece', $Body_list, set_value('Piece'),'id = "Body"');

            $Leg_list = $this->MAssembly->get_player_Leg($this->session->userdata('username'));
            $this->data['Leg'] = form_dropdown('Piece', $Leg_list, set_value('Piece'),'id = "Leg"');


            $assem = $this->MAssembly->get_complete($num1, $num2, $num3, $this->session->userdata('username'));

            foreach($assem as $assembled)
                  $assemblecells[] = $this->parser->parse('_collectioncell', (array) $assembled, true);

            $this->load->library('table');
            $assemble_parms = array(
                  'table_open'            => '<table class="Assembled_table">',
                  'cell_start'            => '<td class="Assembled">',
                  'cell_alt_start'        => '<td class="Assembled">'
            );
            $this->table->set_template($assemble_parms);

            $assemble_rows = $this->table->make_columns($assemblecells, 1);
            $this->data['assemble'] = $this->table->generate($assemble_rows);



            
            
            $this->data['user'] = $this->session->userdata('username');
            $this->data['pagebody'] = 'assembly';
            $this->render();

      }

    
}
