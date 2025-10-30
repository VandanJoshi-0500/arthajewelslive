<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Database connection
$host = 'localhost';  // Database host
$dbname = 'jbjowgdc_arthajewels';  // Database name
$username = 'jbjowgdc_arthajewels';  // Database username
$password = 'Y5TthT0ZD%F%';  // Database password

// Create PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Normalize function to clean data
function normalize($value) {
    return trim($value); // You can add any other normalization logic you need
}

// Function to upload CSV and process it
function uploadCsvAndUpdateImages($csvFile) {
    global $pdo;
    $results = []; // This will store the results for display after processing the CSV file

    // Open CSV file
    if (($handle = fopen($csvFile, 'r')) !== false) {
            $headers = fgetcsv($handle);
            //$headers = array_map('strtolower', array_map('trim', $headers)); // Normalize header names

            while (($row = fgetcsv($handle)) !== false) {
                $data = array_combine($headers, $row); // Combine the headers with the row data

                // Normalize values as needed
                $sku = normalize($data['No']); // Assuming 'No' is the SKU in the CSV
                $description3 = normalize($data['Description3']);
        
                // Prepare SQL query to check if SKU exists
                $stmt = $pdo->prepare("SELECT id FROM products WHERE sku = :sku");
                $stmt->execute(['sku' => $sku]);
                $image_type =2;
                // Set status and active based on quantity
                $status = 1;
                $active = 1;

                // Check if product exists
                $stmt = $pdo->prepare("SELECT id FROM products WHERE sku = :sku");
                $stmt->execute(['sku' => $sku]);

                if ($stmt->rowCount() > 0) {
                    // Product exists, perform an update
                    $productId = $stmt->fetchColumn();
                    $updateQuery = "
                        UPDATE products SET
                            long_description3 = :description3
                        WHERE id = :id";

                        $updateStmt = $pdo->prepare($updateQuery);
                        $updateStmt->execute([
                            'description3' => $description3,
                            'id' => $productId
                        ]);
                        
                    $results[] = ['sku' => $sku, 'status' => 'updated'];
                }
            }

        // Close the file
        fclose($handle);
    } else {
        echo "Failed to open the CSV file.";
    }

    return $results; // Return the results to be displayed
}

// Check if the form was submitted and process the CSV
$results = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv_file'])) {
    $fileTmpPath = $_FILES['csv_file']['tmp_name'];
    $fileName = $_FILES['csv_file']['name'];
    $fileSize = $_FILES['csv_file']['size'];
    $fileType = $_FILES['csv_file']['type'];
    $fileNameCmps = explode('.', $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Check if the file is a CSV
    if ($fileExtension === 'csv') {
        // Upload CSV and update products
        $results = uploadCsvAndUpdateImages($fileTmpPath);
    } else {
        echo "Please upload a valid CSV file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV and Update Product Images</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        } 
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Upload CSV to Update Product Images</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="csv_file">Select CSV file:</label>
        <input type="file" name="csv_file" id="csv_file" required>
        <button type="submit">Upload and Update</button>
    </form>

    <?php if (!empty($results)): ?>
        <h3>Update Results</h3>
        <table>
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($result['sku']); ?></td>
                        <td><?php echo htmlspecialchars($result['status']); ?></td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>