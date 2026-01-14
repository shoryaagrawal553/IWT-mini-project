document.addEventListener("DOMContentLoaded", () => {

    const dropdown = document.getElementById("categoryDropdown");
    const trigger = dropdown.querySelector(".custom-select-trigger"); 
    const options = dropdown.querySelectorAll(".custom-option");
    const selectedText = dropdown.querySelector(".selected-text");
 
    trigger.addEventListener("click", () => {
        dropdown.classList.toggle("open");
    });

    options.forEach(option => {
        option.addEventListener("click", () => {
            options.forEach(o => o.classList.remove("selected"));
            option.classList.add("selected");
            selectedText.textContent = option.textContent;
            dropdown.classList.remove("open");
        });
    });

    document.getElementById("findBtn").addEventListener("click", searchRecipes);
});

function searchRecipes() {
    const ingredient = document.getElementById("ingredients").value;
    const selected = document.querySelector(".custom-option.selected");
    let category = selected ? selected.getAttribute("data-value") : "";

    if (category === "all") category = "";

    fetch("api.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `ingredient=${encodeURIComponent(ingredient)}&category=${encodeURIComponent(category)}`
    })
    .then(res => res.json())
    .then(data => renderResults(data))
    .catch(() => renderResults([]));
}

function renderResults(recipes) {
    const container = document.getElementById("results");
    container.innerHTML = "";

    if (!recipes || recipes.length === 0) {
        container.innerHTML = "<p>No recipes found matching your criteria.</p>";
        return;
    }

    recipes.forEach(r => {
        container.innerHTML += `
            <div class="recipe-card">
                <h3>${r.name}</h3>
                <p><strong>Ingredients:</strong> ${r.ingredients}</p>
                <p><strong>Category:</strong> ${r.category}</p>
                <p>${r.instructions}</p>
            </div>
        `;
    });
}
