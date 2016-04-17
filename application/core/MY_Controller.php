<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2015, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */

    function __construct() {
        parent::__construct();
        
        $this->data = array();
        $this->data['title'] = 'MJAM';
        $this->errors = array();
        $this->data['pageTitle'] = 'MJAM';
        $this->load->library('session');

        

    }
    
    /**
     * Render this page
     */
    function render() {
        $this->data['menubar'] = $this->parser->parse('_menubar', $this->config->item('menu_choices'),true);
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);

        // finally, build the browser page!
        $this->data['data'] = &$this->data;

        $user[] = $this->session->userdata('username');
            if( $user[0]=='None' or !isset($user[0])){
                 
                 $this->parser->parse('_template', $this->data);
            }
            else{
                $this->parser->parse('_template1', $this->data);
           
      }
        
    }

}
