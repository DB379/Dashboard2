// Function to show a specific tab
function showTab(tabName) {
    // Get all elements with class="tab-content" and hide them
    var tabs = document.getElementsByClassName('tab-content');
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].style.display = "none";
    }

    // Get all elements with class="tab-button" and remove the "active" class
    var tabButtons = document.getElementsByClassName('tab-button');
    for (var i = 0; i < tabButtons.length; i++) {
        tabButtons[i].classList.remove('active');
    }

    // Show the current tab
    document.getElementById(tabName).style.display = "block";

    // Set the active class on the corresponding tab button
    for (var i = 0; i < tabButtons.length; i++) {
        if (tabButtons[i].getAttribute('href').includes(tabName)) {
            tabButtons[i].classList.add('active');
        }
    }
}

// Initial setup to show the correct tab when the page loads
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page') || 'settings/profile';
    const tab = page.split('/')[1] || 'profile'; // Get the subpage part
    showTab(tab);
}

