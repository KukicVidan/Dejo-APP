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
            <h1>Jeko treba?</h1>
            <form action="submit.php" method="POST" enctype="multipart/form-data">
                <label for="name"></label>
                <input type="text" id="name" name="name" required placeholder="👩🏻 Name"><br>
            
                
                <label for="url"></label>
                <input type="url" id="url" name="url" placeholder="🔗Instagram URL"><br>

                <label for="image">📷Image:</label>
                <input type="file" id="image" name="image" accept="image/*"><br>

                <label for="rating">💘Rating:</label>
                <div class="star-rating">
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1">&#9733;</label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2">&#9733;</label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3">&#9733;</label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4">&#9733;</label>
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5">&#9733;</label>
                </div><br>

                <input type="submit" value="Submit">
            </form>
            <a href="view.php">View Ratings</a>
        </div>
    </div>
    <script src="assets/scripts.js"></script>
</body>
</html>
