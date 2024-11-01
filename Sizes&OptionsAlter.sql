ALTER TABLE product_options ADD COLUMN sort_order INT DEFAULT 0;

SET @row_number := 0;
UPDATE product_options
SET sort_order = @row_number := @row_number + 1
ORDER BY product_id, id;

SET @row_number = 0;
SET @current_product_id = NULL;

UPDATE product_options AS ps
JOIN (
    SELECT *,
           CASE
               WHEN row_num = 1 THEN 'Coca-Cola'
               WHEN row_num = 2 THEN 'Fanta'
               WHEN row_num = 3 THEN '7up'
               ELSE 'other'
           END AS new_name
    FROM (
        SELECT product_id, sort_order, name,
               @row_number := IF(@current_product_id = product_id, @row_number + 1, 1) AS row_num,
               @current_product_id := product_id
        FROM product_options
        ORDER BY product_id, sort_order
    ) AS ranked
) AS ps2 ON ps.product_id = ps2.product_id AND ps.sort_order = ps2.sort_order
SET ps.name = ps2.new_name;
