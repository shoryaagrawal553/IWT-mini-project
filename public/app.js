document.addEventListener('DOMContentLoaded', function() {
    // 1. Setup Dropdown Logic
    const dropdownContainer = document.getElementById('categoryDropdown');
    const trigger = dropdownContainer.querySelector('.custom-select-trigger');
    const selectedTextSpan = dropdownContainer.querySelector('.selected-text');
    const options = dropdownContainer.querySelectorAll('.custom-option');

    // Toggle dropdown open/close
    trigger.addEventListener('click', function(e) {
        dropdownContainer.classList.toggle('open');
        e.stopPropagation();
    });

    // Handle option selection
    options.forEach(option => {
        option.addEventListener('click', function() {
            options.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            
            const optionText = this.querySelector('span').textContent;
            selectedTextSpan.textContent = optionText;
            dropdownContainer.classList.remove('open');
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!dropdownContainer.contains(e.target)) {
            dropdownContainer.classList.remove('open');
        }
    });

    // 2. Setup Search Logic
    document.getElementById("findBtn").addEventListener("click", searchRecipes);
});

function searchRecipes() {
    const ingredient = document.getElementById("ingredients").value;
    
    // Get value from our custom dropdown
    const selectedOption = document.querySelector('.custom-option.selected');
    let category = selectedOption ? selectedOption.getAttribute('data-value') : 'all';

    // If "all" is selected, send empty string to API so it returns everything
    if (category === 'all') {
        category = '';
    }

    console.log(`Searching: Ingredient=${ingredient}, Category=${category}`);

    fetch("api.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `ingredient=${encodeURIComponent(ingredient)}&category=${encodeURIComponent(category)}`
    })
    .then(res => res.json())
    .then(data => {
        console.log("API response:", data); // DEBUG
        renderResults(Array.isArray(data) ? data : []);
    })

    .catch(err => console.error("Fetch error:", err));
}

function renderResults(recipes) {
    const container = document.getElementById("results");
    container.innerHTML = "";

    if (!recipes || recipes.length === 0) {
        container.innerHTML = "<p style='text-align:center; width:100%; color:#777;'>No recipes found matching your criteria.</p>";
        return;
    }

    recipes.forEach(recipe => {
        container.innerHTML += `
            <div class="recipe-card">
                <h3>${recipe.name}</h3>
                <div class="recipe-meta">
                    <strong>Category:</strong> ${recipe.category.toUpperCase()}
                </div>
                <p><strong>Ingredients:</strong> ${recipe.ingredients}</p>
                <br>
                <p>${recipe.instructions}</p>
            </div>
        `;
    });
}