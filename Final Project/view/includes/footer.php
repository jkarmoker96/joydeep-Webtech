
</body>
<footer class="border-top footer text-muted">
    <div class="container">
        &copy; 2021 - <?php echo $APP_NAME ?> - <a href="#">Privacy</a>
    </div>
</footer>

<?php
foreach ($JS_FRAMEWORKS as $JS) {
    echo "<script src='" . $JS["url"] . "' integrity='" . $JS["integrity"] . "' crossorigin='" . $JS["crossorigin"] . "'></script>";
}
foreach ($WWWROOT_JS as $JS) {
    echo "<script src='$JS'></script>";
}
?>
</main>

</html>