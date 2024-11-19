
document.getElementById('appointmentSearch').addEventListener('keyup', function() {
    var searchValue = this.value.toLowerCase();
    var tableRows = document.querySelectorAll('#appointmentTable tbody tr');
    tableRows.forEach(function(row) {
        var userName = row.cells[1].textContent.toLowerCase();
        var status = row.cells[3].textContent.toLowerCase();
        if (userName.includes(searchValue) || status.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});


document.getElementById('upcomingAppointmentSearch').addEventListener('keyup', function() {
    var searchValue = this.value.toLowerCase();
    var tableRows = document.querySelectorAll('#upcomingAppointmentTable tbody tr');
    tableRows.forEach(function(row) {
        var userName = row.cells[1].textContent.toLowerCase();
        var status = row.cells[3].textContent.toLowerCase();
        if (userName.includes(searchValue) || status.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});


document.getElementById('appointmentHistorySearch').addEventListener('keyup', function() {
    var searchValue = this.value.toLowerCase();
    var tableRows = document.querySelectorAll('#appointmentHistoryTable tbody tr');
    tableRows.forEach(function(row) {
        var userName = row.cells[1].textContent.toLowerCase();
        var status = row.cells[3].textContent.toLowerCase();
        if (userName.includes(searchValue) || status.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});