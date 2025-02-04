<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to checkout.";
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT SUM(products.price * cart_items.quantity) AS total
        FROM cart_items
        JOIN products ON cart_items.product_id = products.id
        WHERE cart_items.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total = $row['total'];

if ($total > 0) {
    $conn->begin_transaction();

    try {
        $sqlOrder = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
        $stmtOrder = $conn->prepare($sqlOrder);
        $stmtOrder->bind_param("id", $user_id, $total);
        $stmtOrder->execute();
        $order_id = $stmtOrder->insert_id;

        $sqlItems = "INSERT INTO order_items (order_id, product_id, quantity, price)
                     SELECT ?, product_id, quantity, price
                     FROM cart_items
                     JOIN products ON cart_items.product_id = products.id
                     WHERE cart_items.user_id = ?";
        $stmtItems = $conn->prepare($sqlItems);
        $stmtItems->bind_param("ii", $order_id, $user_id);
        $stmtItems->execute();

        $sqlClearCart = "DELETE FROM cart_items WHERE user_id = ?";
        $stmtClearCart = $conn->prepare($sqlClearCart);
        $stmtClearCart->bind_param("i", $user_id);
        $stmtClearCart->execute();

        $conn->commit();
        header("Location:/Ziara/images/payment/purchasesucessfull.html");
    exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Your cart is empty.";
}

$stmt->close();
?>
