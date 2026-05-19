<?php
$upload_dir = "uploads/";

if (!isset($_POST["filename"]) || empty($_POST["filename"])) {
    echo "Nama file tidak valid.";
    exit;
}

// Sanitasi: hanya ambil basename, cegah path traversal
$filename = basename($_POST["filename"]);
$filepath = $upload_dir . $filename;

// Pastikan file ada dan berada di folder uploads
if (!file_exists($filepath)) {
    echo "File tidak ditemukan.";
    exit;
}

if (unlink($filepath)) {
    echo "OK:File \"" . htmlspecialchars($filename) . "\" berhasil dihapus.";
} else {
    echo "Gagal menghapus file.";
}
?>