UPDATE products
SET quantity = FLOOR(RAND() * (50 - 1 + 1)) + 1; -- Заполняем случайными числами от 1 до 100