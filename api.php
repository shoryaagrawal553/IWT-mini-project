<?php
header("Content-Type: application/json");

$db = new PDO("sqlite:" . __DIR__ . "/recipes.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$ingredient = $_POST["ingredient"] ?? "";
$category   = $_POST["category"] ?? "";

$query = "SELECT * FROM recipes WHERE 1=1";
$params = [];

// OR-based ingredient matching
if (!empty($ingredient)) {
    $items = array_filter(array_map("trim", explode(",", $ingredient)));
    if ($items) {
        $conditions = [];
        foreach ($items as $i => $item) {
            $key = ":ing$i";
            $conditions[] = "ingredients LIKE $key";
            $params[$key] = "%$item%";
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

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));