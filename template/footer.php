</div>
<!-- /.content-wrapper -->



<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark"></aside>



<!-- Main Footer -->
<footer class="main-footer">

    <strong>
        Copyright &copy; 2026
        <span class="text-info">Kelompok 6</span>
    </strong>

    All rights reserved.

    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
    </div>

</footer>



</div>
<!-- ./wrapper -->



<!-- Bootstrap -->
<script src="<?= $main_url ?>asset/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE -->
<script src="<?= $main_url ?>asset/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>

<!-- DataTables -->
<script src="<?= $main_url ?>asset/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?= $main_url ?>asset/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= $main_url ?>asset/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script src="<?= $main_url ?>asset/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="<?= $main_url ?>asset/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>



<script>

$(document).ready(function () {

    // =========================
    // DATATABLE
    // =========================
    if ($('#tblData').length) {

        $('#tblData').DataTable();

    }



    // =========================
    // DARK MODE
    // =========================
    let tema = sessionStorage.getItem('tema');

    if (tema) {

        $('body').addClass(tema);
        $('#cekDark').prop('checked', true);

    }

    $('#cekDark').click(function () {

        if ($(this).is(':checked')) {

            $('body').addClass('dark-mode');

            sessionStorage.setItem(
                'tema',
                'dark-mode'
            );

        } else {

            $('body').removeClass('dark-mode');

            sessionStorage.removeItem('tema');

        }

    });

});



// =========================
// TOGGLE SIDEBAR
// =========================
function toggleSidebar() {

    document.body.classList.toggle(
        'paksa-sidebar-tutup'
    );

}



// =========================
// TOGGLE MENU MASTER
// =========================
function toggleMasterMenu() {

    let menu = document.getElementById(
        'masterMenu'
    );

    if (menu.style.display === "block") {

        menu.style.display = "none";

    } else {

        menu.style.display = "block";

    }

}

</script>

<script>
function toggleMasterMenu() {
    const menu = document.getElementById("masterMenu");

    if (!menu) return;

    if (menu.style.display === "none" || menu.style.display === "") {
        menu.style.display = "block";
    } else {
        menu.style.display = "none";
    }
}
</script>

</body>
</html>