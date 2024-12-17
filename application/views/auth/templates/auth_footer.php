</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('') ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('') ?>dist/js/adminlte.min.js"></script>
<script>
    // Fungsi untuk otomatis menghilangkan pesan flash setelah beberapa detik
    setTimeout(function() {
        // Menyeleksi elemen flash message dan menghilangkannya dengan efek fade out
        var flashMessage = document.getElementById("flash-message");
        if (flashMessage) {
            flashMessage.style.transition = "opacity 0.5s ease";
            flashMessage.style.opacity = "0";
            setTimeout(function() {
                flashMessage.remove();
            }, 500); // Waktu yang sama dengan durasi efek fade out
        }
    }, 2500);
</script>
</body>

</html>