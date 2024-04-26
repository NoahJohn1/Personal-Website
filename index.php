<!--
Author: Noah Jackson
Course: Web Programming
Assignment:PHP Project
File purpose: Creates calender
-->

<?php

//Reference https://www.php.net/manual/en/function.cal-days-in-month.php
function getMonthLength($year, $month) {
    return cal_days_in_month(CAL_GREGORIAN, $month, $year);
}

function getFirstDayOfWeek($year, $month) {
    return date('w', strtotime("$year-$month-01"));
}

function generateCalendar($year, $month) {
    $monthLength = getMonthLength($year, $month);
    $firstDayOfWeek = getFirstDayOfWeek($year, $month);
    
    $calendarGrid = [];
    
    // Initialize the calendar grid with empty values
    for ($row = 0; $row < 6; $row++) {
        $calendarGrid[$row] = array_fill(0, 7, "");
    }
    
    // Fill in the days of the month
    $day = 1;
    for ($row = 0; $row < 6; $row++) {
        for ($col = 0; $col < 7; $col++) {
            if (($row == 0 && $col < $firstDayOfWeek) || $day > $monthLength) {
                // Fills blanks for days from previous or next month
                if ($row == 0 || $row == 4 ||$row == 5) {
                    $calendarGrid[$row][$col] = "_";
                }
            } else {
                // Fill in days of the current month
                $calendarGrid[$row][$col] = $day;
                $day++;
            }
        }
    }
    
    return $calendarGrid;
}

// Display the generated calendar
function displayCalendar($calendar) {
    echo "<table border='1'>";
    echo "<tr>
            <td>S</td>
            <td>M</td>
            <td>T</td>
            <td>W</td>
            <td>TR</td>
            <td>F</td>
            <td>S</td>
          </tr>";
    foreach ($calendar as $row) {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>";
            if ($cell !== '') {
                echo $cell;
            }
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>

<!DOCTYPE html>
<html lang="en-us">
    <head>
        <link rel="stylesheet">
        <title>PHP Calendar</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <!-- Button that returns the user to the projects page-->
        <a href="https://storage.googleapis.com/portfolio909350/projects.html">
            <button>Back to Projects</button>
        </a>
        <h1>PHP Calendar</h1>
        
        <!-- Form that allows the user to submit a year and month
            and generate the desired calendar-->
        <form method="post">
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" min="1900" max="9999" required>
            <label for="month">Month:</label>
            <input type="number" id="month" name="month" min="1" max="12" required>
            <button type="submit">Generate Calendar</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Process the form data
                $year = $_POST['year'];
                $month = $_POST['month'];
                $calendar = generateCalendar($year, $month);
                displayCalendar($calendar);
            }
        ?>
    </body>
</html>
