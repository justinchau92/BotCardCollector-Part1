<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('Players');
		$this->load->model('Game');
            $this->load->library('session');

		$game = $this->Game->all();

		foreach($game as $series)
            	$game_cells[] = $this->parser->parse('_gamecell', (array) $series, true);

            $this->load->library('table');
            $game_parms = array(
            		'table_open' 		=> '<table class="Game_table">',
            		'cell_start' 		=> '<td class="Series">',
            		'cell_alt_start' 	      => '<td class="Series">'
            	);
            $this->table->set_template($game_parms);

            $game_rows = $this->table->make_columns($game_cells, 1);
            $this->data['game'] = $this->table->generate($game_rows);


	
            $player = $this->Players->all();

            foreach($player as $players)
            	$cells[] = $this->parser->parse('_cell', (array) $players, true);

            $this->load->library('table');
            $parms = array(
            		'table_open' 		=> '<table class="Player_table">',
            		'cell_start' 		=> '<td class="Player_info">',
            		'cell_alt_start' 	      => '<td class="Player_info">'
            	);
            $this->table->set_template($parms);

            $rows = $this->table->make_columns($cells, 1);
            $this->data['players'] = $this->table->generate($rows);

            $this->data['user'] = $this->session->userdata('username');
            $this->data['pagebody'] = 'homepage';
            $this->render();

	}
      public function logon($name)
      {
            if($name != 'assets'){
            $this->load->library('session');
            $ci = & get_instance();
            $this->session->set_userdata(array(
                            'username'      => $name
                    ));
            }
            $this->data['user'] = $this->session->userdata('username');
            

            $this->load->model('Players');
            $this->load->model('Game');

            $game = $this->Game->all();

            foreach($game as $series)
                  $game_cells[] = $this->parser->parse('_gamecell', (array) $series, true);

            $this->load->library('table');
            $game_parms = array(
                        'table_open'            => '<table class="Game_table">',
                        'cell_start'            => '<td class="Series">',
                        'cell_alt_start'        => '<td class="Series">'
                  );
            $this->table->set_template($game_parms);

            $game_rows = $this->table->make_columns($game_cells, 1);
            $this->data['game'] = $this->table->generate($game_rows);


      
            $pix = $this->Players->all();

            foreach($pix as $picture)
                  $cells[] = $this->parser->parse('_cell', (array) $picture, true);

            $this->load->library('table');
            $parms = array(
                        'table_open'            => '<table class="Player_table">',
                        'cell_start'            => '<td class="Player_info">',
                        'cell_alt_start'        => '<td class="Player_info">'
                  );
            $this->table->set_template($parms);

            $rows = $this->table->make_columns($cells, 1);
            $this->data['players'] = $this->table->generate($rows);


            $this->data['user'] = $this->session->userdata('username');
            $this->data['pagebody'] = 'homepage';
            $this->render();

      
      }
      public function logout()
      {
            
            $this->load->library('session');
            $this->session->set_userdata(array(
                            'username'      => "None"
                    ));
            

            $this->load->model('Players');
            $this->load->model('Game');

            $game = $this->Game->all();

            foreach($game as $series)
                  $game_cells[] = $this->parser->parse('_gamecell', (array) $series, true);

            $this->load->library('table');
            $game_parms = array(
                        'table_open'            => '<table class="Game_table">',
                        'cell_start'            => '<td class="Series">',
                        'cell_alt_start'        => '<td class="Series">'
                  );
            $this->table->set_template($game_parms);

            $game_rows = $this->table->make_columns($game_cells, 1);
            $this->data['game'] = $this->table->generate($game_rows);


      
            $pix = $this->Players->all();

            foreach($pix as $picture)
                  $cells[] = $this->parser->parse('_cell', (array) $picture, true);

            $this->load->library('table');
            $parms = array(
                        'table_open'            => '<table class="Player_table">',
                        'cell_start'            => '<td class="Player_info">',
                        'cell_alt_start'        => '<td class="Player_info">'
                  );
            $this->table->set_template($parms);

            $rows = $this->table->make_columns($cells, 1);
            $this->data['players'] = $this->table->generate($rows);


            $this->data['user'] = $this->session->userdata('username');
            $this->data['pagebody'] = 'homepage';
            $this->render();

      
      }
      

}
