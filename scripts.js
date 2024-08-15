document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('medal-form');
    const tableBody = document.querySelector('#medal-table tbody');

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const country = document.getElementById('country').value;
        const gold = parseInt(document.getElementById('gold').value, 10);
        const silver = parseInt(document.getElementById('silver').value, 10);
        const bronze = parseInt(document.getElementById('bronze').value, 10);

        if (country && !isNaN(gold) && !isNaN(silver) && !isNaN(bronze)) {
            const row = document.createElement('tr');

            row.innerHTML = `
                <td>${country}</td>
                <td>${gold}</td>
                <td>${silver}</td>
                <td>${bronze}</td>
            `;

            tableBody.appendChild(row);

            form.reset();
        } else {
            alert('Por favor, complete todos los campos correctamente.');
        }
    });
});
