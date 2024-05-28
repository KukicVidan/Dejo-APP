<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Ratings</title>
    <link rel="stylesheet" href="assets/view-styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
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
            <label for="year"> Year:</label>
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
        <a href="index.php" class="navbar-link">⬅️BACK</a>
    </nav>

    <!-- Content Section -->
    <div class="view-container">
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
                echo "<div class='card' data-id='{$row['id']}'>";
                if ($row['image']) {
                    echo "<img src='{$row['image']}' alt='Image'>";
                }
                echo "<p>👩🏻Name: {$row['name']}</p>";
                if ($row['url']) {
                    echo "<p>🔗Insta: <a href='{$row['url']}'>Link</a></p>";
                }
                echo "<div class='star-rating'>";
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $row['rating']) {
                        echo "<span class='star selected' data-value='$i'>⭐️</span>"; // Filled star
                    } else {
                        echo "<span class='star' data-value='$i'>☆</span>"; // Empty star
                    }
                }
                echo "</div>";
                echo "<p>📅Date: " . date('d F Y', strtotime($row['created_at'])) . "</p>"; // Format date
                echo "<button class='delete-btn' data-id='{$row['id']}' title='briši kurvu' >🗑️</button>"; // Delete button
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.delete-btn').click(function() {
            var card = $(this).closest('.card');
            var id = $(this).data('id');
            $.post('delete.php', { id: id }, function(response) {
                if (response.success) {
                    card.remove();
                } else {
                    alert('Error deleting card.');
                }
            }, 'json');
        });
    });
    </script>
</body>
</html>
