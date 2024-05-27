<!-- view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Ratings</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="view-container">
        <div class="filter">
            <form action="view.php" method="GET">
                <label for="month">Month:</label>
                <select id="month" name="month">
                    <option value="">All</option>
                    <?php
                    for ($m = 1; $m <= 12; $m++) {
                        $month = date('F', mktime(0, 0, 0, $m, 1));
                        echo "<option value='$m'>$month</option>";
                    }
                    ?>
                </select>
                <label for="year">Year:</label>
                <select id="year" name="year">
                    <option value="">All</option>
                    <?php
                    $currentYear = date('Y');
                    for ($y = 2000; $y <= $currentYear; $y++) {
                        echo "<option value='$y'>$y</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Filter">
            </form>
        </div>

        <div class="cards">
            <?php
            $db = new SQLite3('db/database.sqlite');

            $month = isset($_GET['month']) ? $_GET['month'] : '';
            $year = isset($_GET['year']) ? $_GET['year'] : '';

            $query = "SELECT * FROM ratings WHERE 1=1";
            if ($month) {
                $query .= " AND strftime('%m', created_at) = '".str_pad($month, 2, "0", STR_PAD_LEFT)."'";
            }
            if ($year) {
                $query .= " AND strftime('%Y', created_at) = '$year'";
            }
            $query .= " ORDER BY created_at DESC";

            $results = $db->query($query);

            while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                echo "<div class='card'>";
                if ($row['image']) {
                    echo "<img src='{$row['image']}' alt='Image'>";
                }
                echo "<p>Name: {$row['name']}</p>";
                if ($row['url']) {
                    echo "<p>URL: <a href='{$row['url']}'>Link</a></p>";
                }
                echo "<p>Rating: {$row['rating']}</p>";
                echo "<p>Date: {$row['created_at']}</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
