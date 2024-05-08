</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('admin/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-mask/jquery-mask.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/sweet-alert/sweetalert2.all.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/select2/js/select2.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>assets/js/demo/datatables-demo.js"></script>
<script src="<?= base_url() ?>assets/js/demo/sweet-alert.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: "classic",
        });
        $('.uang').mask('000.000.000.000.000', {
            reverse: true
        });
    })
</script>
<script>
    $(document).ready(function() {
        var table = $('#table').DataTable({});

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const flashData = $('.flash-data').data('flashdata');
    // console.log(flashData);
    if (flashData) {
        Swal.fire({

            title: 'Berhasil !',
            text: '' + flashData,
            icon: 'success',
            showConfirmButton: false,
            timer: 3500
        });
    }
</script>
<script>
    const flashDataError = $('.flash-data-error').data('flashdata');
    // console.log(flashData);
    if (flashDataError) {
        Swal.fire({

            title: 'Gagal !',
            text: '' + flashDataError,
            icon: 'error',
            showConfirmButton: false,
            timer: 3500
        });
    }
</script>
<script>
    $('.bdel').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success m-1',
                cancelButton: 'btn btn-danger m-1'
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({

            title: 'Yakin data ini akan dihapus?',
            text: "Data tidak akan bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan',
                    '',
                    'error'
                )
            }
        });
    });
</script>
</body>

</html>