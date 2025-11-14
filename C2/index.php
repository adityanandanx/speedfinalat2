<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csv = $_FILES['csv'];
    if (!$csv) die(400);
    $handle = fopen($csv['tmp_name'], 'r');
    if ($handle === false) die(400);
    $results = [];
    // ignore header row
    fgetcsv($handle);
    while (($data = fgetcsv($handle)) !== false) {
        $cat = $data[0];
        $val = floatval($data[1]);
        if (!array_key_exists($cat, $results)) {
            $results[$cat] = 0;
        }
        $results[$cat] += $val;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C2</title>
</head>

<body>
    <h1>CSV File Parser</h1>
    <p>Select CSV file (first column = category, second column = value):</p>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="csv" id="csv" required>
        <button>Upload and parse</button>
    </form>
    <?php if (isset($results)): ?>
        <h2>Results:</h2>
        <?php foreach ($results as $cat => $val): ?>
            <p><?= $cat ?>: <?= number_format($val, 2) ?></p>
        <?php endforeach ?>
    <?php endif ?>

</body>

</html>