<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>">
    <title><?= $this->renderSection('title') ?></title>
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <link href="<?= base_url('assets/libs/jquery-toast-plugin/jquery.toast.min.css') ?>" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/config/creative/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="<?= base_url('assets/css/config/creative/app.min.css') ?>" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />
    <link href="<?= base_url('assets/css/config/creative/bootstrap-dark.min.css') ?>" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" />
    <link href="<?= base_url('assets/css/config/creative/app-dark.min.css') ?>" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" />
    <link href="<?= base_url('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') ?>"
        rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
</head>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition":
    "fixed", "sidebar": {"color": "light"}, "showRightSidebarOnPageLoad": false}'>
    <div id="wrapper">
            <div class="content p-5">
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
    </div>
    <script src="<?= base_url('assets/js/vendor.min.js') ?>"></script>

    <script src="<?= base_url('assets/libs/jquery-sparkline/jquery.sparkline.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') ?>">
    </script>
    <script src="<?= base_url('assets/libs/jquery-mask-plugin/jquery.mask.min.js') ?>"></script>

    <script src="<?= base_url('assets/libs/jquery-toast-plugin/jquery.toast.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/sweetalert2/sweetalert2.all.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/app.min.js') ?>"></script>

    <script src="<?= base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/select2/js/select2.min.js') ?>"></script>

    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let loadingSwal;
        let base_url = window.location.origin;

        function loadingSwalShow() {
            loadingSwal = Swal.fire({
                imageHeight: 300,
                showConfirmButton: false,
                title: '<i class="fas fa-sync-alt fa-spin fs-80"></i>',
                allowOutsideClick: false,
                background: 'rgba(0, 0, 0, 0)'
            });
        }

        function loadingSwalClose() {
            loadingSwal.close();
        }

        function loadingButtonShow(button, text = 'Loading...') {
            button.prop('disabled', true);
            button.html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            ${text}
            `);
        }

        function loadingButtonClose(button, originalText = 'Save Changes') {
            button.prop('disabled', false);
            button.html(originalText);
        }

        function showToast(message, type = 'info', position = 'top-right', hideAfter = 5000, showHideTransition = 'fade') {
            let colors = {
                info: '#1ea69a',
                success: '#5ba035',
                warning: '#da8609',
                danger: '#bf441d'
            };

            let color = colors[type] || colors.info;

            $.toast().reset("all");
            $.toast({
                heading: type.charAt(0).toUpperCase() + type.slice(1),
                text: message,
                position: position,
                loaderBg: color,
                icon: type,
                hideAfter: hideAfter,
                stack: 1,
                showHideTransition: showHideTransition
            });
        }
    </script>

    <?php if ($page == 'user-index'): ?>
        <script src="<?= base_url('assets/js/user/index.js') ?>"></script>
    <?php endif; ?>
</body>
</html>
