<?php
require_once 'config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $pdo->prepare("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Sản phẩm không tồn tại!");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><%= htmlspecialchars($product['name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="container mx-auto px-4 py-8">
        <a href="index.php" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Quay lại danh sách</a>
        
        <div class="bg-white rounded-lg shadow-md p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="h-80 bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg">
                <span>[Hình ảnh chi tiết: <?= htmlspecialchars($product['image']) ?>]</span>
            </div>
            
            <div>
                <span class="text-xs text-blue-600 font-semibold uppercase"><?= htmlspecialchars($product['category_name']) ?></span>
                <h1 class="text-2xl font-bold text-gray-900 mt-1"><?= htmlspecialchars($product['name']) ?></h1>
                <p class="text-2xl text-red-600 font-bold mt-4"><?= number_format($product['price'], 0, ',', '.') ?> đ</p>
                
                <div class="mt-4 text-gray-600 leading-relaxed">
                    <h3 class="font-semibold text-gray-800">Mô tả sản phẩm:</h3>
                    <p><%= nl2br(htmlspecialchars($product['description'])) ?></p>
                </div>
                
                <div class="mt-6">
                    <p class="text-sm text-gray-500 mb-2">Số lượng tồn kho: <?= $product['stock'] ?></p>
                    <form action="cart.php" method="POST" class="flex gap-4">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="number" name="quantity" value="1" min="1" max="<?= $product['stock'] ?>" class="w-20 border rounded p-2 text-center">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Thêm vào giỏ hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>