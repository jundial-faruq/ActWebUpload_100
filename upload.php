<?php
$target_dir = "uploads/";

// Buat folder uploads jika belum ada
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Cek apakah file adalah gambar
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        echo "Berkas bukan gambar.";
        $uploadOk = 0;
    }
}

// Cek apakah file sudah ada
if ($uploadOk && file_exists($target_file)) {
    echo "Maaf, berkas sudah ada.";
    $uploadOk = 0;
}

// Cek ukuran file (maks 5 MB)
if ($uploadOk && $_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Maaf, berkas terlalu besar (maks 5MB).";
    $uploadOk = 0;
}

// Cek ekstensi
$allowed = ["jpg", "jpeg", "png", "gif"];
if ($uploadOk && !in_array($fileType, $allowed)) {
    echo "Maaf, hanya JPG, JPEG, PNG & GIF yang diperbolehkan.";
    $uploadOk = 0;
}

// Proses upload
if ($uploadOk == 0) {
    // Pesan error sudah dikirim di atas
    if (ob_get_length() === 0) {
        echo "Berkas tidak dapat diunggah.";
    }
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // Prefix OK: agar JS tahu upload berhasil
        echo "OK:Berkas \"" . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . "\" berhasil diunggah.";
    } else {
        echo "Terjadi kesalahan saat mengunggah berkas.";
    }
}
?>