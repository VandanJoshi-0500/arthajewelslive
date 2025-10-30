<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=your_database;charset=utf8mb4';
$username = 'your_username';
$password = 'your_password';

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get raw POST data
$rawPostData = file_get_contents('php://input');

// Check if data is provided
if (empty($rawPostData)) {
    die("No data received.");
}

// Parse the XML
libxml_use_internal_errors(true); // Suppress XML errors
$xml = simplexml_load_string($rawPostData);
if ($xml === false) {
    die("Invalid XML data received.");
}

// Process the XML data
foreach ($xml->Inventory as $inventory) {
    $sku = (string) $inventory->No; // Using <No> as the unique identifier
    $name = (string) $inventory->Description;
    $mainstone = (string) $inventory->MainStone;
    $price = str_replace(',', '', (string) $inventory->Price); // Remove commas
    $tag_price = str_replace(',', '', (string) $inventory->TagPrice);
    $quantity_stock = (int) $inventory->InventoryOnHand;
    $quantity_memo = (int) $inventory->InventoryOnMemo;
    $collection = (string) $inventory->Collection;
    $item_category = (string) $inventory->ItemCategory;
    $metal_type = (string) $inventory->MetalType;
    $show_on_web = (string) $inventory->Showonweb;
    $other_image_url1 = (string) $inventory->OtherImageUrl1;
    $updated_at = (string) $inventory->Datemodified;

    // Check if product exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM products WHERE sku = :sku");
    $stmt->execute(['sku' => $sku]);
    $exists = $stmt->fetchColumn();

    if ($exists) {
        // Update product
        $updateStmt = $pdo->prepare("
            UPDATE products
            SET name = :name,
                mainstone = :mainstone,
                price = :price,
                tag_price = :tag_price,
                quantity_stock = :quantity_stock,
                quantity_memo = :quantity_memo,
                collection = :collection,
                category = :item_category,
                metal_type = :metal_type,
                show_on_web = :show_on_web,
                other_image_url1 = :other_image_url1,
                updated_at = :updated_at
            WHERE sku = :sku
        ");
        $updateStmt->execute([
            'name' => $name,
            'mainstone' => $mainstone,
            'price' => $price,
            'tag_price' => $tag_price,
            'quantity_stock' => $quantity_stock,
            'quantity_memo' => $quantity_memo,
            'collection' => $collection,
            'item_category' => $item_category,
            'metal_type' => $metal_type,
            'show_on_web' => $show_on_web,
            'other_image_url1' => $other_image_url1,
            'updated_at' => $updated_at,
            'sku' => $sku,
        ]);
        echo "Updated product SKU: $sku\n";
    } else {
        // Insert new product
        $insertStmt = $pdo->prepare("
            INSERT INTO products (sku, name, mainstone, price, tag_price, quantity_stock, quantity_memo, collection, category, metal_type, show_on_web, other_image_url1, updated_at)
            VALUES (:sku, :name, :mainstone, :price, :tag_price, :quantity_stock, :quantity_memo, :collection, :item_category, :metal_type, :show_on_web, :other_image_url1, :updated_at)
        ");
        $insertStmt->execute([
            'sku' => $sku,
            'name' => $name,
            'mainstone' => $mainstone,
            'price' => $price,
            'tag_price' => $tag_price,
            'quantity_stock' => $quantity_stock,
            'quantity_memo' => $quantity_memo,
            'collection' => $collection,
            'item_category' => $item_category,
            'metal_type' => $metal_type,
            'show_on_web' => $show_on_web,
            'other_image_url1' => $other_image_url1,
            'updated_at' => $updated_at,
        ]);
        echo "Inserted new product SKU: $sku\n";
    }
}
?>
