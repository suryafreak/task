<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "relevant_information";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM relevant_information";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['applicant_id'] . "</td>";
        echo "<td>" . $row['relevant_institution'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td><a href='" . $row['further_documents'] . "' target='_blank'>View Document</a></td>";
        echo "<td>" . $row['created_on'] . "</td>";
        echo "<td>" . $row['updated_on'] . "</td>";
        echo "<td><a href='edit.php?applicant_id=" . $row['applicant_id'] . "#Relevant_Information'>Edit</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No records found</td></tr>";
}

$conn->close();
?>


