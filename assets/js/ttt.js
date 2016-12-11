'use strict';

$(document).ready(function() {
  var winner = false,
      tie = false,
      player = 0,
      match = [9, 9, 9, 9, 9, 9, 9, 9, 9],
      mComp = [9, 9, 9, 9, 9, 9, 9, 9, 9],
      id = 0;

  var poss = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6]
  ];

  var square = $('.ttt-square');

  if (square.length > 0) {
    id = parseInt(square[0].id, 10);
  }

  $('.ttt-back').tooltip({
    placement: 'bottom'
  });

  $('.ttt-exit').tooltip({
    placement: 'bottom'
  });

  $('#computer').click(function(ev) {
    var p2 = $('#player2');

    if (ev.target.checked) {
      p2.val('Computer');
    } else {
      p2.val('');
    }
  });

  square.mouseover(function(ev) {
    if (winner || tie) return false;
    if (ev.target.className.indexOf('-chosen-') === -1) {
      ev.target.classList.add('ttt-turn-' + player);
    }
  });

  square.mouseout(function(ev) {
    if (winner || tie) return false;
    if (ev.target.className.indexOf('-chosen-') === -1) {
      ev.target.classList.remove('ttt-turn-' + player);
    }
  });

  square.click(function(ev) {

    if (winner || tie) return false;

    var pos = parseInt(ev.target.attributes.pos.value, 10);

    if (ev.target.className.indexOf('-chosen-') === -1) {
      ev.target.classList.remove('ttt-turn-' + player);
      ev.target.classList.add('ttt-chosen-' + player);
    }

    match[pos] = player;

    if (checkMatch()) {
      player = (player === 0 ? 1 : 0);
      if ($('.ttt-score-player-1')[0].attributes.yac.value === '_y_' && player === 1) computerMove();
    } else {
      conclude();
    }
  });

  function conclude() {
    if (tie) player = 9;

    var url = document.baseURI.substring(0, document.baseURI.lastIndexOf('/')+1);

    $('#modalThisMatch').on('hidden.bs.modal', function (e) {
      window.location.href = url + 'newmatch';
    })

    $.ajax({
      type: "POST",
      url : url + "imatch",
      data: {
        id    : id,
        winner: player,
        match : match.toString()
      },
      dataType: "JSON",
      cache   : false,
      success : function(data) {
        $('#modalThisMatch').modal();
      }
    });
  }


  function computerMove() {
    var wMoves = [4, 0, 2, 6, 8, 1, 3, 5, 7];
    var choice = -1;
    var h = 0;

    if (match[4] === 9) {
      choice = 4;
    } else {

      for (var i = 0; i < 8; i++) {
        if (match[poss[i][0]] === 1 || match[poss[i][1]] === 1 || match[poss[i][2]] === 1) {
          if (match[poss[i][0]] === 1) h++;
          if (match[poss[i][1]] === 1) h++;
          if (match[poss[i][2]] === 1) h++;
          if (h > 1) {
            if (match[poss[i][0]] === 9) choice = poss[i][0];
            else if (match[poss[i][1]] === 9) choice = poss[i][1];
            else if (match[poss[i][2]] === 9) choice = poss[i][2];
            else h = 0;
            if (h > 0) break;
          } else {
            h = 0;
          }
        }
      }

      if (choice === -1) {

        for (var i = 0; i < 8; i++) {
          if (match[poss[i][0]] === 0 || match[poss[i][1]] === 0 || match[poss[i][2]] === 0) {
            if (match[poss[i][0]] === 0) h++;
            if (match[poss[i][1]] === 0) h++;
            if (match[poss[i][2]] === 0) h++;
            if (h > 1) {
              if (match[poss[i][0]] === 9) choice = poss[i][0];
              else if (match[poss[i][1]] === 9) choice = poss[i][1];
              else if (match[poss[i][2]] === 9) choice = poss[i][2];
              else h = 0;
              if (h > 0) break;
            } else {
              h = 0;
            }
          }
        }

        if (choice === -1) {
          for (var i = 0; i < 8; i++) {
            if (match[wMoves[i]] === 9) {
              choice = wMoves[i];
              break;
            }
          }
        }
      }
    }

    square[choice].classList.add('ttt-chosen-' + player);
    match[choice] = player;

    if (checkMatch()) {
      player = (player === 0 ? 1 : 0);
    } else {
      conclude();
    }
  }

  function checkMatch() {
    for (var i = 0; i < 8; i++) {
      if (match[poss[i][0]] !== 9 && (match[poss[i][0]] === match[poss[i][1]] &&  match[poss[i][1]] === match[poss[i][2]])) {
        winner = true;
        return false;
      } else if (match.indexOf(9) === -1) {
          tie = true;
          return false;
      }
    }
    return true;
  }


  $('#modalThisMatch').on('show.bs.modal', function (event) {
    var modal = $(this);

    var p0 = modal.find('.modal-title-winner-0');
    var p1 = modal.find('.modal-title-winner-1');
    var p9 = modal.find('.modal-title-winner-9');

    if (player ===  0) {
      p1.remove();
      p9.remove();
    } else if (player ===  1) {
      p0.remove();
      p9.remove();
    } else {
      p0.remove();
      p1.remove();
    }

  })

  $('#modalScoreResult').on('show.bs.modal', function (event) {
    var eye = $(event.relatedTarget);
    var recipient = eye.data('whatever');
    var modal = $(this);
    var rec = recipient.split('|');
    var mr = rec[1].split(',');

    modal.find('.modal-title').text('Match result - ' + rec[0]);

    var cls = modal.find('.ttt-square');
    cls.each(function(ix, el) {
      el.classList.remove('ttt-chosen-0');
      el.classList.remove('ttt-chosen-1');
      if (mr[ix] < 9) {
        el.classList.add('ttt-chosen-' + mr[ix]);
      }
    });
  })

});
