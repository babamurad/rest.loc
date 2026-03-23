<?php
$filepath = 'lang/ru.json';
$content = file_get_contents($filepath);
$data = json_decode($content, true);
file_put_contents($filepath, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
