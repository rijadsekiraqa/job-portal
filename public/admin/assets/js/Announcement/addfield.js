$(document).ready(function() {
    $('#add-more-requirements').on('click', function() {
        var newInput = `
            <div class="form-group d-flex align-items-center mt-2">
                <input type="text" name="requirements[]" id="requirements"
                placeholder="Ju lutem shkruani kerkesat qe kerkohen per kete konkurs" class="form-control me-2">
                <button type="button" class="btn btn-danger remove-requirements px-3 d-flex align-items-center" style="flex-shrink: 0;">
                <img src="http://127.0.0.1:8000/admin/assets/img/icons/close-circle.svg" class="me-1" alt="img">Fshij
                </button>
            </div>`;
        
        $('#requirements-container').append(newInput);
    });

    // Handle adding more qualifications
    $('#add-more-qualifications').on('click', function() {
        var newInput = `
            <div class="form-group d-flex align-items-center mt-2">
                <input type="text" name="qualifications[]" id="qualifications"
                placeholder="Ju lutem shkruani kualifikimet qe kerkohen per kete konkurs" class="form-control me-2">
                <button type="button" class="btn btn-danger remove-qualifications px-3 d-flex align-items-center" style="flex-shrink: 0;">
                <img src="http://127.0.0.1:8000/admin/assets/img/icons/close-circle.svg" class="me-2" alt="img">Fshij
                </button>
            </div>`;
        
        $('#qualifications-container').append(newInput);
    });

    // Remove functionality for both responsibilities and qualifications
    $(document).on('click', '.remove-requirements', function() {
        $(this).parent().remove();
    });

    $(document).on('click', '.remove-qualifications', function() {
        $(this).parent().remove();
    });
});
