<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "relevant_information";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if ($_FILES["fileUpload"]["size"] > 0) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["fileUpload"]["name"]);
        
        $targetFile = $targetDirectory . basename($_FILES["fileUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        if (file_exists($targetFile)) {
            $uploadOk = 0;
        }
    
        if ($_FILES["fileUpload"]["size"] > 500000) {
            $uploadOk = 0;
        }
    
        $allowedExtensions = array("pdf", "doc", "docx");
        if (!in_array($imageFileType, $allowedExtensions)) {
            $uploadOk = 0;
        }
    
        if ($uploadOk == 0) {
            die(json_encode(array("status" => "error", "result" => false, "message" => "File upload failed.")));
        } else {
            move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $targetFile);
        }
    } else {
        $targetFile = "";
    }    

    $applicant_id = isset($_POST['applicant_id']) ? intval($_POST['applicant_id']) : 0;

    if ($applicant_id > 0) {
        $relevantInformation = isset($_POST['relevantInformation']) ? $conn->real_escape_string($_POST['relevantInformation']) : '';
        $description = isset($_POST['description']) ? $conn->real_escape_string($_POST['description']) : '';

        $update_sql = "UPDATE relevant_information SET
                       relevant_institution = '$relevantInformation',
                       description = '$description',
                       further_documents = '$targetFile', 
                       updated_on = CURRENT_TIMESTAMP
                       WHERE applicant_id = $applicant_id";

        if ($conn->query($update_sql) === TRUE) {
            echo json_encode(array("status" => "success", "result" => true, "message" => "Record updated successfully"));
        } else {
            echo json_encode(array("status" => "error", "result" => false, "message" => "Error updating record: " . $conn->error));
        }
    } else {
        echo json_encode(array("status" => "error", "result" => false, "message" => "Invalid or missing applicant_id parameter"));
    }
} else {
    echo json_encode(array("status" => "error", "result" => false, "message" => "Invalid request method"));
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
      <a href="task.php">Task</a>
</body>
</html>