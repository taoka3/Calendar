<?php
require 'Calendar.php';
$calendar = new Calendar();
?>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約システム（仮）</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .draggable {
            text-decoration: underline;
        }

        .lock {
            background-color: #6577df;
            color: #ffffff !important;
            text-decoration: none !important;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full h-full max-w-4xl p-4">
        <h1 class="text-2xl font-bold mb-4 text-gray-700">calendar</h1>
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <?= $calendar->getHtml() ?>
        </div>
        <button id="reservedBtn" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">予約する（仮）</button>
        <button id="resetBtn" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">予約を解除する</button>
        <div class="mt-4 text-gray-600">
            <p>青色のセルは予約済みです。</p>
            <p>その他のセルは予約可能です。</p>
        </div>
    </div>
    <script src="./assets/calendar.js?<?= time() ?>"></script>
</body>

</html>