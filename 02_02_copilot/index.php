<?php
function validateAndUploadImage($file) {
	$target_dir = "uploads/";
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	$check = getimagesize($file["tmp_name"]);
	if($check === false) {
		throw new Exception("File is not an image.");
	}

	// Check if file is a valid image type (jpg, png, tiff)
	$allowedTypes = ['jpg', 'jpeg', 'png', 'tiff'];
	if(!in_array($imageFileType, $allowedTypes)) {
		throw new Exception("Sorry, only JPG, PNG, & TIFF files are allowed.");
	}

	// Generate a unique name for the file
	$target_file = $target_dir . uniqid() . '.' . $imageFileType;

	// Try to upload file
	if (!move_uploaded_file($file["tmp_name"], $target_file)) {
		throw new Exception("Sorry, there was an error uploading your file.");
	}

	echo "The file has been uploaded.";
}

// Usage
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
	try {
		validateAndUploadImage($_FILES["fileToUpload"]);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>File Upload Form</title>
</head>
<body>

<form action="index.php" method="post" enctype="multipart/form-data">
	<label for="fileToUpload">Select file to upload:</label>
	<input type="file" name="fileToUpload" id="fileToUpload">
	<input type="submit" value="Upload File" name="submit">
</form>

</body>
</html>