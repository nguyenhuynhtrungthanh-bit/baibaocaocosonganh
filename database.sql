CREATE DATABASE IF NOT EXISTS `web_trang_tri_ban` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `web_trang_tri_ban`;

-- Bảng danh mục phong cách (Minimalist, Cyberpunk, Wooden,...)
CREATE TABLE `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Bảng sản phẩm trang trí
CREATE TABLE `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `category_id` INT,
    `price` DECIMAL(10, 2) NOT NULL,
    `stock` INT DEFAULT 0,
    `image` VARCHAR(255),
    `description` TEXT,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Thêm dữ liệu mẫu
INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(1, 'Minimalist', 'minimalist'),
(2, 'Cyberpunk', 'cyberpunk'),
(3, 'Wooden Style', 'wooden-style');

INSERT INTO `products` (`name`, `category_id`, `price`, `stock`, `image`, `description`) VALUES
('Đèn bàn LED thông minh', 1, 450000, 15, 'led_lamp.jpg', 'Đèn bàn tối giản, điều chỉnh độ sáng linh hoạt cho góc làm việc.'),
('Kệ màn hình gỗ sồi', 3, 650000, 10, 'wooden_stand.jpg', 'Giúp nâng cao tầm nhìn, tạo không gian gọn gàng dưới gầm bàn.'),
('Thảm lót bàn da cỡ lớn', 1, 250000, 30, 'desk_mat.jpg', 'Chất liệu da PU chống nước,êm ái khi di chuyển chuột.'),
('Mô hình trang trí Robot Cyberpunk', 2, 850000, 5, 'cyber_robot.jpg', 'Điểm nhấn cá tính, phong cách tương lai cho góc máy.');