$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // GLOBAL VARIABLES
     var modalInputOptions = {
        backdrop: "static",
        keyboard: false,
    };

    var modalInput = new bootstrap.Modal(
        document.getElementById("modal-input"),
        modalInputOptions
    );

    var modalEditOptions = {
        backdrop: "static",
        keyboard: false,
    };

    var modalEdit = new bootstrap.Modal(
        document.getElementById("modal-edit"),
        modalEditOptions
    );

    var columnsTable = [
        { data: "username" },
        { data: "email" },
        { data: "name" },
        { data: "department" },
        { data: "created_at" },
        { data: "action" },
    ];

    var datatable = $("#datatable").DataTable({
        search: {
            return: true,
        },
        order: [[0, "DESC"]],
        processing: true,
        serverSide: true,
        stateSave: !0,
        ajax: {
            url: base_url + "/users/datatable",
            dataType: "json",
            type: "POST",
            data: function (dataFilter) {
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.responseJSON.data) {
                    var error = jqXHR.responseJSON.data.error;
                    Swal.fire({
                        icon: "error",
                        title: " <br>Application error!",
                        html:
                            '<div class="alert alert-danger text-left" role="alert">' +
                            "<p>Error Message: <strong>" +
                            error +
                            "</strong></p>" +
                            "</div>",
                        allowOutsideClick: false,
                        showConfirmButton: true,
                    });
                } else {
                    var message = jqXHR.responseJSON.message;
                    var errorLine = jqXHR.responseJSON.line;
                    var file = jqXHR.responseJSON.file;
                    Swal.fire({
                        icon: "error",
                        title: " <br>Application error!",
                        html:
                            '<div class="alert alert-danger text-left" role="alert">' +
                            "<p>Error Message: <strong>" +
                            message +
                            "</strong></p>"+
                            "</div>",
                        allowOutsideClick: false,
                        showConfirmButton: true,
                    });
                }
            },
        },
        responsive: true,
        columns: columnsTable,
        scrollX: true,
        columnDefs: [
            {
                orderable: false,
                targets: [-1],
            },
        ],
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        },
    });

    // FUNCTION
    function refreshTable() {
        var currentPage = datatable.page();
        datatable.search('').draw(false);
        datatable.page(currentPage).draw(false);
    }

    function openInput() {
        modalInput.show();
    }

    function closeInput() {
        modalInput.hide();
    }

    function resetInput() {
        $('#username').val('');
        $('#email').val('');
        $('#name').val('');
        $('#department').val('').trigger('change');
        $('#password').val('');
        $('#password_confirmation').val('');
    }

    function openEdit() {
        modalEdit.show();
    }

    function closeEdit() {
        modalEdit.hide();
    }

    function resetEdit() {
        $('#edit_username').val('');
        $('#edit_email').val('');
        $('#edit_name').val('');
        $('#edit_department').val('').trigger('change');
        $('#edit_password').val('');
        $('#edit_password_confirmation').val('');
    }

    // EVENT HANDLER
    $('.btnReload').on('click', function () {
        refreshTable();
    });

    $('.btnInput').on('click', function () {
        resetInput();
        openInput();
    });

    $('.btnCloseInput').on('click', function () {
        closeInput();
    });

    $('#department_id').select2({
        dropdownParent: $('#modal-input'),
        placeholder: "All Departments",
        allowClear: true,
        ajax: {
            url: base_url + "/users/ajax/get-select-departments",
            type: "POST",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term || "",
                    page: params.page || 1,
                };
            },
            cache: true,
        },
    });

    $('#department_idEdit').select2({
        dropdownParent: $('#modal-edit'),
        placeholder: "All Departments",
        allowClear: true,
        ajax: {
            url: base_url + "/users/ajax/get-select-departments",
            type: "POST",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term || "",
                    page: params.page || 1,
                };
            },
            cache: true,
        },
    });

    $('#form-input').on('submit', function (e) {
        e.preventDefault();
        let buttonElement = $(this).find("button[type='submit']");
        loadingButtonShow(buttonElement);
        let url = $(this).attr('action');
        var formData = new FormData(this);

        $.ajax({
            url: url,
            data: formData,
            method:"POST",
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                showToast(data.message, 'success');
                closeInput();
                refreshTable();
                loadingButtonClose(buttonElement);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                loadingButtonClose(buttonElement);
                showToast(jqXHR.responseJSON.message, 'error');
            }
        });
    });

     $('#form-edit').on('submit', function (e) {
        e.preventDefault();
        let buttonElement = $(this).find("button[type='submit']");
        loadingButtonShow(buttonElement);
        let url = $(this).attr('action');
        var formData = new FormData(this);

        $.ajax({
            url: url,
            data: formData,
            method:"POST",
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                showToast(data.message, 'success');
                closeEdit();
                refreshTable();
                loadingButtonClose(buttonElement);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                loadingButtonClose(buttonElement);
                showToast(jqXHR.responseJSON.message, 'error');
            }
        });
    });


    $('#datatable').on('click', '.btnDelete', function(){
        let idUser = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You will delete this data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                let url = base_url + "/users/delete/" + idUser;
                $.ajax({
                    url: url,
                    type: "DELETE",
                    dataType: "JSON",
                    success: function (data) {
                        refreshTable();
                        showToast(data.message, 'success');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        showToast(jqXHR.responseJSON.message, 'error');
                    },
                });
            }
        });
    })

    $('#datatable').on('click', '.btnEdit', function(){
        let idUser = $(this).data('id');
        let url = base_url + "/users/ajax/get-user-by-id/" + idUser;
        let formUrl = base_url + "/users/update/" + idUser;
        $('#form-edit').attr('action', formUrl);

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function (response) {
                let data = response.data;
                $('#usernameEdit').val(data.username);
                $('#emailEdit').val(data.email);
                $('#nameEdit').val(data.name);
                
                let option = new Option(data.department_name, data.department_id, true, true);
                $('#department_idEdit').append(option).trigger('change');
                resetEdit();
                openEdit();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showToast(jqXHR.responseJSON.message, 'error');
            },
        });
    });
});