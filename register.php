<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $school_name = $_POST["school_name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize input data (You should implement proper validation)

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Create a PDO connection to the database
        $pdo = new PDO("mysql:host=localhost;dbname=your_database", "your_username", "your_password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert the registration data into the database
        $sql = "INSERT INTO schools (school_name, address, phone, email, password) VALUES (:school_name, :address, :phone, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':school_name', $school_name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();

        // Optionally, you can redirect the user to a thank-you page or login page.
        // header("Location: thank-you.php");
        // exit();
        
        echo "Registration successful. Thank you for registering your school!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
