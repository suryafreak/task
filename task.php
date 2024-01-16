<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<script src="common.js"></script>
<style>
    table {
        margin-top: 10px;
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
</style>

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

<form action="db.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div id="Relevant_Information" class="tabcontent">
        <h3 style="background-color: green; color: white; padding: 10px;">8. Relevant Information</h3>
        <div class="info-box">
            <p style="text-align:left;">8.1 Is there any information that the Capital Market Institutions think will be relevant in considering this application? *</p>

            <input type="radio" id="yes" name="relevantInformation" value="yes">
            <label for="yes">Yes</label>

            <input type="radio" id="no" name="relevantInformation" value="no">
            <label for="no">No</label>

            <div class="error-message" id="error-msg"></div>

            <p style="text-align:left;">If yes, please describe below and provide supporting documents (if any):</p>
            <textarea id="description" name="description" rows="4" cols="50" placeholder=""></textarea>
            <p id="char-count" class="char-count">0/2000 Characters Entered</p>

            <p style="text-align:left;">Please attach further documents (if any)</p>
            <label for="fileUpload" class="custom-file-upload">
                Upload
            </label>
            <input type="file" id="fileUpload" name="fileUpload" accept=".pdf, .doc, .docx" style="display:none;" onchange="displayFileName()">
            <p style="text-align:left;" id="file-name"></p>
        </div>
        <button class="btn-save" type="submit">Save</button>
        <button class="btn" type="button" onclick="nextTab()">Next</button>
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

<div>
    <h3>Relevant Information Table:</h3>
    <table>
        <thead>
            <tr>
                <th>Applicant ID</th>
                <th>Relevant Institution</th>
                <th>Description</th>
                <th>Further Documents</th>
                <th>Created On</th>
                <th>Updated On</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'display_records.php'; ?>
        </tbody>
    </table>
</div>
</body>
</html>
