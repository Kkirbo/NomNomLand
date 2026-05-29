<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>VanillaJS Chess</title>
  <link rel="stylesheet" href="../styles/index.css">
  <link rel="stylesheet" type="text/css" href="../chess/styles/layout.css">
  <link rel="stylesheet" type="text/css" href="../chess/styles/board.css">
  <link rel="stylesheet" type="text/css" href="../chess/styles/checkLine.css">
  <link rel="stylesheet" type="text/css" href="../chess/styles/pieces.css">
  <link rel="stylesheet" type="text/css" href="../chess/styles/main-menu.css">
  <link rel="stylesheet" type="text/css" href="../chess/styles/pgnMenu.css">
  <link rel="stylesheet" type="text/css" href="../chess/styles/game-alert.css">
  <link rel="stylesheet" type="text/css" href="../chess/styles/chss.css">
  <link rel="icon" href="../chess/images/black-pawn.png">
  <script defer type="text/javascript" src="../chess/scripts/sidebar.js" ></script>
  <script defer type="text/javascript" src="../chess/scripts/globalVars.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/tools.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/newGame.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/promotion.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/pieceClasses.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/handDrag.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/handleMoves.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/rateBoardstate.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/computerMove.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/swapTurn.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/postMove.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/checkRepetition.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/colorStyle.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/winnerLogic.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/autoMove.js"></script>
  <script defer  type="text/javascript" src="../chess/scripts/troubleshooting.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/gameTracking.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/init.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/handlePGN.js"></script>
  <script defer type="text/javascript" src="../chess/scripts/bookTest.js"></script>

</head>
<?php include 'sidebar.php'; ?>

<!-- By Chess_kdt45.svg: en:User:Cburnettderivative work: NikNaks93 (talk) - Chess_kdt45.svg, CC BY-SA 3.0, https://commons.wikimedia.org/w/index.php?curid=10403970 -->
<body class = "">
<!--   <div id="menu-placeholder"></div> -->

  <div id="main-container">
    <nav id="navbar">
      <div class="menu-icon">
      </div>
    </nav>
    <div id="player2-area">
      <div id="thinking"> Thinking
        <div id="rotate-anim"> 
            <div class="rotate1"></div>
            <div class="rotate2"></div>
        </div>
      </div>
      <div class="icon"></div>
      <div class="player-name"></div>
      <div id="p1graveyard">
        <div class="sub-graveyard pos0">
          <div class="piece p1piece white rook"></div>
          <div class="piece p1piece white knight"></div>
          <div class="piece p1piece white bishop"></div>
          <div class="piece p1piece white king"></div>
          <div class="piece p1piece white queen"></div>
          <div class="piece p1piece white bishop"></div>
          <div class="piece p1piece white knight"></div>
          <div class="piece p1piece white rook"></div>
          <div class="piece p1piece white pawn"></div>
          <div class="piece p1piece white pawn"></div>
          <div class="piece p1piece white pawn"></div>
          <div class="piece p1piece white pawn"></div>
          <div class="piece p1piece white pawn"></div>
          <div class="piece p1piece white pawn"></div>
          <div class="piece p1piece white pawn"></div>
          <div class="piece p1piece white pawn"></div>
        </div>
        <div class="sub-graveyard pos1"></div>
        <div class="sub-graveyard pos2"></div>
        <div class="sub-graveyard pos3"></div>
        <div class="sub-graveyard pos4"></div>
        <div class="sub-graveyard pos5"></div>
      </div>  
    </div>   
    <div id="game-area">
        <div id="game-alert" class="alert-menu hidden">
          <div class="close-alert-menu">X</div>
          <div id="winner" class="alert-menu-text"></div>
          <div id="new-game-alert">New Game</div>
        </div>
        <div id="ff-menu" class="alert-menu hidden">
          <div class="close-alert-menu">X</div>
          <div id="ff-name" class="alert-menu-text"></div>
          <div id="ff-buttons">
            <div id="ff-yes">Yes</div>
            <div id="ff-no">No</div>
          </div>
        </div> 
        <div id="board-with-promotion" class="">
          <div id = "choose-promotion"> 
            <div class = "promotion-piece"></div>
            <div class = "promotion-piece"></div>
            <div class = "promotion-piece"></div>
            <div class = "promotion-piece"></div>
          </div>
          <div id="board" class="">
            <div class="gameRow">
               <div class="square">
                 <div class="avail-move hidden"></div>
                 <div class="tr-text">8</div>
               </div>
               <div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div>
               <div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div>
            </div>
            <div class="gameRow">
               <div class="dark square">
                  <div class="avail-move hidden"></div>
                  <div class="tr-text">7</div>
               </div>
               <div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div>
               <div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div>
            </div>
            <div class="gameRow ">
               <div class="square ">
                 <div class="avail-move hidden "></div>
                 <div class="tr-text ">6</div>
               </div>
               <div class="dark square "><div class="avail-move hidden "></div></div><div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div>
               <div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div>
            </div>
            <div class="gameRow">
               <div class="dark square">
                 <div class="avail-move hidden"></div>
                 <div class="tr-text">5</div>
               </div>
               <div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div>
               <div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div>
            </div>
            <div class="gameRow">
               <div class="square">
                 <div class="avail-move hidden"></div>
                 <div class="tr-text">4</div>
               </div>
               <div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div>
               <div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div>
            </div>
            <div class="gameRow">
               <div class="dark square">
                 <div class="avail-move hidden"></div>
                 <div class="tr-text">3</div>
               </div>
               <div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div>
               <div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div>
            </div>
            <div class="gameRow">
               <div class="square">
                 <div class="avail-move hidden"></div>
                 <div class="tr-text">2</div>
               </div>
               <div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div>
               <div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div><div class="square"><div class="avail-move hidden"></div></div><div class="dark square"><div class="avail-move hidden"></div></div>
            </div>
            <div class="gameRow">
               <div class="dark square">
                 <div class="avail-move hidden"></div>
                 <div class="br-text">a</div>
                 <div class="tr-text">1</div>
               </div>
               <div class="square">
                 <div class="avail-move hidden"></div>
                 <div class="br-text">b</div>
               </div>
               <div class="dark square">
                 <div class="avail-move hidden"></div>
                 <div class="br-text">c</div>
               </div>
               <div class="square">
                 <div class="avail-move hidden"></div>
                 <div class="br-text">d</div>
               </div>
               <div class="dark square">
                 <div class="avail-move hidden"></div>
                 <div class="br-text">e</div>
               </div>
               <div class="square
                 "><div class="avail-move hidden"></div>
                 <div class="br-text">f</div>
               </div>
               <div class="dark square">
                 <div class="avail-move hidden"></div>
                 <div class="br-text">g</div>
               </div>
               <div class="square">
               <div class="avail-move hidden"></div>
                 <div class="br-text">h</div>
               </div>
            </div>
          </div>
          <div id="piece-area"></div>
      </div>
    </div>
    <div id="player1-area">
      <div class="thinking"></div>
      <div class="icon"></div>
      <div class="player-name"></div>
      <div id="p2graveyard">
        <div class="sub-graveyard pos0">
        <div class="piece p2piece black pawn"></div>
          <div class="piece p2piece black pawn"></div>
          <div class="piece p2piece black pawn"></div>
          <div class="piece p2piece black pawn"></div>
          <div class="piece p2piece black pawn"></div>
          <div class="piece p2piece black pawn"></div>
          <div class="piece p2piece black pawn"></div>
          <div class="piece p2piece black pawn"></div>
          <div class="piece p2piece black rook"></div>
          <div class="piece p2piece black knight"></div>
          <div class="piece p2piece black bishop"></div>
          <div class="piece p2piece black king"></div>
          <div class="piece p2piece black queen"></div>
          <div class="piece p2piece black bishop"></div>
          <div class="piece p2piece black knight"></div>
          <div class="piece p2piece black rook"></div>
        </div>
        <div class="sub-graveyard pos1"></div>
        <div class="sub-graveyard pos2"></div>
        <div class="sub-graveyard pos3"></div>
        <div class="sub-graveyard pos4"></div>
        <div class="sub-graveyard pos5"></div>
      </div>
    </div>
    <div id="bottom-area">
      <div id="interactive">
        <button class="hidden" id="hint">
          <img src="../chess/images/hint.svg" alt="hint"/>
          Hint
        </button>
        <button class="" id="forfeit">
          <img src="../chess/images/flag.svg" alt="resign"/>
          Resign
        </button>
      </div>
      <div id="navigation">
        <button class="" id="prev-move"></button>
        <button class="" id="next-move"></button>
      </div>
    </div>
  </div> 
</body>

</html>











