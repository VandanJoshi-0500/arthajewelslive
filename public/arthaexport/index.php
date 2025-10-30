<?php
// Database connection (update with your credentials)
$host = 'localhost';
$db   = 'arthajewelsnewwp';
$user = 'arthajewelsnewwp';
$pass = 'G3uiFLp7dFoHzAz7DE77';
$charset = 'utf8mb4';

// Set up DSN and PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Export function
function exportProductsToCsv($pdo) {
    // Define file name (downloaded in browser)
    $filename = "products_export_" . date('Ymd_His') . ".csv";

    // Set headers to force download
    header('Content-Type: text/csv');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    $fp = fopen('php://output', 'w');

    // Define CSV headers
    $headers = [
        'No', 'Description', 'Description2', 'MainStone', 'Collection', 'ItemCategory', 'Primarycollection',
        'Price', 'InventoryOnHand', 'InventoryOnMemo', 'Showonweb', 'ShowonDibs', 'ShowonBluefly', 'ShowonEtsy',
        'ShowonCustom1', 'ShowonCustom2', 'ShowonCustom3', 'ShowonCustom4', 'ShowonCustom5', 'DoNotList', 'eBay',
        'Amazon', 'Artisan', 'Socheec', 'OtherImageUrl1', 'ItemCategoryCode', 'MetalType', 'TagPrice', 'UGITerm',
        'Size', 'OtherImageUrl2', 'OtherImageUrl3', 'OtherImageUrl4', 'OtherImageUrl5', 'DateCreated', 'Datemodified'
    ];

    // Output the header row
    fputcsv($fp, $headers);

    // Query the products
    $sql = "
        SELECT 
            p.sku AS `No`,
            p.long_description AS `Description`,
            p.long_description2 AS `Description2`,
            p.long_description3 AS `MainStone`,
            (SELECT name FROM collections WHERE id = p.collection) AS `Collection`,
            (SELECT name FROM categories WHERE id = p.category) AS `ItemCategory`,
            p.primary_collection AS `Primarycollection`,
            p.price AS `Price`,
            p.quantity_stock AS `InventoryOnHand`,
            p.quantity_memo AS `InventoryOnMemo`,
            p.show_on_web AS `Showonweb`,
            p.showondibs AS `ShowonDibs`,
            p.showonbluefly AS `ShowonBluefly`,
            p.showonetsy AS `ShowonEtsy`,
            p.showoncustom1 AS `ShowonCustom1`,
            p.showoncustom2 AS `ShowonCustom2`,
            p.showoncustom3 AS `ShowonCustom3`,
            p.showoncustom4 AS `ShowonCustom4`,
            p.showoncustom5 AS `ShowonCustom5`,
            p.donotlist AS `DoNotList`,
            p.ebay AS `eBay`,
            p.amazon AS `Amazon`,
            p.artisan AS `Artisan`,
            p.socheec AS `Socheec`,
            p.thumbnail_url AS `OtherImageUrl1`,
            p.item_category_code AS `ItemCategoryCode`,
            p.metal_type AS `MetalType`,
            p.tag_price AS `TagPrice`,
            p.ugi_term AS `UGITerm`,
            p.size AS `Size`,
            '' AS `OtherImageUrl2`,
            '' AS `OtherImageUrl3`,
            '' AS `OtherImageUrl4`,
            '' AS `OtherImageUrl5`,
            p.created_at AS `DateCreated`,
            p.updated_at AS `Datemodified`
        FROM products p
        WHERE p.status = 1 AND p.active = 1
    ";

    $stmt = $pdo->query($sql);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($fp, $row);
    }

    fclose($fp);
    exit;
}

// Call the export function
exportProductsToCsv($pdo);
