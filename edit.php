<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "relevant_information";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$applicant_id = $relevantInformation = $description = $uploadedFileName = '';

//Edit
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $applicantId = isset($_GET['applicant_id']) ? intval($_GET['applicant_id']) : 0;

    if ($applicantId > 0) {
        $sql = "SELECT * FROM relevant_information WHERE applicant_id = $applicantId";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $applicant_id = $row['applicant_id'];
            
            $relevantInformation = isset($row['relevant_institution']) ? $row['relevant_institution'] : '';
            $description = isset($row['description']) ? $row['description'] : '';
            $uploadedFileName = isset($row['further_documents']) ? $row['further_documents'] : '';

            echo json_encode(array("status" => "success", "result" => true, "data" => $row, "message" => "Details Retrieved Successfully"));
            // exit;
        } else {
            echo json_encode(array("status" => "error", "result" => false, "message" => "No data found for the provided applicant_id"));
        }
    } else {
        echo json_encode(array("status" => "error", "result" => false, "message" => "Invalid or missing applicant_id parameter"));
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    <script src="common.js"></script>
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'Investigations_Record')">
            <div class="icon-container">
                <i class="bi bi-file-text-fill"></i>
                <span>Investigations Record</span>
            </div>
        </button>
        <button class="tablinks" onclick="openTab(event, 'Additional_Information')">
            <div class="icon-container">
                <i class="bi bi-layout-text-window"></i>
                <span>Additional Information</span>
            </div>
        </button>
        <button class="tablinks next-tab" onclick="openTab(event, 'Relevant_Information')">
            <div class="icon-container">
                <i class="bi bi-file-earmark-post"></i>
                <span>Relevant Information</span>
            </div>
        </button>
        <button class="tablinks " onclick="openTab(event, 'Declaration')">
            <div class="icon-container">
            <i class="bi bi-journal"></i>
            <span>Declaration</span>
            </div>
        </button>
        <button class="tablinks" onclick="openTab(event, 'Fees')">
            <div class="icon-container">
                <i class="bi bi-wallet-fill"></i>
                <span>Fees</span>
            </div>
        </button>
    </div>

    <div id="Investigations_Record" class="tabcontent">
    <h3 style="background-color: green; color: white; padding: 10px;">6.Investigations Record</h3>
    <div class="info-box">
        <p>No Data Found</p>
    </div>
    </div>

    <div id="Additional_Information" class="tabcontent">
    <h3 style="background-color: green; color: white; padding: 10px;">7.Additional Information</h3>
    <div class="info-box">
        <p>No Data Found</p>
    </div>
    </div>

    <form action="update.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
      <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>">
        <div id="Relevant_Information" class="tabcontent">
            <h3 style="background-color: green; color: white; padding: 10px;">8. Relevant Information</h3>
            <div class="info-box">
                <p style="text-align:left;">8.1 Is there any information that the Capital Market Institutions think will be relevant in considering this application? *</p>

                <input type="radio" id="yes" name="relevantInformation" value="yes" <?php echo ($relevantInformation == 'yes') ? 'checked' : ''; ?>>
                <label for="yes">Yes</label>

                <input type="radio" id="no" name="relevantInformation" value="no" <?php echo ($relevantInformation == 'no') ? 'checked' : ''; ?>>
                <label for="no">No</label>

                <div class="error-message" id="error-msg"></div>

                <p style="text-align:left;">If yes, please describe below and provide supporting documents (if any):</p>
                <textarea id="description" name="description" rows="4" cols="50" placeholder=""><?php echo $description; ?></textarea>
                <p id="char-count" class="char-count"><?php echo strlen($description); ?>/2000 Characters Entered</p>

                <p style="text-align:left;">Please attach further documents (if any)</p>
                <label for="fileUpload" class="custom-file-upload">
                    Upload
                </label>
                <input type="file" id="fileUpload" name="fileUpload" accept=".pdf, .doc, .docx" style="display:none;" onchange="displayFileName()">
                <p style="text-align:left;" id="file-name"><?php echo $uploadedFileName; ?></p>

            </div>
            <button type="submit" name="update" class="btn-save">Update</button>
        </div>
    </form>

    <div id="Declaration" class="tabcontent">
        <h3 style="background-color: green; color: white; padding: 10px;">9.Declaration</h3>
        <div class="info-box">
            <p>No Data Found</p>
        </div>
    </div>

    <div id="Fees" class="tabcontent">
        <h3 style="background-color: green; color: white; padding: 10px;">10.Fees</h3>
        <div class="info-box">
            <p>No Data Found</p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var editButton = document.getElementById('edit-button');
            if (editButton) {
                editButton.addEventListener('click', function () {
                    openTab(event, 'Relevant_Information');
                });
            }
        });
    </script>
</body>
</html>

