<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Optional: for testing

// Connect to SQLite database
try {
    $db = new PDO("sqlite:recipes.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// Read POST data
$ingredient = $_POST["ingredient"] ?? "";
$category   = $_POST["category"] ?? "";

// Base query
$query = "SELECT * FROM recipes WHERE 1=1";
$params = [];

// If ingredient entered → search with LIKE
if (!empty($ingredient)) {
    $query .= " AND ingredients LIKE :ing";
    $params[':ing'] = "%" . $ingredient . "%";
}

// If a category is selected (and not empty) → match exact
if (!empty($category)) {
    $query .= " AND category = :cat";
    $params[':cat'] = $category;
}

// Prepare + execute
$stmt = $db->prepare($query);
$stmt->execute($params);

// Fetch all matching rows
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return JSON
echo json_encode($recipes);
?>