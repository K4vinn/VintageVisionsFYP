<?php
include("../Includes/admin-main.php");
include("../Config/Database.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_variation = $_POST['product_variation'];
    $product_description = $_POST['product_description'];
    $product_stock = $_POST['product_stock'];
    $imgp = "/Images/" . basename($_FILES['product_image']['name']);
    $imgp1 = "/Images/" . basename($_FILES['product_image_prev1']['name']);
    $imgp2 = "/Images/" . basename($_FILES['product_image_prev2']['name']);
    $imgpqr = "/Images/" . basename($_FILES['QRcode']['name']);

    // Handle file uploads
    $uploadDirectory = "C:/xampp/htdocs/Finalyearproject/Images";
    $uploadDirectoryQR = "C:/xampp/htdocs/Finalyearproject/QR";
    $imageProduct = uploadFile($_FILES['product_image'], $uploadDirectory);
    $imagePrev1Path = uploadFile($_FILES['product_image_prev1'], $uploadDirectory);
    $imagePrev2Path = uploadFile($_FILES['product_image_prev2'], $uploadDirectory);
    $qrCodePath = uploadFileQR($_FILES['QRcode'], $uploadDirectoryQR);

    // Insert query with file names
    $sql = "INSERT INTO products (product_name, product_price, product_category, product_variation, product_description, product_stock, product_image, product_image_prev1, product_image_prev2, QRcode)
            VALUES (
                '$product_name',
                '$product_price',
                '$product_category',
                '$product_variation',
                '$product_description',
                '$product_stock',
                '$imgp',
                '$imgp1',
                '$imgp2',
                '$imgpqr'
            )";

    if (mysqli_query($con, $sql)) {
        echo "Record added successfully";
    } else {
        echo "Error adding record: " . mysqli_error($con);
    }
}

// Function to handle file uploads
function uploadFile($file, $uploadDirectory)
{
    $targetFile = $uploadDirectory . '/' . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 500000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only specific file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

function uploadFileQR($file, $uploadDirectoryQR)
{
    $targetFileQR = $uploadDirectoryQR . '/' . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFileQR, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFileQR)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 500000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only specific file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($file["tmp_name"], $targetFileQR)) {
            return $targetFileQR;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
