<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" auto role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <strong class="me-auto"><?= $_SESSION["notif"]["judul"] ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?= $_SESSION["notif"]["pesan"] ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    const toastEl = document.getElementById('liveToast');
    const toast = new bootstrap.Toast(toastEl, {
        autohide: false
    });
    toast.show(); 
    });
</script>