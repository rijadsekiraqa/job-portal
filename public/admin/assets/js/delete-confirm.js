$(document).ready(function () {
    $(".confirm-text").on("click", function (e) {
        e.preventDefault(); 
        var url = $(this).attr('href'); 
        var title = $(this).data('title') || "Are you sure?"; 
        var text = $(this).data('text') || "You won't be able to revert this!"; 
        var confirmButtonText = $(this).data('confirm') || "Yes, delete it!";
        var cancelButtonText = $(this).data('cancel') || "Cancel";

        Swal.fire({
            title: title,
            text: text,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: confirmButtonText,
            cancelButtonText: cancelButtonText,
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: false
        }).then(function (result) {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});
