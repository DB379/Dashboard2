// Function to open the modal and populate the form with user data
function openModal(userId) {
    var button = document.querySelector(`button[data-id='${userId}']`);
    var modal = document.getElementById("editUserModal");

    document.getElementById('editUserId').value = button.getAttribute('data-id');
    document.getElementById('editUsername').value = button.getAttribute('data-username');
    document.getElementById('editEmail').value = button.getAttribute('data-email');
    document.getElementById('editLevel').value = button.getAttribute('data-level');

    modal.style.display = "block";  // Ensure the modal is displayed
    modal.classList.add("active");
}

// Function to close the modal
function closeModal() {
    var modal = document.getElementById("editUserModal");
    modal.classList.remove("active");

    // Ensure modal becomes hidden after the transition
    setTimeout(function() {
        modal.style.display = "none";
    }, 400);
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
    var modal = document.getElementById("editUserModal");
    if (event.target === modal) {
        closeModal();
    }
}

// Function to handle form submission for updating user
function submitUpdate() {
    var form = document.getElementById('editUserForm');
    var actionInput = form.querySelector('input[name="action"]');
    actionInput.value = 'update'; // Set action to 'update'
    
    console.log('Form submission for update:', {
        userId: form.querySelector('input[name="id"]').value,
        action: actionInput.value
    });

    form.submit(); // Submit the form for update
}

// Function to handle form submission for deleting user
// Function to handle form submission for deleting user
function submitDelete(event) {
    event.preventDefault();

    var form = document.getElementById('editUserForm');
    var userId = form.querySelector('input[name="id"]').value;
    var username = form.querySelector('input[name="username"]').value;

    if (!userId) {
        alert('Error: No user ID found for deletion');
        return;
    }

    if (confirm('Are you sure you want to delete user "' + username + '"?')) {
        form.querySelector('input[name="action"]').value = 'delete';
        form.submit();
    }
}