<?php
header("Content-Type: application/json");

$db = new PDO("sqlite:" . __DIR__ . "/recipes.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$ingredientInput = $_POST["ingredient"] ?? "";
$category        = $_POST["category"] ?? "";

$query = "SELECT * FROM recipes WHERE 1=1";
$params = [];

// OR-based ingredient search
if (!empty($ingredientInput)) {
    $ingredients = array_filter(array_map('trim', explode(",", $ingredientInput)));
    if ($ingredients) {
        $conditions = [];
        foreach ($ingredients as $i => $ing) {
            $key = ":ing$i";
            $conditions[] = "ingredients LIKE $key";
            $params[$key] = "%$ing%";
        }
        $query .= " AND (" . implode(" OR ", $conditions) . ")";
    }
}

// Category filter
if (!empty($category)) {
    $query .= " AND category = :cat";
    $params[":cat"] = $category;
}

$stmt = $db->prepare($query);
$stmt->execute($params);

// 🚨 IMPORTANT: return ARRAY ONLY
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
