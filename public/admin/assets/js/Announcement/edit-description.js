
    $(document).ready(function() {
    $('#editdescription').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var announcementId = button.data('announcement-id'); // Get the announcement ID
        var jobDescription = button.data('announcement-description'); // Get the job description

        var modal = $(this);
        modal.find('textarea[name="description"]').val(jobDescription); // Set job description in the textarea

        // Update form action with the specific announcement ID
        var formAction = '/admin-dashboard/announcements/' + announcementId + '/update-description'; // Updated URL
        modal.find('#update-job-description-form').attr('action', formAction);
    });
});

