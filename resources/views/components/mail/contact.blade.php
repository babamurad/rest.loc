<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обратная связь</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h2 {
            color: #0073e6;
        }
        p {
            font-size: 14px;
            line-height: 1.6;
        }
        .footer {
            font-size: 12px;
            color: #888;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('assets/images/logo.png') }}" alt="FoodPark" class="img-fluid">
        <h2>Новое сообщение от</h2>
        <h3>{{ $sender_name }}</h3>
        <p><strong>Email:</strong> {{ $sender_email }}</p>
        <p><strong>Телефон:</strong> {{ $sender_phone }}</p>
        <p><strong>Тема:</strong> {{ $sender_subject }}</p>
        <p><strong>Сообщение:</strong></p>
        <p>{{ $sender_message }}</p>
        
        <p>Спасибо за обращение!</p>
    </div>
</body>
</html>
