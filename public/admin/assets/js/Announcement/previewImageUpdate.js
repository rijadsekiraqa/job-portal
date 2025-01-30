$(document).ready(function() {
    // Function to update the image preview based on the selected company
    function updateImagePreview() {
        const selectedOption = $('#company_select').find('option:selected');
        const imageSrc = selectedOption.attr('data-image') || '';

        if (imageSrc) {
            $('#uploaded_image').attr('src', imageSrc);
            $('.productviews').show();
            $('.productviews').closest('li').show(); // Ensure the parent <li> is also shown

        } else {
            $('.productviews').hide();
            $('.productviews').closest('li').hide(); // Hide the parent <li> if no image
            $('#uploaded_image').attr('src', ''); // Clear image src
        }
    }

    // Check initial state when page loads (if there's an old selection for create or edit)
    updateImagePreview();

    // Update image preview on company selection change (for both create and edit)
    $('#company_select').on('change', function() {
        updateImagePreview();

        // If in edit mode, update the hidden company image field
        if ($('#company_image').length > 0) {  // Check if it's the edit form
            const selectedOption = $(this).find('option:selected');
            const imageSrc = selectedOption.attr('data-image') || '';
            if (imageSrc) {
                $('#company_image').val(imageSrc);
            } else {
                $('#company_image').val('');
            }
        }
    });

    // Preview uploaded image from file input (works for both create and edit)
    $('#announcement_image').on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#uploaded_image').attr('src', e.target.result);
                $('#file_size').text((file.size / 1024).toFixed(2) + ' KB');
                $('.productviews').show();
                $('.productviews').closest('li').show(); // Ensure the <li> is shown
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove image preview (works for both create and edit)
    $('#remove_image').on('click', function() {
        $('.productviews').hide();
        $('.productviews').closest('li').hide(); // Hide the parent <li>
        $('#uploaded_image').attr('src', ''); // Clear image src
        $('#announcement_image').val(null); // Clear the file input

        // Reset company selection (for both create and edit)
        $('#company_select').val(null).trigger('change'); // Reset dropdown selection

        // Clear company_image hidden input (edit mode)
        if ($('#company_image').length > 0) {
            $('#company_image').val('');
        }
    });
});
