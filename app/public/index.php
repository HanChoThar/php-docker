<!DOCTYPE html>
<html>
<head>
    <title>Local Time to UTC Time Converter</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <style>
        /* CSS Styles */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            padding: 20px;
            background-color: #f5f5f5;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        select {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 15px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .result {
            margin-top: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <?php

    // Function to convert local time to UTC time
    function convertToUTC($localTime, $timezone) {
        $dateTime = new DateTime($localTime, new DateTimeZone($timezone));
        $dateTime->setTimezone(new DateTimeZone('UTC'));
        return $dateTime->format('Y-m-d H:i:s');
    }

    // Array of predefined timezones
    $timezones = timezone_identifiers_list();
    $defaultTimezone = 'Asia/Yangon';

    // Default Timezone set
    date_default_timezone_set('Asia/Yangon'); // Set the desired time zone
    $localTimezone = date('y-m-d H:i:s');

    // Check if form is submitted
    if (isset($_POST['submit'])) {
        $localTime = $_POST['local_time'];
        $timezone = $_POST['timezone'];
        $utcTime = convertToUTC($localTime, $timezone);
    }
    ?>

    <div class="container">
        <h1>Local Time to UTC Time Converter</h1>
        <form method="POST">
            <div class="form-group">
                <label>Local Time:</label>
                <input type="text" name="local_time" id="local_time" value="<?php echo $localTimezone  ?>" placeholder="Enter local time (YYYY-MM-DD HH:MM:SS)" required />
            </div>
            <div class="form-group">
                <label>Timezone:</label>
                <select name="timezone" required>
                    <?php foreach ($timezones as $timezone): ?>
                        <option value="<?php echo $timezone; ?>" <?php if ($timezone === $defaultTimezone) echo 'selected'; ?>><?php echo $timezone; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="submit">Convert</button>
        </form>

        <?php if (isset($utcTime)): ?>
            <div class="result">
                <h3>Converted UTC Time:</h3>
                <p><?php echo $utcTime; ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
