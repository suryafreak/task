<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "relevant_information";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "result" => false, "message" => "Connection failed: " . $conn->connect_error)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $targetDirectory = "uploads/";
    
    if ($_FILES["fileUpload"]["size"] > 0) {
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

    $checkQuery = "SELECT MAX(applicant_id) AS max_applicant_id FROM relevant_information";
    $result = $conn->query($checkQuery);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentApplicantId = $row['max_applicant_id'] + 1;
    } else {
        $currentApplicantId = 1;
    }

    $relevantInformation = isset($_POST['relevantInformation']) ? $conn->real_escape_string($_POST['relevantInformation']) : '';
    $description = isset($_POST['description']) ? $conn->real_escape_string($_POST['description']) : '';


    $sql = "INSERT INTO relevant_information (applicant_id, relevant_institution, description, further_documents, created_on, updated_on) 
            VALUES ('$currentApplicantId', '$relevantInformation', '$description', '$x`', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "result" => true, "message" => "Details uploaded successfully"));
    } else {
        echo json_encode(array("status" => "error", "result" => false, "message" => "Error: " . $sql . "<br>" . $conn->error));
    }
} else {
    echo json_encode(array("status" => "error", "result" => false, "message" => "Invalid request method"));
}

$conn->close();
?>

