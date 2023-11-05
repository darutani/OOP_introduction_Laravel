<?php

require_once 'game.php';
require_once 'pikachu.php';
require_once 'hitokage.php';

$pikachu = new Pikachu();
$hitokage = new Hitokage();
$game = new Game($pikachu, $hitokage);
// $pikachu->$hp = 10000;

$game->battle();
