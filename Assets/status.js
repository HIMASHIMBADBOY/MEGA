//updating the status of applcation
function updateApplicationStatus(applicationId, status) {
    fetch('../Includes/ApplicationStatus.inc.php', {
        method: 'POST',
        headers: {
            'Content-type': 'application/json',
        },
        body: JSON.stringify({ id: applicationId, application_status: status }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(`Application ${status} successfully!`);
            // Debugging output
            console.log(`Updating status for application ID: ${applicationId} to ${status}`);
            // Update the status in the DOM without reloading
            const statusSpan = document.querySelector(`.status[data-id="${applicationId}"]`);
            if (statusSpan) {
                console.log(`Found status span for application ID: ${applicationId}`);
                statusSpan.textContent = status;
            } else {
                console.log(`Status span not found for application ID: ${applicationId}`);
            }
        } else {
            alert('Failed to update status.');
        }
    })
    .catch(error => console.error('Error updating application status:', error));
}