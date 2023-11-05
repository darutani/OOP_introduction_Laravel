<?php

/**
 * Pokemonを定義するクラス
 */
class Pokemon {
    private string $name;
    private int $hp;
    private int $attackPower;
    private string $attackName;
    private int $speed;

    /**
     * @param string $name
     * @param integer $hp
     * @param integer $attackPower
     * @param string $attackName
     * @param int $speed
     */
    public function __construct(string $name, int $hp, int $attackPower, string $attackName, int $speed)
    {
        $this->name = $name;
        $this->hp = $hp;
        $this->attackPower = $attackPower;
        $this->attackName = $attackName;
        $this->speed = $speed;
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

    public function getSpeed(): int {
        return $this->speed;
    }

    public function setHp(int $hp): void {
        if($hp < 0) {
            $hp = 0;
        }
        $this->hp = $hp;
    }

    /**
     * 攻撃の関数
     *
     * @param Pokemon $defender
     * @return integer
     */
    public function attack(Pokemon $defender): int {
        $currentHp = $defender->getHp() - $this->getAttackPower();

        if($currentHp < 0) {
            $currentHp = 0;
        }

        $defender->setHp($currentHp);

        $this->attack_message($defender);

        return $currentHp;
    }

    /**
     * 攻撃時の表示内容
     *
     * @param Pokemon $defender
     * @return void
     */
    private function attack_message(Pokemon $defender): void {
        echo "{$this->getName()}のこうげき！{$this->getAttackName()}！{$defender->getName()}は{$this->getAttackPower()}ダメージをもらった。{$defender->getName()}のHPは{$defender->getHp()}だ。\n";
    }

    /**
     * HPが0以下か判定する関数
     *
     * @param Pokemon $defender
     * @param int $currentHp
     * @return boolean
     */
    function checkFainted(Pokemon $defender, int $currentHp): bool {
        if($currentHp === 0) {
            return true;
        }
        return false;
    }
}
