<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'];
    if (!$url) die(400);
    $code = rand(10000, 999999);
    file_put_contents('data.txt', $url . " ~ " . $code . PHP_EOL, FILE_APPEND);
}

$error = null;
if (isset($_GET['code']) && !empty($_GET['code'])) {
    $code = $_GET['code'];
    $handle = fopen('data.txt', 'r');
    if ($handle === false) die(400);
    while (($line = fgets($handle)) !== false) {
        $d = preg_split('/ ~ /', $line);
        if (trim($d[1]) === $code) {
            $url = $d[0];
            break;
        }
    }
    if (isset($url)) {
        header("Location: {$url}");
    } else {
        $error = "No url found for code: $code";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C9</title>
</head>

<body>
    <h1>File-Based URL Shortenter</h1>
    <form action="" method="post">
        <input type="text" name="url" id="url" placeholder="enter url">
        <button>Create short code</button>
        <div>
            <?php if (isset($code) && !$error): ?>
                <span>Code generated: <?= $code ?></span> <br>
                <span>For url: <?= $url ?></span>
            <?php endif ?>
        </div>
    </form>
    <span style="color: red"><?= $error ?></span>
</body>

</html>