$(document).ready(function () {
    $(".confirm-text").on("click", function (e) {
        e.preventDefault(); // Prevent the default link behavior

        var url = $(this).attr('href'); // Get the URL from the href attribute
        console.log("URL to delete: ", url); 

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: false
        }).then(function (result) {
            if (result.isConfirmed) {
                window.location.href = url; // If confirmed, proceed with deletion
            }
        });
    });
});
