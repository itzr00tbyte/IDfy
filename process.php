<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Generate a unique folder name
  $folderName = uniqid();

  // Create the folder
  $destination = "uploads/" . $folderName;
  if (!mkdir($destination, 0777, true)) {
    // Failed to create the folder
    echo "Failed to create the folder.";
    exit;
  }

  // Check if any files were uploaded
  if (isset($_FILES['file1']) && isset($_FILES['file2']) && isset($_FILES['file3'])) {
    // Handle file uploads
    $file1 = $_FILES['file1'];
    $file2 = $_FILES['file2'];
    $file3 = $_FILES['file3'];

    // Process and move file1 with the name "Holding_id.jpg"
    $file1Name = "Holding_id.jpg";
    $file1TmpName = $file1['tmp_name'];
    move_uploaded_file($file1TmpName, $destination . "/" . $file1Name);

    // Process and move file2 with the name "front.jpg"
    $file2Name = "front.jpg";
    $file2TmpName = $file2['tmp_name'];
    move_uploaded_file($file2TmpName, $destination . "/" . $file2Name);

    // Process and move file3 with the name "back.jpg"
    $file3Name = "back.jpg";
    $file3TmpName = $file3['tmp_name'];
    move_uploaded_file($file3TmpName, $destination . "/" . $file3Name);

    // Display success message or redirect to another page
    echo "Files uploaded successfully! Folder: " . $folderName;

    // Perform additional actions with the uploaded files as needed
  } else {
    // No files were uploaded
    echo "Please select files to upload.";
  }
}

// header("Location: send.php?");
?>

