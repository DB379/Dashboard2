function selectAvatar(avatar) {
    const avatars = document.querySelectorAll('.avatar');
    avatars.forEach(function(avatarElement) {
        avatarElement.classList.remove('selected');
    });
    const selectedAvatar = document.querySelector(`img[src='../assets/img/users/${avatar}']`);
    if (selectedAvatar) {
        selectedAvatar.classList.add('selected');
        document.getElementById('selected-avatar').value = avatar;
    }
}

window.addEventListener('load', function() {
    const message = document.getElementById('message');
    if (message) {
        setTimeout(function() {
            message.style.display = 'none';
        }, 3000); // 3000 milliseconds = 3 seconds
    }
});