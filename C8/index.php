<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $img = $_FILES['img'];
    if (!$img) die(400);
    $info = getimagesize($img['tmp_name']);
    $w = $info[0];
    $h = $info[1];
    $ratio = $w / $h;

    $sw = $w;
    $sh = $h;

    if ($sh > 80) {
        $sh = 80;
        $sw = floor($ratio * $sh);
    }
    if ($sw > 200) {
        $sw = 200;
        $sh = floor($sw / $ratio);
    }

    $png = imagecreatefrompng($img['tmp_name']);

    $scaledpng = imagecreate($sw, $sh);
    imagecopyresized($scaledpng, $png, 0, 0, 0, 0, $sw, $sh, $w, $h);

    $result = '';
    for ($y = 0; $y < $sh; $y++) {
        for ($x = 0; $x < $sw; $x++) {
            $rgb = imagecolorat($scaledpng, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $bright = ($r + $g + $b) / 3;
            if ($bright > 0) {
                $result .= '@';
            } else {
                $result .= '.';
            }
        }
        $result .= '<br>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C8</title>
    <style>
        pre {
            font-size: 10px;
            font-family: monospace;
            line-height: 10px;
        }
    </style>
</head>

<body>
    <h1>ASCII Art Converter</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="img" id="img">
        <button>Convert</button>
    </form>

    <?php if (isset($result)): ?>
        <h2>Result</h2>
        <pre><?= $result ?></pre>

    <?php endif ?>

</body>

</html>