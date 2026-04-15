DROP TABLE IF EXISTS recipes;

CREATE TABLE recipes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    ingredients TEXT NOT NULL,
    category TEXT NOT NULL,
    instructions TEXT NOT NULL
);

INSERT INTO recipes (name, ingredients, category, instructions) VALUES
('Scrambled Eggs', 'egg, salt, butter', 'breakfast', 'Beat eggs, cook in butter, season to taste.'),
('Veg Sandwich', 'bread, tomato, cucumber, butter', 'veg', 'Layer sliced veggies between buttered bread.'),
('Chicken Curry', 'chicken, onion, garlic, spices', 'non-veg', 'Sauté onion/garlic, add spices and chicken, simmer until cooked.'),
('Pasta with Tomato Sauce', 'pasta, tomato, garlic, cheese', 'quick', 'Boil pasta, cook tomato-garlic sauce, toss with pasta and cheese.'),
('Omelette', 'egg, onion, chili, salt', 'breakfast', 'Whisk eggs, add chopped veggies, cook until set.'),
('Paneer Bhurji', 'paneer, onion, tomato, spices', 'veg', 'Crumble paneer and cook with sautéed onion, tomato and spices.'),
('Grilled Cheese', 'bread, cheese, butter', 'quick', 'Butter bread, place cheese between slices and grill until golden.'),
('Masala Dosa', 'rice, urad dal, potato, spices', 'veg', 'Prepare batter, ferment, spread on pan, fill with spiced potato.'),
('Fried Rice', 'rice, egg, mixed vegetables, soy sauce', 'quick', 'Stir-fry veggies, add rice and soy sauce; scramble egg in pan.'),
('Fish Fry', 'fish, salt, chili powder, oil', 'non-veg', 'Marinate fish, shallow fry until crispy.');