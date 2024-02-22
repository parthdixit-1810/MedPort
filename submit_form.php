<?php
// Database connection parameters
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL query to insert data into the database
$sql = "INSERT INTO medical_history (patient_name, age, gender, height, weight, blood_pressure, oxygen_capacity, ongoing_medicines, previous_medicines, allergies, disease_history, medical_treatments, previous_doctor_comments, diagnosis, permanent_illness)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("siiiiisssssssss", $patientName, $age, $gender, $height, $weight, $bloodPressure, $oxygenCapacity, $ongoingMedicines, $previousMedicines, $allergies, $diseaseHistory, $medicalTreatments, $previousDoctorComments, $diagnosis, $permanentIllness);

// Set parameters and execute statement
$patientName = $_POST['patientName'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$bloodPressure = $_POST['bloodPressure'];
$oxygenCapacity = $_POST['oxygenCapacity'];
$ongoingMedicines = implode(", ", $_POST['ongoingMedicine']); // Convert array to comma-separated string
$previousMedicines = implode(", ", $_POST['previousMedicine']); // Convert array to comma-separated string
$allergies = implode(", ", $_POST['allergies']); // Convert array to comma-separated string
$diseaseHistory = $_POST['diseaseHistory'];
$medicalTreatments = $_POST['medicalTreatments'];
$previousDoctorComments = $_POST['previousDoctorComments'];
$diagnosis = $_POST['diagnosis'];
$permanentIllness = $_POST['permanentIllness'];

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
