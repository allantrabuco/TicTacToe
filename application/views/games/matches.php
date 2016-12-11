<a href="<?php echo base_url(); ?>home" class="ttt-exit" title="Exit">
  <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
</a>

  <div class="row ttt-games">
    <div class="ttt-board">
      <div class="ttt-board-line-1">
        <div class="ttt-square" id=<?= $games_id_game; ?> pos=0></div>
        <div class="ttt-square" pos=1></div>
        <div class="ttt-square ttt-last" pos=2></div>
      </div>

      <div class="ttt-board-line-2">
        <div class="ttt-square" pos=3></div>
        <div class="ttt-square" pos=4></div>
        <div class="ttt-square ttt-last" pos=5></div>
      </div>

      <div class="ttt-board-line-3">
        <div class="ttt-square" pos=6></div>
        <div class="ttt-square" pos=7></div>
        <div class="ttt-square ttt-last" pos=8></div>
      </div>
    </div>

    <div class="ttt-score hidden-xs hidden-sm hidden-md">
      <div class="panel panel-warning">
        <div class="panel-heading">
          <h2 class="panel-title">Score of the last 5 matches</h2>
        </div>
        <div class="panel-body ttt-score-results">
          <?php $ix = 0; $resTitle = array(); foreach($matches as $match) : ?>
            <div class="row">
              <?php
                if ($match['winner'] == 9) {
                  array_push($resTitle, 'No winner... Tie match!');
                } else if ($match['winner'] == 0) {
                  array_push($resTitle, $match['player1'] . ' Won!');
                } else if ($match['winner'] == 1) {
                  array_push($resTitle, $match['player2'] . ' Won!');
                }
              ?>
              <a href="#" data-toggle="modal" data-target="#modalScoreResult" data-whatever="<?php echo $resTitle[$ix] . '|' . $match['match'];?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>&nbsp;
              <span><?php echo $resTitle[$ix];?></span>
            </div>
            <?php
                $ix++;
              endforeach;

              if (count($matches) < 5) {
                for ($i = count($matches); $i < 5; $i++) {
            ?>
                  <div class="row">
                    <a href="#"><span>&nbsp;</span></a>&nbsp;
                  </div>
            <?php
                }
              }
            ?>
        </div>
      </div>
    </div>

    <div class="ttt-score-player-0 hidden-xs hidden-sm hidden-md">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title"><?= $player1;?></h2>
        </div>
        <div class="panel-body ttt-score-results">
            <div class="row ttt-score-player">
              <span><?= $scoreP1;?></span>
            </div>
        </div>
      </div>
    </div>

    <div class="ttt-score-player-1 hidden-xs hidden-sm hidden-md" yac="_<?= $computer;?>_">
      <div class="panel panel-danger">
        <div class="panel-heading">
          <h2 class="panel-title"><?= $player2;?></h2>
        </div>
        <div class="panel-body ttt-score-results">
          <div class="row ttt-score-player">
            <span><?= $scoreP2;?></span>
          </div>
        </div>
      </div>
    </div>

</div>

<!-- Modals -->
<div class="modal fade ttt-modal" id="modalThisMatch" tabindex="-1" role="dialog" aria-labelledby="modalThisMatchLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalThisMatchLabel">Result of this match</h4>
      </div>
      <div class="modal-body">
        <h2 class="modal-title-winner-0"><?= $player1;?> WON!</h2>
        <h2 class="modal-title-winner-1"><?= $player2;?> WON!</h2>
        <h2 class="modal-title-winner-9">No Winner... Tie Match!</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalScoreResult" tabindex="-1" role="dialog" aria-labelledby="modalScoreResultLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalScoreResultLabel"></h4>
      </div>
      <div class="modal-body ttt-modal">

        <div class="ttt-board">
          <div class="ttt-board-line-1">
            <div class="ttt-square"></div>
            <div class="ttt-square"></div>
            <div class="ttt-square ttt-last> "></div>
          </div>

          <div class="ttt-board-line-2">
            <div class="ttt-square"></div>
            <div class="ttt-square"></div>
            <div class="ttt-square ttt-last"></div>
          </div>

          <div class="ttt-board-line-3">
            <div class="ttt-square"></div>
            <div class="ttt-square"></div>
            <div class="ttt-square ttt-last"></div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
