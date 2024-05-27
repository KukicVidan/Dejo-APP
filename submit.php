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

    // Output JavaScript code to show a styled popup alert
    echo "<script>
            setTimeout(function() {
                var alertDiv = document.createElement('div');
                alertDiv.textContent = 'Rating submitted successfully.';
                alertDiv.style.cssText = 'position: fixed; bottom: 20px; right: 20px; padding: 10px; background-color: #4CAF50; color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);';
                document.body.appendChild(alertDiv);
                setTimeout(function() {
                    alertDiv.style.display = 'none';
                    window.location.href = 'index.php'; // Redirect to index.php after alert is closed
                }, 900); // Popup alert disappears after 2 seconds (2000 milliseconds)
            }, 60); // Delay to ensure it's displayed after PHP output
          </script>";
} else {
    echo "Invalid request.";
}
?>
