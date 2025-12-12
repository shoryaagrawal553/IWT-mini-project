<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

// Connect to SQLite database
try {
    $db = new PDO("sqlite:recipes.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// Read POST data
$ingredientInput = $_POST["ingredient"] ?? "";
$category        = $_POST["category"] ?? "";

// Base query
$query = "SELECT * FROM recipes WHERE 1=1";
$params = [];

/* ---------------------------------------
   MULTIPLE INGREDIENT SEARCH
   ---------------------------------------
   User enters: "egg, tomato, cheese"
   → Matches recipes containing ALL of them.
--------------------------------------- */
if (!empty($ingredientInput)) {
    $ingredients = array_filter(array_map('trim', explode(",", $ingredientInput)));

    foreach ($ingredients as $index => $ing) {
        $key = ":ing$index";
        $query .= " AND ingredients LIKE $key";
        $params[$key] = "%$ing%";
    }
}

// Category filter
if (!empty($category)) {
    $query .= " AND category = :cat";
    $params[':cat'] = $category;
}

// Prepare + execute
$stmt = $db->prepare($query);
$stmt->execute($params);

// Fetch all matching rows
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If nothing matched, return friendly message
if (!$recipes || count($recipes) === 0) {
    echo json_encode([
        "message" => "No recipes found matching your search.",
        "results" => []
    ]);
    exit;
}

// Success → return recipes
echo json_encode($recipes);
?>
