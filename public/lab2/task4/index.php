<?php
session_start();

if (isset($_POST['add_item'])) {
    $item = trim($_POST['item_name']);
    if (!empty($item)) {
        $_SESSION['cart'][] = $item;
    }
    header("Location: index.php");
    exit;
}

if (isset($_POST['checkout'])) {
    if (!empty($_SESSION['cart'])) {
        $previous = isset($_COOKIE['past_orders']) ? json_decode($_COOKIE['past_orders'], true) : [];
        $updated_history = array_merge($previous, $_SESSION['cart']);
        setcookie("past_orders", json_encode($updated_history), time() + (30 * 24 * 60 * 60), "/");
        unset($_SESSION['cart']);
    }
    header("Location: index.php");
    exit;
}

$current_cart = $_SESSION['cart'] ?? [];
$past_orders = isset($_COOKIE['past_orders']) ? json_decode($_COOKIE['past_orders'], true) : [];
?>
<!DOCTYPE html>
<html lang="uk">
<head><meta charset="UTF-8"><title>Завдання 4: Кошик</title></head>
<body>
    <h2>Додати товар</h2>
    <form method="POST">
        <input type="text" name="item_name" required placeholder="Назва товару">
        <button type="submit" name="add_item">У кошик</button>
    </form>

    <h3>Поточний кошик (Сесія):</h3>
    <?php if (empty($current_cart)): ?>
        <p>Кошик порожній.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($current_cart as $item): ?>
                <li><?= htmlspecialchars($item) ?></li>
            <?php endforeach; ?>
        </ul>
        <form method="POST">
            <button type="submit" name="checkout">Купити (зберегти в історію)</button>
        </form>
    <?php endif; ?>

    <h3>Історія покупок (Cookie):</h3>
    <?php if (empty($past_orders)): ?>
        <p>Ви ще нічого не купували раніше.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($past_orders as $past_item): ?>
                <li><?= htmlspecialchars($past_item) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>