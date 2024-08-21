// Function to clear a session message after 3 seconds
function clearSessionMessage(elementId) {
    setTimeout(function() {
        var messageElement = document.getElementById(elementId);
        if (messageElement) {
            messageElement.style.transition = "opacity 0.5s ease";
            messageElement.style.opacity = 0; // Fade out the message

            // Remove the message element after the fade-out transition
            setTimeout(function() {
                messageElement.remove();
            }, 500);
        }
    }, 3000); // 3 seconds delay
}

// Call the function for each session message
window.onload = function() {
    clearSessionMessage('deleteMessage');
    clearSessionMessage('updateMessage');
};
