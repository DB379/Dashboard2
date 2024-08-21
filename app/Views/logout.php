<?php
// Automatically POST to the real logout route
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logging Out...</title>
</head>
<body>
    <form id="logoutForm" action="/logout" method="POST" style="display:none;">
    </form>
    <script>
        // Automatically submit the form when the page loads
        document.getElementById('logoutForm').submit();
    </script>
    <p>Logging you out...</p>
</body>
</html>
