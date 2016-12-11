<?php

  class Games extends CI_Controller {

    public function __construct() {
      parent::__construct();
    }




    public function create_game() {
      $data['player1'] = $this->input->post('player1');
      $data['player2'] = $this->input->post('player2');

      $this->form_validation->set_rules('player1', 'Player 1', 'required');
      $this->form_validation->set_rules('player2', 'Player 2', 'required');

      if ($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header');
        $this->load->view('games/players', $data);
        $this->load->view('templates/footer');
      } else {
        $this->session->set_userdata('games_id_game', $this->game_model->create_game());
        $this->session->set_userdata('player1', $data['player1']);
        $this->session->set_userdata('player2', $data['player2']);
        $this->session->set_userdata('scoreP1', 0);
        $this->session->set_userdata('scoreP2', 0);

        redirect('newmatch');
      }
    }




    public function new_match() {
      $data['games_id_game'] = $this->session->userdata('games_id_game');
      $data['player1'] = $this->session->userdata('player1');
      $data['scoreP1'] = $this->session->userdata('scoreP1');
      $data['player2'] = $this->session->userdata('player2');
      $data['scoreP2'] = $this->session->userdata('scoreP2');
      $data['computer'] = $this->session->userdata('computer');
      $data['matches'] = $this->match_model->get_matches($data['games_id_game']);

      if (empty($data['games_id_game'])) {
        $this->load->view('games/matches', $data);
        redirect('/');
      } else {
        $this->load->view('templates/header');
        $this->load->view('games/matches', $data);
        $this->load->view('templates/footer');
      }

    }




    public function insert_match_result() {

      $response = $this->match_model->insert_match();
      $response['status'] = 'success';
      echo json_encode($response);

    }

  }



?>
