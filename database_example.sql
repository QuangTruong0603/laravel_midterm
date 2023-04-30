SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `SleepRecord` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    sleep_date DATE,
    sleep_time TIME,
    wake_time TIME,
    FOREIGN KEY (user_id) REFERENCES Users(id)
);

INSERT INTO `Users` (name, email, password, is_admin) VALUES
    ('quantruong', 'quangtruong@gmail.com', '12345678', false),
    ('xuanha', 'xuanha@gmail.com', '12345678', false),
    ('admin', 'admin@gmail.com', 'admin123', true),
    ('lehoang', 'lehoang@gmail.com', '12345678', false);

INSERT INTO `SleepRecord` (user_id, sleep_date, sleep_time, wake_time) VALUES
    (1, '2023-04-28', '23:00:00', '07:00:00'),
    (1, '2023-04-29', '23:30:00', '07:30:00'),
    (2, '2023-04-28', '23:30:00', '06:30:00'),
    (2, '2023-04-29', '00:30:00', '08:00:00'),
    (3, '2023-04-28', '22:00:00', '06:00:00'),
    (3, '2023-04-29', '23:00:00', '06:30:00');