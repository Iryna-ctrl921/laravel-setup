<?php
require_once 'SavingsAccount.php';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна №5: ООП в PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
        .success { color: green; }
        .error { color: red; background: #ffe6e6; padding: 5px; border-radius: 4px; }
        .card { background: #f9f9f9; border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Результати тестування банківських рахунків (ООП)</h2>

    <div class="card">
        <h3>1. Тестування звичайного рахунку (BankAccount)</h3>
        <?php
        try {
            $myAccount = new BankAccount("USD", 500);
            echo "<p>Створено рахунок з балансом: <b>{$myAccount->getBalance()} {$myAccount->getCurrency()}</b></p>";

            $myAccount->deposit(200);
            echo "<p class='success'>✓ Рахунок поповнено на 200. Новий баланс: {$myAccount->getBalance()} {$myAccount->getCurrency()}</p>";

            $myAccount->withdraw(150);
            echo "<p class='success'>✓ Знято 150. Новий баланс: {$myAccount->getBalance()} {$myAccount->getCurrency()}</p>";

            echo "<p>Спроба зняти 2000 USD...</p>";
            $myAccount->withdraw(2000);

        } catch (Exception $e) {
            echo "<p class='error'><b>Виняток піймано:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        ?>
    </div>

    <div class="card">
        <h3>2. Тестування накопичувального рахунку (SavingsAccount) та відсотків</h3>
        <?php
        try {
            $savings = new SavingsAccount("EUR", 1000);
            echo "<p>Накопичувальний рахунок відкрито з сумою: <b>{$savings->getBalance()} {$savings->getCurrency()}</b></p>";
            echo "<p>Поточна відсоткова ставка (статична властивість): <b>" . SavingsAccount::$interestRate . "%</b></p>";

            $earned = $savings->applyInterest();
            echo "<p class='success'>✓ Нараховано відсотки: +{$earned} {$savings->getCurrency()}. Баланс після нарахування: <b>{$savings->getBalance()} {$savings->getCurrency()}</b></p>";

            echo "<p>Спроба поповнити на від'ємну суму (-50)...</p>";
            $savings->deposit(-50);

        } catch (Exception $e) {
            echo "<p class='error'><b>Виняток піймано:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        ?>
    </div>
</body>
</html>