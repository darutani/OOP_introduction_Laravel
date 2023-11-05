<?php

require_once 'pokemon.php';

/**
 * ピカチュウを定義
 */
class Pikachu extends Pokemon {
    public function __construct()
    {
        parent::__construct('ピカチュウ', 20, 4, '10万ボルト');
    }
}
