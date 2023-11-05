<?php

require_once 'pokemon.php';

/**
 * ヒトカゲを定義
 */
class Hitokage extends Pokemon {
    public function __construct()
    {
        parent::__construct('ヒトカゲ', 16, 5, 'かえんほうしゃ');
    }
}
