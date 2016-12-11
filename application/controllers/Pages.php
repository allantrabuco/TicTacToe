<?php

  class Pages extends CI_Controller {

    public function __construct() {
      parent::__construct();
    }



    public function view($page = 'home') {
      if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
        show_404();
      }
      $this->session->unset_userdata('games_id_game');
      $this->session->unset_userdata('player1');
      $this->session->unset_userdata('scoreP1');
      $this->session->unset_userdata('player2');
      $this->session->unset_userdata('scoreP2');
      $this->session->unset_userdata('computer');

      $data['title'] = ucfirst($page);

      $this->load->view('templates/header');
      $this->load->view('pages/'.$page, $data);
      $this->load->view('templates/footer');

    }
  }

?>
