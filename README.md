# 🍲 Recipe Recommender
  
A responsive web application that helps users discover recipes based on the ingredients they have at home and their dietary preferences.

## 📋 Project Overview

This project is a full-stack web application that allows users to input ingredients (e.g., "egg", "chicken") and select a category (e.g., Breakfast, Vegetarian) to get instant recipe suggestions. It features a modern, responsive user interface and uses a lightweight SQLite database for data storage.

## ✨ Features

* **Ingredient Search:** Find recipes containing specific ingredients using a flexible search.<br>
* **Category Filtering:** Filter results by Breakfast, Vegetarian, Non-Veg, or Quick Meals.<br>
* **Responsive Design:** Fully optimized for desktops, tablets, and mobile phones.<br>
* **Custom UI Components:** Includes a custom-styled dropdown menu and interactive hover effects.<br>
* **Instant Results:** Uses JavaScript Fetch API for asynchronous, page-refresh-free results.

## 🛠️ Tech Stack

  * **Frontend:** HTML5, CSS3 (Grid/Flexbox), JavaScript (Vanilla)
  * **Backend:** PHP
  * **Database:** SQLite

## 📂 File Structure

  * **index.html :** The main user interface containing the search form and results grid.<br>
  * **styles.css :** Contains all styling variables, responsive rules, and animations.<br>
  * **app.js :** Handles frontend logic, the custom dropdown, and communicates with the backend API.
  * **api.php :** The backend script that queries the database and returns JSON data.
  * **recipes.db :** The SQLite database file containing recipe data.
  * **schema.sql :** SQL script used to create the table and insert initial sample data.

## 🚀 How to Run

Since this project uses PHP and SQLite, you need a local server environment.

### Option 1: Using Built-in PHP Server (Quickest)

If you have PHP installed on your system:

1.  Open your terminal or command prompt.
2.  Navigate to the project folder containing these files.
3.  Run the following command:
    ```bash
    php -S localhost:8000
    ```
4.  Open your browser and visit: `http://localhost:8000`

### Option 2: Using XAMPP / WAMP / MAMP

1.  Copy the project folder into your server's root directory (e.g., `htdocs` in XAMPP).
2.  Start **Apache** from the control panel.
3.  Open your browser and visit: `http://localhost/your-folder-name`

## 🗄️ Database Setup

The project comes with a pre-filled `recipes.db` file. However, if you need to reset or modify the database:

1.  Ensure you have `sqlite3` installed.
2.  Run the following command in your terminal:
    ```bash
    sqlite3 recipes.db < schema.sql
    ```
3.  This will drop the existing table and re-insert the sample data defined in `schema.sql`.

## 📝 API Usage

The backend `api.php` accepts POST requests with the following parameters:

  * **Endpoint:** `api.php`
  * **Method:** `POST`
  * **Content-Type:** `application/x-www-form-urlencoded`
  * **Parameters:**
      * `ingredient` (string, optional): The ingredient to search for.
      * `category` (string, optional): The category filter (e.g., `breakfast`, `veg`, `non-veg`, `quick`).

**Example Response:**

```json
[
    {
        "id": 1,
        "name": "Scrambled Eggs",
        "ingredients": "egg, salt, butter",
        "category": "breakfast",
        "instructions": "Beat eggs, cook in butter, season to taste."
    }
]
```
