SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

INSERT INTO `Users` (name, email, password, userType) VALUES
    ('quantruong', 'quangtruong@gmail.com', '$2y$10$shamFvnWk7AIfDjnQMOUZemwBywTxCsAQBgy8IuLMylMFpcNaFs.q', "USR"),
    ('xuanha', 'xuanha@gmail.com', '$2y$10$shamFvnWk7AIfDjnQMOUZemwBywTxCsAQBgy8IuLMylMFpcNaFs.q', "USR"),
    ('admin', 'admin@gmail.com', '$2y$10$shamFvnWk7AIfDjnQMOUZemwBywTxCsAQBgy8IuLMylMFpcNaFs.q', "ADM"),
    ('lehoang', 'lehoang@gmail.com', '$2y$10$shamFvnWk7AIfDjnQMOUZemwBywTxCsAQBgy8IuLMylMFpcNaFs.q', "USR");

INSERT INTO `SleepRecord` (user_id, sleep_date, sleep_time, wake_time) VALUES
    (1, '2023-04-24', '23:00:00', '07:00:00'),
    (1, '2023-04-25', '23:30:00', '07:30:00'),
    (1, '2023-04-26', '23:30:00', '06:30:00'),
    (1, '2023-04-27', '00:30:00', '08:00:00'),
    (1, '2023-04-28', '22:00:00', '06:00:00'),
    (1, '2023-04-29', '23:00:00', '06:30:00');