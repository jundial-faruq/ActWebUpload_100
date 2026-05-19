<?php
header('Content-Type: application/json');

$upload_dir = "uploads/";
$allowed    = ["jpg", "jpeg", "png", "gif"];
$files      = [];

if (is_dir($upload_dir)) {
    foreach (scandir($upload_dir) as $file) {
        if ($file === '.' || $file === '..') continue;
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) continue;
        $files[] = [
            "name" => $file,
            "size" => filesize($upload_dir . $file),
            "time" => filemtime($upload_dir . $file),
        ];
    }
    // Urutkan terbaru dulu
    usort($files, fn($a, $b) => $b['time'] - $a['time']);
}

echo json_encode($files);
?>