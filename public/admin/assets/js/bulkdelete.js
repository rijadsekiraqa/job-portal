$(document).ready(function () {
    var bulkDeleteUrl = $('meta[name="bulkDeleteUrl"]').attr('content');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // City bulk delete
    $('.city-checkbox').on('change', function () { 
        if ($('.city-checkbox:checked').length > 0) {
            $('#delete-selected-cities').css('display', 'flex').addClass('d-flex align-items-center');
        } else {
            $('#delete-selected-cities').css('display', 'none').removeClass('d-flex align-items-center');
        }
    });

    $('#delete-selected-cities').on('click', function () {
        var selectedIds = [];
        $('.city-checkbox:checked').each(function () {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            return;
        }

        Swal.fire({
            title: "A jeni i sigurt qe deshironi te fshini?",
            text: "Ju nuk keni mundesi ta ktheni kete perseri!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete them!",
            cancelButtonText: "Cancel",
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin-dashboard/cities/bulk-delete',
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        ids: selectedIds,
                        type: 'city'  // Specify the type as 'city'
                    },
                    success: function (response) {
                        Swal.fire("Deleted!", response.message, "success").then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire("Error!", "An error occurred while deleting. Please try again.", "error");
                    }
                });
            }
        });
    });

    $('#select-all-city').on('change', function () {
        $('.city-checkbox').prop('checked', this.checked).trigger('change');
    });

    // Category bulk delete
    $('.category-checkbox').on('change', function () {
        if ($('.category-checkbox:checked').length > 0) {
            $('#delete-selected-categories').css('display', 'flex').addClass('d-flex align-items-center');
        } else {
            $('#delete-selected-categories').css('display', 'none').removeClass('d-flex align-items-center');
        }
    });

    $('#delete-selected-categories').on('click', function () {
        var selectedIds = [];
        $('.category-checkbox:checked').each(function () {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            return;
        }

        Swal.fire({
            title: "A jeni i sigurt qe deshironi te fshini?",
            text: "Ju nuk keni mundesi ta ktheni kete perseri!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete them!",
            cancelButtonText: "Cancel",
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin-dashboard/categories/bulk-delete',
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        ids: selectedIds,
                        type: 'category'  // Specify the type as 'category'
                    },
                    success: function (response) {
                        Swal.fire("Deleted!", response.message, "success").then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire("Error!", "An error occurred while deleting. Please try again.", "error");
                    }
                });
            }
        });
    });

    $('#select-all-category').on('change', function () {
        $('.category-checkbox').prop('checked', this.checked).trigger('change');
    });

    // Company bulk delete
    $('.company-checkbox').on('change', function () {
        if ($('.company-checkbox:checked').length > 0) {
            $('#delete-selected-companies').css('display', 'flex').addClass('d-flex align-items-center');
        } else {
            $('#delete-selected-companies').css('display', 'none').removeClass('d-flex align-items-center');
        }
    });

    $('#delete-selected-companies').on('click', function () {
        var selectedIds = [];
        $('.company-checkbox:checked').each(function () {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            return;
        }

        Swal.fire({
            title: "A jeni i sigurt qe deshironi te fshini?",
            text: "Ju nuk keni mundesi ta ktheni kete perseri!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete them!",
            cancelButtonText: "Cancel",
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin-dashboard/companies/bulk-delete',
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        ids: selectedIds,
                        type: 'company'  // Specify the type as 'company'
                    },
                    success: function (response) {
                        Swal.fire("Deleted!", response.message, "success").then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire("Error!", "An error occurred while deleting. Please try again.", "error");
                    }
                });
            }
        });
    });

    $('#select-all-company').on('change', function () {
        $('.company-checkbox').prop('checked', this.checked).trigger('change');
    });

    

    $('.announcement-checkbox').on('change', function () {
        if ($('.announcement-checkbox:checked').length > 0) {
            $('#delete-selected-announcements').css('display', 'flex').addClass('d-flex align-items-center');
        } else {
            $('#delete-selected-announcements').css('display', 'none').removeClass('d-flex align-items-center');
        }
    });

    $('#delete-selected-announcements').on('click', function () {
        var selectedIds = [];
        $('.announcement-checkbox:checked').each(function () {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            return;
        }

        Swal.fire({
            title: "A jeni i sigurt qe deshironi te fshini kete shpallje?",
            text: "Ju nuk keni mundesi ta ktheni kete perseri!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete them!",
            cancelButtonText: "Cancel",
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin-dashboard/announcements/bulk-delete',
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        ids: selectedIds,
                        type: 'announcement'  // Specify the type as 'company'
                    },
                    success: function (response) {
                        Swal.fire("Deleted!", response.message, "success").then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire("Error!", "An error occurred while deleting. Please try again.", "error");
                    }
                });
            }
        });
    });

    $('#select-all-announcement').on('change', function () {
        $('.announcement-checkbox').prop('checked', this.checked).trigger('change');
    });


    $('.user-checkbox').on('change', function () {
        if ($('.user-checkbox:checked').length > 0) {
            $('#delete-selected-users').css('display', 'flex').addClass('d-flex align-items-center');
        } else {
            $('#delete-selected-users').css('display', 'none').removeClass('d-flex align-items-center');
        }
    });

    $('#delete-selected-users').on('click', function () {
        var selectedIds = [];
        $('.user-checkbox:checked').each(function () {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            return;
        }

        Swal.fire({
            title: "A jeni i sigurt qe deshironi te fshini kete shpallje?",
            text: "Ju nuk keni mundesi ta ktheni kete perseri!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete them!",
            cancelButtonText: "Cancel",
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin-dashboard/users/bulk-delete',
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        ids: selectedIds,
                        type: 'user' 
                    },
                    success: function (response) {
                        Swal.fire("Deleted!", response.message, "success").then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire("Error!", "An error occurred while deleting. Please try again.", "error");
                    }
                });
            }
        });
    });

    $('#select-all-user').on('change', function () {
        $('.user-checkbox').prop('checked', this.checked).trigger('change');
    });
    
    
});
