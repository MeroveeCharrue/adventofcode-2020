<!DOCTYPE html>
<html>
<head>
    <title>Advent 2020</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: sans-serif;
            background: antiquewhite;
            color: #005400;
            font-size: 1.3em;
        }
        #container {
            width: 500px;
            height: 100%;
            margin: auto;
        }
        h1 {
            color: #910000;
            text-align: center;
            margin-top: 60px;
            margin-bottom: 0;
        }
        .subtitle {
            text-align: center;
            font-size: 1.3em;
            margin-bottom: 80px;
        }
        .sub {
            margin-bottom: 80px;
        }
        h2 {
            color: #910000;
            font-size: 1.3em;
            border-bottom: 1px solid;
        }
        span {
            font-weight: bold;
            color: #0093c3;
        }
    </style>
</head>
<body>
<div id="container">
    <h1>Merry Christmas</h1>
    <div class="subtitle">Ho Ho Ho !</div>

    <p class="sub">
        I'm ready <a href="https://adventofcode.com/2020/">https://adventofcode.com/2020/</a>, it's you and me now.
    </p>

    <?php

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require_once 'core/loader.php';
        $santa = new Santa();

        foreach ($santa->getDays() as $date => $day) {
            echo '<h2>Day '.($date+1).'</h2>';
            echo '<p>The result for part 1 is: <span>'.$day->getResultPartOne().'</span><br>';
            echo 'The result for part 2 is: <span>'.$day->getResultPartTwo().'</span></p>';
        }

    ?>
</div>
</body>
</html>
