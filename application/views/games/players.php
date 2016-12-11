<a href="<?php echo base_url(); ?>home" class="ttt-back" title="Go back">
  <span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>
</a>

<div class="row ttt-games">
  <div class="col-xs-10 col-xs-offset-1">
    <?php echo form_open('game'); ?>
      <div class="form-group" <?php if (!validation_errors()) echo 'style="display:none"'; ?>>
          <div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert"  aria-label="Close">&times;</button>
              <strong><?php echo validation_errors(); ?></strong>
            </div>
      </div>

      <div class="form-group">
        <label>Player 1</label>
        <input class="form-control input-lg ttt-input" type="text" name="player1" placeholder="Enter the name of the player 1" maxlength="15" value="<?= $player1; ?>"/>
      </div>

      <div class="form-group">
        <label>Player 2</label>
        <div class="checkbox ttt-checkbox">
          <label><input type="checkbox" name="chkcomputer" id="computer" value="yes"> Computer</label>
        </div>
        <input class="form-control input-lg ttt-input" type="text" id="player2" name="player2" placeholder="Enter the name of the player 2" maxlength="15" value="<?= $player2; ?>"/>
      </div>

      <div class="form-group">
        <div class="col-xs-8 col-xs-offset-2">
          <button type="submit" class="btn btn-primary btn-lg btn-block">Start</button>
        </div>
      </div>
    </form>
  </div>
</div>
