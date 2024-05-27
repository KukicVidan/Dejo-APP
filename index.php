<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rate Items</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="form-container">
        <div class="card">
            <h1>Rate an Item</h1>
            <form action="submit.php" method="POST" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>

                <label for="url">URL:</label>
                <input type="url" id="url" name="url"><br>

                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*"><br>

                <label for="rating">Rating:</label>
                <div class="star-rating">
                    <input type="hidden" id="rating" name="rating">
                    <span class="star" data-value="1">&#9733;</span>
                    <span class="star" data-value="2">&#9733;</span>
                    <span class="star" data-value="3">&#9733;</span>
                    <span class="star" data-value="4">&#9733;</span>
                    <span class="star" data-value="5">&#9733;</span>
                </div><br>

                <input type="submit" value="Submit">
            </form>
            <a href="view.php">View Ratings</a>
        </div>
    </div>
    <script src="assets/scripts.js"></script>
</body>
</html>
