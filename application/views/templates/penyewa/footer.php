<footer>
    <div class="container mt-5 text-bg-dark">
        <div class="container text-center">

        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- JavaScript Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> -->
<script src="<?= base_url('') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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