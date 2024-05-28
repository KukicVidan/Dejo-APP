<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);

    $db = new SQLite3('db/database.sqlite');

    // Retrieve the image path before deleting the record
    $stmt = $db->prepare('SELECT image FROM ratings WHERE id = :id');
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);

    if ($row) {
        $imagePath = $row['image'];

        // Delete the record from the database
        $stmt = $db->prepare('DELETE FROM ratings WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();

        if ($result) {
            // Delete the image file from the server
            if ($imagePath && file_exists($imagePath)) {
                unlink($imagePath);
            }
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete record.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Record not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
