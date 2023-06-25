<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - File Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        .file-info {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .file-name {
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }

        .image-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .image-preview {
            max-width: 200px;
            max-height: 200px;
            margin: 10px;
            border: 4px solid #ccc;
            border-radius: 5px;
            transition: transform 0.3s ease-in-out;
        }

        .image-preview:hover {
            transform: scale(1.1);
        }

        .file-name {
            text-align: center;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .view-button,
        .download-button,
        .delete-button,
        .send-button {
            padding: 5px 10px;
            background-color: #ccc;
            color: #000;
            text-decoration: none;
            border-radius: 3px;
            font-weight: bold;
            margin: 0 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .view-button:hover,
        .download-button:hover,
        .delete-button:hover,
        .send-button:hover {
            background-color: #999;
        }

        .delete-button {
            background-color: #ff0000;
            color: #fff;
        }

        .send-button {
            background-color: #008000;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>Admin Panel - File Results</h1>

    <?php
    // Specify the path to the uploads folder
    $uploadsPath = "uploads/";

    // Get all folders in the uploads directory
    $folders = glob($uploadsPath . "*", GLOB_ONLYDIR);

    // Check if any folders were found
    if (!empty($folders)) {
        // Loop through each folder
        foreach ($folders as $folder) {
            // Get the folder name and creation time
            $folderName = basename($folder);
            $folderTime = date("Y-m-d H:i:s", filectime($folder));

            // Get all files inside the folder
            $files = glob($folder . "/*");

            // Check if any files were found
            if (!empty($files)) {
                echo '<div class="file-info">';
                echo '<div class="file-name">Folder: ' . $folderName . ' (Created: ' . $folderTime . ')</div>';
                echo '<div class="image-container">';
                // Loop through each file in the folder
                foreach ($files as $file) {
                    // Get the file name
                    $fileName = basename($file);

                    echo '<div>';
                    echo '<img class="image-preview" src="' . $file . '" alt="Image">';
                    echo '<div class="file-name">' . $fileName . '</div>';
                    echo '<div class="action-buttons">';
                    echo '<a class="view-button" href="' . $file . '" target="_blank">View</a>';
                    echo '<a class="download-button" href="' . $file . '" download>Download</a>';
                    echo '<a class="delete-button" href="?delete=' . urlencode($file) . '">Delete</a>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';

                // Add the button to send the folder to Telegram
                echo '<div class="action-buttons">';
                echo '<a class="send-button" href="send.php?folder=' . urlencode($folder) . '">Send to Telegram</a>';
                echo '</div>';

                echo '</div>';
            }
        }

        // Check if a delete request was made
        if (isset($_GET['delete'])) {
            $deleteFilePath = urldecode($_GET['delete']);
            if (file_exists($deleteFilePath)) {
                unlink($deleteFilePath);
                echo "<p>File \"$deleteFilePath\" has been deleted.</p>";
            }
        }
    } else {
        echo "<p>No folders found in the uploads directory.</p>";
    }
    ?>
</body>
</html>
