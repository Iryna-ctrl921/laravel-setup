<?php
require_once 'AccountInterface.php';

class BankAccount implements AccountInterface {
    public const MIN_BALANCE = 0;

    protected float $balance;
    protected string $currency;

    public function __construct(string $currency = "USD", float $initialBalance = 0.0) {
        $this->currency = $currency;
        if ($initialBalance < self::MIN_BALANCE) {
            $this->balance = self::MIN_BALANCE;
        } else {
            $this->balance = $initialBalance;
        }
    }

    public function deposit($amount) {
        if ($amount <= 0) {
            throw new Exception("Помилка: Сума для поповнення має бути більшою за 0.");
        }
        $this->balance += $amount;
        return $this->balance;
    }

    public function withdraw($amount) {
        if ($amount <= 0) {
            throw new Exception("Помилка: Сума для зняття має бути більшою за 0.");
        }
        if ($amount > $this->balance) {
            throw new Exception("Недостатньо коштів на рахунку для зняття {$amount} {$this->currency}. (Поточний баланс: {$this->balance} {$this->currency})");
        }
        $this->balance -= $amount;
        return $this->balance;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getCurrency() {
        return $this->currency;
    }
}