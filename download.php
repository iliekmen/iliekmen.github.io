<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $videoUrl = $_POST["video-url"];
    $quality = $_POST["quality"];

    // Validate the YouTube video URL and quality if needed

    // Construct the command to download the video using youtube-dl
    $command = "youtube-dl -f $quality --output 'downloads/%(title)s.%(ext)s' $videoUrl";

    // Execute the command
    exec($command, $output, $returnCode);

    if ($returnCode === 0) {
        // If the command executed successfully, retrieve the downloaded video's file name
        $fileName = $output[0];

        // Generate the download link
        $downloadLink = "downloads/$fileName";

        // Redirect the user to the download link
        header("Location: $downloadLink");
        exit();
    } else {
        // Handle any errors that occurred during the download process
        echo "<p>An error occurred during the download process.</p>";
    }
}
?>
