document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('filterForm');

    form.addEventListener('submit', (event) => {
        event.preventDefault(); 

        const formData = new FormData(form);
        const params = new URLSearchParams(formData).toString();

        fetch(`${announcementsIndexUrl}?${params}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;

            // Get only the <tbody> content from the response
            const newTbody = tempDiv.querySelector('tbody');

            if (newTbody) {
                document.querySelector('#filter-table tbody').innerHTML = newTbody.innerHTML;
            } else {
                console.error('The returned content does not contain a valid <tbody>.');
            }
        })
        .catch(error => console.error('An error occurred:', error));
    });
});
