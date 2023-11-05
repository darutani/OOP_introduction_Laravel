<?php

class Game {
    private Pokemon $pokemon1;
    private Pokemon $pokemon2;

    public function __construct($pokemon1, $pokemon2)
    {
        $this->pokemon1 = $pokemon1;
        $this->pokemon2 = $pokemon2;
    }

    /**
     * バトル開始
     *
     * @return void
     */
    function battle(): void {
        $this->start($this->pokemon1, $this->pokemon2);
        $this->attack();
    }
    
    /**
     * バトル開始の合図
     *
     * @return void
     */
    private function start(): void {
        echo "{$this->pokemon1->getName()}があらわれた。{$this->pokemon1->getName()}のHPは{$this->pokemon1->getHp()}だ。\n";
        echo "{$this->pokemon2->getName()}があらわれた。{$this->pokemon2->getName()}のHPは{$this->pokemon2->getHp()}だ。\n";
    }
    
    /**
     * 勝敗の表示
     *
     * @param Pokemon $defender
     * @param Pokemon $attacker
     * @return void
     */
    private function showResult(Pokemon $defender, Pokemon $attacker): void {
        echo "{$defender->getName()}は倒れた。{$attacker->getName()}の勝ち！\n";
    }

    /**
     * HPが0になるまで攻撃を繰り返す
     *
     * @return void
     */
    private function attack(): void {
        // 対戦する２体のポケモンを配列に格納
        $opponent = [$this->pokemon1, $this->pokemon2];

        while(true) {
            shuffle($opponent);
            $firstAttacker = $opponent[0];
            $secondAttacker = $opponent[1];
    
            // 先攻のポケモンの攻撃
            $secondAttackerCurrentHp = $firstAttacker->attack($secondAttacker);
    
            // HPが0になった場合ループを抜けて、勝者を表示
            if($firstAttacker->checkFainted($secondAttacker, $secondAttackerCurrentHp)) {
                $this->showResult($secondAttacker, $firstAttacker);
                break;
            }
    
            // 後攻のポケモンの攻撃
            $firstAttackerCurrentHp = $secondAttacker->attack($firstAttacker);
    
            // HPが0になった場合ループを抜けて、勝者を表示
            if($secondAttacker->checkFainted($firstAttacker, $firstAttackerCurrentHp)) {
                $this->showResult($firstAttacker, $secondAttacker);
                break;
            }
        }
    }
}
