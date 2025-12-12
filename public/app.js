function searchRecipes() {
    const ingredient = document.getElementById("ingredientInput").value;
    const category = document.getElementById("categorySelect").value;

    fetch("api.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `ingredient=${encodeURIComponent(ingredient)}&category=${encodeURIComponent(category)}`
    })
    .then(res => res.json())
    .then(data => renderResults(data))
    .catch(err => console.error("Fetch error:", err));
}

function renderResults(recipes) {
    const container = document.getElementById("results");
    container.innerHTML = "";

    if (recipes.length === 0) {
        container.innerHTML = "<p>No recipes found.</p>";
        return;
    }

    recipes.forEach(recipe => {
        container.innerHTML += `
            <div class="recipe-card">
                <h3>${recipe.name}</h3>
                <p><strong>Ingredients:</strong> ${recipe.ingredients}</p>
                <p><strong>Category:</strong> ${recipe.category}</p>
                <p>${recipe.instructions}</p>
            </div>
        `;
    });
}
