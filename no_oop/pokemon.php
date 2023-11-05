<?php

function battle() {
    $namePikachu = 'ピカチュウ';
    $nameHitokage = 'ヒトカゲ';
    $hpPikachu = 20;
    $hpHitokage = 16;
    $attackPowerPikachu = 4;
    $attackPowerHitokage = 5;
    $attackNamePikachu = '10万ボルト';
    $attackNameHitokage = 'かえんほうしゃ';
    
    // ピカチュウのインスタンス生成
    $pikachu = new Pokemon($namePikachu, $hpPikachu, $attackPowerPikachu, $attackNamePikachu);
    // ヒトカゲのインスタンス生成
    $hitokage = new Pokemon($nameHitokage, $hpHitokage, $attackPowerHitokage, $attackNameHitokage);
    
    // 対戦する２体のポケモンを配列に格納
    $opponent = [$pikachu, $hitokage];

    echo "{$pikachu->getName()}があらわれた。{$pikachu->getName()}のHPは{$pikachu->getHp()}だ。\n";
    echo "{$hitokage->getName()}があらわれた。{$hitokage->getName()}のHPは{$hitokage->getHp()}だ。\n";

    while($hpPikachu >= 0 && $hpHitokage >= 0) {
        shuffle($opponent);
        $firstAttacker = $opponent[0];
        $secondAttacker = $opponent[1];

        // 先攻のポケモンの攻撃
        $restHp = attack($firstAttacker->getName(), $secondAttacker->getName(), $firstAttacker->getAttackPower(), $secondAttacker->getHp(), $firstAttacker->getAttackName());
        $secondAttacker->setHp($restHp);

        // HPが0になった場合ループを抜けて、勝者を表示
        if(checkFainted($secondAttacker->getHp(), $secondAttacker->getName(), $firstAttacker->getName())) {
            break;
        }

        // 後攻のポケモンの攻撃
        $restHp = attack($secondAttacker->getName(), $firstAttacker->getName(), $secondAttacker->getAttackPower(), $firstAttacker->getHp(), $secondAttacker->getAttackName());
        $firstAttacker->setHp($restHp);

        // HPが0になった場合ループを抜けて、勝者を表示
        if(checkFainted($firstAttacker->getHp(), $firstAttacker->getName(), $secondAttacker->getName())) {
            break;
        }
    }
}

/**
 * 攻撃の関数
 *
 * @param string $attacker
 * @param string $defender
 * @param integer $attackPower
 * @param integer $hpDefender
 * @param string $attackName
 * @return integer
 */
function attack(string $attacker, string $defender, int $attackPower, int $hpDefender, string $attackName): int {
    $currentHp = $hpDefender - $attackPower;

    if($currentHp < 0) {
        $currentHp = 0;
    }

    echo "{$attacker}のこうげき！{$attackName}！{$defender}は{$attackPower}ダメージをもらった。{$defender}のHPは{$currentHp}だ。\n";
    return $currentHp;
}

/**
 * HPが0以下か判定する関数
 *
 * @param int $hp
 * @param string $defenderName
 * @param string $attackerName
 * @return boolean
 */
function checkFainted(int $hp, string $defenderName, string $attackerName): bool {
    if($hp <= 0) {
        echo "{$defenderName}は倒れた。{$attackerName}の勝ち！\n";
        return true;
    }
    return false;
}

/**
 * Pokemonを定義するクラス
 */
class Pokemon {
    private string $name;
    private int $hp;
    private int $attackPower;
    private string $attackName;

    /**
     * @param string $name
     * @param integer $hp
     * @param integer $attackPower
     * @param string $attackName
     */
    public function __construct(string $name, int $hp, int $attackPower, string $attackName)
    {
        $this->name = $name;
        $this->hp = $hp;
        $this->attackPower = $attackPower;
        $this->attackName = $attackName;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getHp(): int {
        return $this->hp;
    }

    public function getAttackPower(): int {
        return $this->attackPower;
    }

    public function getAttackName(): string {
        return $this->attackName;
    }

    public function setHp(int $hp): void {
        if($hp < 0) {
            $hp = 0;
        }
        $this->hp = $hp;
    }
}

battle();
