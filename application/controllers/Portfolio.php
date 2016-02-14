<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends Application {

	

	
	public function index()
	{
            $this->load->library('session');
		$this->load->model('Players');
		$this->load->model('Game');
            $this->load->model('Transaction');
            $this->load->helper('form');
            $user = $this->session->userdata('username');
            if("None" !==($user) ){
		    $tran = $this->Transaction->get_player_trans($this->session->userdata('username'));

		    foreach($tran as $trans)
            	$trancells[] = $this->parser->parse('_trancell', (array) $trans, true);

                  $this->load->library('table');
                  $trans_parms = array(
            		'table_open' 		=> '<table class="Game_table">',
            		'cell_start' 		=> '<td class="Series">',
            		'cell_alt_start' 	      => '<td class="Series">'
            	);
                  $this->table->set_template($trans_parms);

                  $tran_rows = $this->table->make_columns($trancells, 1);
                  $this->data['trade'] = $this->table->generate($tran_rows);


	
                  $collection = $this->Transaction->get_player_collection($this->session->userdata('username'));

                  foreach($collection as $collections)
            	     $collection_cells[] = $this->parser->parse('_collectioncell', (array) $collections, true);

                  $this->load->library('table');
                  $parms = array(
            		'table_open' 		=> '<table class="Player_table">',
            		'cell_start' 		=> '<td class="Player_info">',
            		'cell_alt_start' 	      => '<td class="Player_info">'
            	);
                  $this->table->set_template($parms);

                  $collection_rows = $this->table->make_columns($collection_cells, 2);
                  $this->data['collection'] = $this->table->generate($collection_rows);

            

            }
            else{
                  $this->data['trade'] = "No player selected";
                  $this->data['collection'] = "No player selected";
            }
            $Player_list = $this->Transaction->get_dropdown_list();
            $this->data['dropdown'] = form_dropdown('Player', $Player_list, set_value('player'),'id = "player"');

			
            $this->data['user'] = $this->session->userdata('username');
            $this->data['pagebody'] = 'portfolio';
            $this->render();

	}

      public function show($name)
      {
            $this->load->model('Players');
            $this->load->model('Game');
            $this->load->model('Transaction');
            $this->load->helper('form');


            $tran = $this->Transaction->get_player_trans($name);

            foreach($tran as $trans)
                  $trancells[] = $this->parser->parse('_trancell', (array) $trans, true);

            $this->load->library('table');
            $trans_parms = array(
                        'table_open'            => '<table class="Game_table">',
                        'cell_start'            => '<td class="Series">',
                        'cell_alt_start'        => '<td class="Series">'
                  );
            $this->table->set_template($trans_parms);

            $tran_rows = $this->table->make_columns($trancells, 1);
            $this->data['trade'] = $this->table->generate($tran_rows);


      
            $collection = $this->Transaction->get_player_collection($name);

            foreach($collection as $collections)
                  $collection_cells[] = $this->parser->parse('_collectioncell', (array) $collections, true);

            $this->load->library('table');
            $parms = array(
                        'table_open'            => '<table class="Player_table">',
                        'cell_start'            => '<td class="Player_info">',
                        'cell_alt_start'  => '<td class="Player_info">'
                  );
            $this->table->set_template($parms);

            $collection_rows = $this->table->make_columns($collection_cells, 2);
            $this->data['collection'] = $this->table->generate($collection_rows);

            $Player_list = $this->Transaction->get_dropdown_list();
            $this->data['dropdown'] = form_dropdown('Player', $Player_list, set_value('player'),'id = "player"');

                  
            
            $this->data['user'] = $this->session->userdata('username');
            $this->data['pagebody'] = 'portfolio';
            $this->render();


      }
}
