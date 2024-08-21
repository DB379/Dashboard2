function toggleTheme(theme) {
    // Set the theme value in the hidden input field
    document.getElementById('theme-input').value = theme;
    // Submit the form to update the theme
    document.getElementById('theme-form').submit();
}

document.addEventListener("DOMContentLoaded", function() {
    const themeToggle = document.getElementById("theme-toggle");
    const themeInput = document.getElementById("theme-input");

    // Load the current theme from local storage or set the default theme
    const currentTheme = localStorage.getItem("theme") || "light";
    applyTheme(currentTheme);

    // Set the checkbox state based on the current theme
    themeToggle.checked = currentTheme === "dark";

    themeToggle.addEventListener("change", function() {
        const selectedTheme = themeToggle.checked ? "dark" : "light";
        applyTheme(selectedTheme);
    });

    function applyTheme(theme) {
        document.body.setAttribute("data-theme", theme);
        themeInput.value = theme;
        localStorage.setItem("theme", theme); // Store the selected theme
    }
});