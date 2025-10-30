<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Database connection
$host = 'localhost';  // Database host
$dbname = 'arthajewelsnewwp';  // Database name
$username = 'arthajewelsnewwp';  // Database username
$password = 'G3uiFLp7dFoHzAz7DE77';  // Database password

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
                $description = normalize($data['Description']);
                $description2 = normalize($data['Description2']);
                $mainStone = normalize($data['MainStone']);
                $collection = normalize($data['Collection']);
                $category = normalize($data['ItemCategory']);
                $primaryCollection = normalize($data['Primarycollection']);
                $price = floatval(str_replace(',', '', normalize($data['Price'])));
                $quantityStock = intval(normalize($data['InventoryOnHand']));
                $quantityMemo = intval(normalize($data['InventoryOnMemo']));
                $showOnWeb = normalize($data['Showonweb']);
                $showOnDibs = normalize($data['ShowonDibs']);
                $showOnBluefly = normalize($data['ShowonBluefly']);
                $showOnEtsy = normalize($data['ShowonEtsy']);
                $showOnCustom1 = normalize($data['ShowonCustom1']);
                $showOnCustom2 = normalize($data['ShowonCustom2']);
                $showOnCustom3 = normalize($data['ShowonCustom3']);
                $showOnCustom4 = normalize($data['ShowonCustom4']);
                $showOnCustom5 = normalize($data['ShowonCustom5']);
                $donotList = normalize($data['DoNotList']);
                $ebay = normalize($data['eBay']);
                $amazon = normalize($data['Amazon']);
                $artisan = normalize($data['Artisan']);
                $socheec = normalize($data['Socheec']);
                $otherImageUrl1 = normalize($data['OtherImageUrl1']);
                $itemCategoryCode = normalize($data['ItemCategoryCode']);
                $metalType = normalize($data['MetalType']);
                $tagPrice = floatval(str_replace(',', '', normalize($data['TagPrice'])));
                $ugiTerm = normalize($data['UGITerm']);
                $size = normalize($data['Size']);
                $otherImageUrl2 = normalize($data['OtherImageUrl2']);
                $otherImageUrl3 = normalize($data['OtherImageUrl3']);
                $otherImageUrl4 = normalize($data['OtherImageUrl4']);
                $otherImageUrl5 = normalize($data['OtherImageUrl5']);
                $createdAt = normalize($data['DateCreated']); // Assuming this is a timestamp
                $updatedAt = normalize($data['Datemodified']); // Assuming this is a timestamp
        
                // Prepare SQL query to check if SKU exists
                $stmt = $pdo->prepare("SELECT id FROM products WHERE sku = :sku");
                $stmt->execute(['sku' => $sku]);
                $image_type =2;
                // Set status and active based on quantity
                $status = 1;
                $active = 1;

                // Check and get or create collection ID
                $collectionId = null;
                if ($collection) {
                    $stmt = $pdo->prepare("SELECT id FROM collections WHERE name = ?");
                    $stmt->execute([$collection]);
                    $collectionId = $stmt->fetchColumn();

                    if (!$collectionId) {
                        $stmt = $pdo->prepare("INSERT INTO collections (name, created_at, updated_at) VALUES (?, NOW(), NOW())");
                        $stmt->execute([$collection]);
                        $collectionId = $pdo->lastInsertId();
                    }
                }

                // Check and get or create category ID
                $categoryId = null;
                if ($category) {
                    $stmt = $pdo->prepare("SELECT id FROM categories WHERE name = ?");
                    $stmt->execute([$category]);
                    $categoryId = $stmt->fetchColumn();

                    if (!$categoryId) {
                        $stmt = $pdo->prepare("INSERT INTO categories (name, created_at, updated_at) VALUES (?, NOW(), NOW())");
                        $stmt->execute([$category]);
                        $categoryId = $pdo->lastInsertId();
                    }
                }

                // Check if product exists
                $stmt = $pdo->prepare("SELECT id FROM products WHERE sku = :sku");
                $stmt->execute(['sku' => $sku]);

                if ($stmt->rowCount() > 0) {
                    // Product exists, perform an update
                    $productId = $stmt->fetchColumn();
                    $updateQuery = "
                        UPDATE products SET
                            name = :sku,
                            collection = :collection,
                            category = :category,
                            primary_collection = :primaryCollection,
                            price = :price,
                            tag_price = :tagPrice,
                            quantity_stock = :quantityStock,
                            quantity_memo = :quantityMemo,
                            long_description = :description,
                            long_description2 = :description2,
                            long_description3 = :mainStone,
                            show_on_web = :showOnWeb,
                            showondibs = :showOnDibs,
                            showonbluefly = :showOnBluefly,
                            showonetsy = :showOnEtsy,
                            showoncustom1 = :showOnCustom1,
                            showoncustom2 = :showOnCustom2,
                            showoncustom3 = :showOnCustom3,
                            showoncustom4 = :showOnCustom4,
                            showoncustom5 = :showOnCustom5,
                            donotlist = :donotList,
                            ebay = :ebay,
                            amazon = :amazon,
                            artisan = :artisan,
                            socheec = :socheec,
                            thumbnail_url = :thumbnail_url,
                            item_category_code = :itemCategoryCode,
                            metal_type = :metalType,
                            ugi_term = :ugiTerm,
                            size = :size,
                            image_type = :image_type,
                            status = :status,
                            active = :active,
                            image = :image_url,  -- otherImageUrl1 as image_url
                            updated_at = NOW()
                        WHERE id = :id";

                        $updateStmt = $pdo->prepare($updateQuery);
                        $updateStmt->execute([
                            'sku' => $sku,
                            'description' => $description,
                            'collection' => $collectionId,
                            'category' => $categoryId,
                            'primaryCollection' => $primaryCollection,
                            'price' => $tagPrice,
                            'tagPrice' => $tagPrice,
                            'quantityStock' => $quantityStock,
                            'quantityMemo' => $quantityMemo,
                            'description2' => $description2,
                            'mainStone' => $mainStone,
                            'showOnWeb' => $showOnWeb,
                            'showOnDibs' => $showOnDibs,
                            'showOnBluefly' => $showOnBluefly,
                            'showOnEtsy' => $showOnEtsy,
                            'showOnCustom1' => $showOnCustom1,
                            'showOnCustom2' => $showOnCustom2,
                            'showOnCustom3' => $showOnCustom3,
                            'showOnCustom4' => $showOnCustom4,
                            'showOnCustom5' => $showOnCustom5,
                            'donotList' => $donotList,
                            'ebay' => $ebay,
                            'amazon' => $amazon,
                            'artisan' => $artisan,
                            'socheec' => $socheec,
                            'thumbnail_url' => $otherImageUrl1,  // Assign the value from the CSV to thumbnail_url
                            'itemCategoryCode' => $itemCategoryCode,
                            'metalType' => $metalType,
                            'ugiTerm' => $ugiTerm,
                            'size' => $size,
                            'image_url' => $otherImageUrl1,  // otherImageUrl1 as image_url
                            'id' => $productId,
                            'image_type' => $image_type,
                            'status' => $status,
                            'active' => $active
                        ]);
                        
                    $results[] = ['sku' => $sku, 'status' => 'updated'];
                }
                else{
                    $insertQuery = "
                    INSERT INTO products (
                        sku, name, collection, category, primary_collection, price, tag_price,
                        quantity_stock, quantity_memo, long_description, long_description2,
                        long_description3, show_on_web, showondibs, showonbluefly, showonetsy,
                        showoncustom1, showoncustom2, showoncustom3, showoncustom4, showoncustom5,
                        donotlist, ebay, amazon, artisan, socheec, thumbnail_url, metal_type,
                        inventory, item_category_code, ugi_term, size, created_at, updated_at, image, image_type, status, active
                    ) VALUES (
                        :sku, :sku, :collection, :category, :primaryCollection, :price, :tagPrice,
                        :quantityStock, :quantityMemo, :description, :description2, :mainStone, :showOnWeb,
                        :showOnDibs, :showOnBluefly, :showOnEtsy, :showOnCustom1, :showOnCustom2, :showOnCustom3,
                        :showOnCustom4, :showOnCustom5, :donotList, :ebay, :amazon, :artisan, :socheec,
                        :otherImageUrl1, :metalType, :inventory, :itemCategoryCode, :ugiTerm, :size, NOW(), NOW(), :image_url, :image_type, :status, :active
                    )";
                    $insertStmt = $pdo->prepare($insertQuery);
                    $insertStmt->execute([
                        'sku' => $sku,
                        'description' => $description,
                        'collection' => $collectionId,
                        'category' => $categoryId,
                        'primaryCollection' => $primaryCollection,
                        'price' => $price,
                        'tagPrice' => $tagPrice,
                        'quantityStock' => $quantityStock,
                        'quantityMemo' => $quantityMemo,
                        'description2' => $description2,
                        'mainStone' => $mainStone,
                        'showOnWeb' => $showOnWeb,
                        'showOnDibs' => $showOnDibs,
                        'showOnBluefly' => $showOnBluefly,
                        'showOnEtsy' => $showOnEtsy,
                        'showOnCustom1' => $showOnCustom1,
                        'showOnCustom2' => $showOnCustom2,
                        'showOnCustom3' => $showOnCustom3,
                        'showOnCustom4' => $showOnCustom4,
                        'showOnCustom5' => $showOnCustom5,
                        'donotList' => $donotList,
                        'ebay' => $ebay,
                        'amazon' => $amazon,
                        'artisan' => $artisan,
                        'socheec' => $socheec,
                        'otherImageUrl1' => $otherImageUrl1,
                        'metalType' => $metalType,
                        'inventory' => $quantityStock, // assuming inventory = quantity_stock
                        'itemCategoryCode' => $itemCategoryCode,
                        'ugiTerm' => $ugiTerm,
                        'size' => $size,
                        'image_url' => $otherImageUrl1,
                        'image_type' => $image_type,
                        'status' => $status,
                        'active' => $active
                    ]);
                    $results[] = ['sku' => $sku, 'status' => 'Added'];
                }
                /*if ($exists) {
                    // Update existing product
                    $updateQuery = "
                        UPDATE products SET
                            name = :sku,
                            collection = :collection,
                            category = :category,
                            primary_collection = :primaryCollection,
                            price = :price,
                            tag_price = :tagPrice,
                            quantity_stock = :quantityStock,
                            quantity_memo = :quantityMemo,
                            long_description = :description,
                            long_description2 = :description2,
                            long_description3 = :mainStone,
                            show_on_web = :showOnWeb,
                            showondibs = :showOnDibs,
                            showonbluefly = :showOnBluefly,
                            showonetsy = :showOnEtsy,
                            showoncustom1 = :showOnCustom1,
                            showoncustom2 = :showOnCustom2,
                            showoncustom3 = :showOnCustom3,
                            showoncustom4 = :showOnCustom4,
                            showoncustom5 = :showOnCustom5,
                            donotlist = :donotList,
                            ebay = :ebay,
                            amazon = :amazon,
                            artisan = :artisan,
                            socheec = :socheec,
                            thumbnail_url = :otherImageUrl1,
                            item_category_code = :itemCategoryCode,
                            metal_type = :metalType,
                            ugi_term = :ugiTerm,
                            size = :size,
                            image_type = :image_type,
                            status = :status,
                            active = :active,
                            other_image_url1 = :otherImageUrl2,
                            other_image_url2 = :otherImageUrl3,
                            other_image_url3 = :otherImageUrl4,
                            other_image_url4 = :otherImageUrl5,
                            updated_at = NOW()
                        WHERE id = :id";
                    $updateStmt = $pdo->prepare($updateQuery);
                    $updateStmt->execute([
                        'sku' => $sku,
                        'description' => $description,
                        'collection' => $collectionId,
                        'category' => $categoryId,
                        'primaryCollection' => $primaryCollection,
                        'price' => $price,
                        'tagPrice' => $tagPrice,
                        'quantityStock' => $quantityStock,
                        'quantityMemo' => $quantityMemo,
                        'description2' => $description2,
                        'mainStone' => $mainStone,
                        'showOnWeb' => $showOnWeb,
                        'showOnDibs' => $showOnDibs,
                        'showOnBluefly' => $showOnBluefly,
                        'showOnEtsy' => $showOnEtsy,
                        'showOnCustom1' => $showOnCustom1,
                        'showOnCustom2' => $showOnCustom2,
                        'showOnCustom3' => $showOnCustom3,
                        'showOnCustom4' => $showOnCustom4,
                        'showOnCustom5' => $showOnCustom5,
                        'donotList' => $donotList,
                        'ebay' => $ebay,
                        'amazon' => $amazon,
                        'artisan' => $artisan,
                        'socheec' => $socheec,
                        'image' => $otherImageUrl1,
                        'itemCategoryCode' => $itemCategoryCode,
                        'metalType' => $metalType,
                        'ugiTerm' => $ugiTerm,
                        'size' => $size,
                        'otherImageUrl1' => $otherImageUrl2,
                        'otherImageUrl2' => $otherImageUrl3,
                        'otherImageUrl3' => $otherImageUrl4,
                        'otherImageUrl4' => $otherImageUrl5,
                        'id' => $productId,
                        'image_type' => $image_type,
                        'status' => $status,
                        'active' => $active,
                    ]);

                    $results[] = ['sku' => $sku, 'status' => 'updated'];
                } else {
                    $insertQuery = "
                        INSERT INTO products (
                            sku, name, collection, category, primary_collection, price, tag_price,
                            quantity_stock, quantity_memo, long_description, long_description2,
                            long_description3, show_on_web, showondibs, showonbluefly, showonetsy,
                            showoncustom1, showoncustom2, showoncustom3, showoncustom4, showoncustom5,
                            donotlist, ebay, amazon, artisan, socheec, thumbnail_url, metal_type,
                            inventory, item_category_code, ugi_term, size, created_at, updated_at,image_type, status, active
                        ) VALUES (
                            :sku, :description, :collection, :category, :primaryCollection, :price, :tagPrice,
                            :quantityStock, :quantityMemo, :description, :description2, :mainStone, :showOnWeb,
                            :showOnDibs, :showOnBluefly, :showOnEtsy, :showOnCustom1, :showOnCustom2, :showOnCustom3,
                            :showOnCustom4, :showOnCustom5, :donotList, :ebay, :amazon, :artisan, :socheec,
                            :otherImageUrl1, :metalType, :inventory, :itemCategoryCode, :ugiTerm, :size, NOW(), NOW(), :image_type, :status, :active
                        )";
                    $insertStmt = $pdo->prepare($insertQuery);
                    $insertStmt->execute([
                        'sku' => $sku,
                        'description' => $description,
                        'collection' => $collectionId,
                        'category' => $categoryId,
                        'primaryCollection' => $primaryCollection,
                        'price' => $price,
                        'tagPrice' => $tagPrice,
                        'quantityStock' => $quantityStock,
                        'quantityMemo' => $quantityMemo,
                        'description2' => $description2,
                        'mainStone' => $mainStone,
                        'showOnWeb' => $showOnWeb,
                        'showOnDibs' => $showOnDibs,
                        'showOnBluefly' => $showOnBluefly,
                        'showOnEtsy' => $showOnEtsy,
                        'showOnCustom1' => $showOnCustom1,
                        'showOnCustom2' => $showOnCustom2,
                        'showOnCustom3' => $showOnCustom3,
                        'showOnCustom4' => $showOnCustom4,
                        'showOnCustom5' => $showOnCustom5,
                        'donotList' => $donotList,
                        'ebay' => $ebay,
                        'amazon' => $amazon,
                        'artisan' => $artisan,
                        'socheec' => $socheec,
                        'otherImageUrl1' => $otherImageUrl1,
                        'metalType' => $metalType,
                        'inventory' => $quantityStock, // assuming inventory = quantity_stock
                        'itemCategoryCode' => $itemCategoryCode,
                        'ugiTerm' => $ugiTerm,
                        'size' => $size
                        'image_type' => $image_type,
                        'status' => $status,
                        'active' => $active,
                    ]);

                    $results[] = ['sku' => $sku, 'status' => 'added'];
                }*/
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