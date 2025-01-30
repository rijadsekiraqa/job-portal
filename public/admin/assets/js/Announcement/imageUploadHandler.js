// imageUploadHandler.js

document.addEventListener('DOMContentLoaded', function () {
    // Handle image file change event
    document.getElementById('announcement_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const imagePreviewItem = document.getElementById('image_preview_item');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Display the new image preview
                document.getElementById('uploaded_image').src = e.target.result;
                document.getElementById('file_size').textContent = (file.size / 1024).toFixed(2) + ' KB';
                
                // Make sure the preview item is visible
                imagePreviewItem.style.display = 'block'; // Remove display: none
            };
            reader.readAsDataURL(file);
        } else {
            // If no file is selected, show the previous image if in edit mode
            document.getElementById('uploaded_image').src = existingImageSrc;
            document.getElementById('file_size').textContent = ''; // Clear file size
            imagePreviewItem.style.display = existingImageSrc ? 'block' : 'none'; // Show or hide based on existing image
        }
    });

    // Handle remove image click event
    document.getElementById('remove_image').addEventListener('click', function() {
        // Hide the image preview and clear the src attribute
        document.getElementById('uploaded_image').src = defaultImageSrc; // Reset to default
        document.getElementById('file_size').textContent = ''; // Clear file size
        document.getElementById('announcement_image').value = ''; // Clear the file input
        document.getElementById('image_preview_item').style.display = 'none'; // Hide the preview item
    });
});
