//** This ia a contact php **//
<?php
// Database connection details
$host = 'localhost';        // XAMPP uses localhost for MySQL
$username = 'root';         // Default MySQL username for XAMPP
$password = '';             // Default MySQL password for XAMPP (empty)
$database = 'sneaknation';  // Your database name (sneaknation)

// Initialize response variables
$response = array(
    'success' => false,
    'message' => ''
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $firstname = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Connect to the database
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        $response['message'] = "Connection failed: " . $conn->connect_error;
    } else {
        // Prepare SQL query using prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO contact_messages (firstname, lastname, email, phone, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone, $address); // "sssss" means 5 string parameters

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Your message has been sent successfully!";
        } else {
            $response['message'] = "There was an error submitting your message. Please try again.";
        }
        $stmt->close();
        $conn->close();
    }

    // Return the response as JSON
    echo json_encode($response);
}
?>
