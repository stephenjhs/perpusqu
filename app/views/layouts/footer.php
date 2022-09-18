<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p><?= date("Y") ?> &copy; <?= APP_NAME ?></p>
        </div>
        <div class="float-end">
            <p><?= first("informasi")->nama_perpustakaan ?></p>
        </div>
    </div>

    <div class="d-none" id="toggle-dark"></div>
</footer>
</div>
</div>
</div>
<script src="/mazer/js/app.js"></script>

<script>
    async function updateOnlineStatus() {
      const response = await fetch(`${window.location.origin}/api/online_status`, {
        method: 'POST',
      });
    }

    setInterval(() => {
        updateOnlineStatus()
    }, 60000)
</script>

</body>

</html>

<?php 
    unset($_SESSION["old"]);
    unset($_SESSION["validation"]);
?>