<?php

  class Game_model extends CI_Model {

    public function __construct() {
      $this->load->database();
    }




    public function create_game() {

      $data = array(
        'player1' => $this->input->post('player1'),
        'player2' => $this->input->post('player2')
      );

      $this->session->set_userdata('computer', $this->input->post('chkcomputer') === 'yes' ? 'y' : 'n');

      $this->db->insert('games', $data);
      return $this->db->insert_id();
    }

  }


?>
