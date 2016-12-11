<?php

date_default_timezone_set('Europe/London');

  class Match_model extends CI_Model {

    public function __construct() {
      parent::__construct();
    }



    public function get_matches($idGame = 0) {

      if ($idGame === 0) return array();

      $this->db->join('games', 'id_game = games_id_game');
      $this->db->order_by('id_match', 'desc');
      $query = $this->db->get_where('matches', array('games_id_game' => $idGame), 5);

      return $query->result_array();

    }



    public function insert_match() {

      $idGame = $this->input->post('id');
      $winner = $this->input->post('winner');
      $match = $this->input->post('match');
      $aMatch = explode(',', $this->input->post('match'));

      $date = new DateTime();

      $data = array(
        'games_id_game' => $idGame,
        'winner'   => $winner,
        'match'    => $match,
        'ended_at' => $date->format('Y-m-d H:i:s')
      );

      $scoreP1 = $this->session->userdata('scoreP1');
      $scoreP2 = $this->session->userdata('scoreP2');

      if ($winner == 0) {
        $scoreP1++;
      } else if ($winner == 1) {
        $scoreP2++;
      }
      $this->session->set_userdata('scoreP1', $scoreP1);
      $this->session->set_userdata('scoreP2', $scoreP2);


      $this->db->insert('matches', $data);
      return $data;
    }

  }

?>
