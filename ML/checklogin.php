<?php
session_start();

if (!isset($_SESSION['access_token']) || empty($_SESSION['access_token'])) { ?>
    <script>
        window.location.href = "index.php";
    </script>
    <?php } else {
    if (isset($_SESSION['expires_in']) && ($_SESSION['expires_in']  < time())) { ?>
        <script>
            window.location.href = "index.php";
        </script>
<?php }
}
