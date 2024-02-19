<?php 
  /**
   * Checks if the uploaded file has a valid photo extension.
   *
   * @param string $fieldName The name attribute of the file input in the form.
   * @return bool Returns true if the file is a valid photo format; otherwise, false.
   */
  function isValidPhoto($fieldName) {
      // Check if the file was uploaded without error
      if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] != 0) {
          return false; // File upload failed or no file was uploaded
      }

      // Get the file name from the uploaded file
      $fileName = $_FILES[$fieldName]['name'];

      // Extract the file extension
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

      // Define allowed photo extensions
      $allowedExtensions = ['jpg', 'jpeg', 'png', 'tiff'];

      // Check if the file extension is in the list of allowed photo formats
      if (in_array($fileExtension, $allowedExtensions)) {
          return true; // File is a valid photo
      } else {
          return false; // File is not a valid photo
      }
  }

  if (isValidPhoto('fileToUpload')) {
      // Process the upload
      echo "The file is a valid photo.";
      // Add your file processing logic here (e.g., move the file to a new location)
  } else {
      // Handle invalid file type
      echo "The file is not a valid photo. Please upload a jpg, png, or tiff file.";
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
    <h2>Upload a File</h2>
    <!-- The action attribute should point to the server-side script that will handle the file upload -->
    <form method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Select file to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br><br>
        <input type="submit" value="Upload File" name="submit">
    </form>
</body>
</html>
