<?php
header("Content-Type: application/json");

// Connect to SQLite database
$db = new PDO("sqlite:recipes.db");

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

// If a category is selected → match exact
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
