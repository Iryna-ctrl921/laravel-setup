<?php
session_start();

// Обробка додавання в поточну корзину (сесія)
if (isset($_POST['add_item'])) {
    $item = trim($_POST['item_name']);
    if (!empty($item)) {
        $_SESSION['cart'][] = $item;
    }
    header("Location: index.php");
    exit;
}

// Обробка оформлення замовлення (перенесення з сесії в cookie)
if (isset($_POST['checkout'])) {
    if (!empty($_SESSION['cart'])) {
        // Отримуємо попередні покупки з cookie (якщо є), декодуємо JSON у масив
        $previous = isset($_COOKIE['past_orders']) ? json_decode($_COOKIE['past_orders'], true) : [];
        
        // Додаємо поточну корзину до історії покупок
        $updated_history = array_merge($previous, $_SESSION['cart']);
        
        // Зберігаємо оновлену історію в cookie на 30 днів у форматі JSON
        setcookie("past_orders", json_encode($updated_history), time() + (30 * 24 * 60 * 60), "/");
        
        // Очищаємо поточну корзину
        unset($_SESSION['cart']);
    }
    header("Location: index.php");
    exit;
}

// Отримуємо дані для виводу
$current_cart = $_SESSION['cart'] ?? [];
$past_orders = isset($_COOKIE['past_orders']) ? json_decode($_COOKIE['past_orders'], true) : [];
?>
<!DOCTYPE html>
<html lang="uk">
<head><meta charset="UTF-8"><title>Завдання 4: Корзина</title></head>
<body>
    <h2>Додати товар</h2>
    <form method="POST">
        <input type="text" name="item_name" required placeholder="Назва товару">
        <button type="submit" name="add_item">В корзину</button>
    </form>

    <h3>Поточна корзина (Сесія):</h3>
    <?php if (empty($current_cart)): ?>
        <p>Корзина порожня.</p>
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