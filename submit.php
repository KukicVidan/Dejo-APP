// submit.php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $url = $_POST['url'];
    $rating = intval($_POST['rating']);


    $imagePath = null;
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imagePath = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    $db = new SQLite3('db/database.sqlite');
    $stmt = $db->prepare("INSERT INTO ratings (name, url, image, rating) VALUES (:name, :url, :image, :rating)");
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':url', $url, SQLITE3_TEXT);
    $stmt->bindValue(':image', $imagePath, SQLITE3_TEXT);
    $stmt->bindValue(':rating', $rating, SQLITE3_INTEGER);
    $stmt->execute();

    echo "Rating submitted successfully. <a href='index.php'>Go back</a>";
} else {
    echo "Invalid request.";
}
?>
