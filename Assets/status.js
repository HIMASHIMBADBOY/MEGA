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

// Showing the CV and resume in a new tab
function openFile(value) {
    window.open(value, '_blank');
}

// Show the feedback form
function showFeedbackForm(applicationId) {
    const container = document.getElementById('show');
    const formWrapper = container.querySelector('.feedback-transition');

    // Show the container and apply animation classes
    container.classList.remove('hidden');
    setTimeout(() => {
        formWrapper.classList.remove('opacity-0', '-translate-y-4');
        formWrapper.classList.add('opacity-100', 'translate-y-0');
    }, 20); // Match the duration of the CSS transition

    // Set the application ID in the hidden input field
    document.getElementById('applicationId').value = applicationId;
    console.log(`Showing feedback form for application ID: ${applicationId}`);
}

// Hide the feedback form
function hideFeedbackForm() {
    const container = document.getElementById('show');
    const formWrapper = container.querySelector('.feedback-transition');

    // Apply animation classes to hide the form
    formWrapper.classList.remove('opacity-100', 'translate-y-0');
    formWrapper.classList.add('opacity-0', '-translate-y-4');

    // Hide the container after the animation duration
    setTimeout(() => {
        container.classList.add('hidden');
    }, 200); // Match the duration of the CSS transition
}

// Submit the feedback form
function submitFeedback(event) {
    event.preventDefault();

    const feedbackText = document.getElementById('feedbackText').value;
    document.getElementById('feedbackMessage').value = feedbackText;

    const formData = new FormData(document.getElementById('feedbackForm'));
    fetch('../Includes/submitFeedback.inc.php', {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert('Feedback submitted successfully!');
                hideFeedbackForm(); // Hide the form after successful submission
                document.getElementById('feedbackForm').reset();
            } else {
                alert('Failed to submit feedback.');
            }
        })
        .catch((error) => console.error('Error submitting feedback:', error));
}





// Debounce function to limit API calls
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Function to fetch filtered applications
async function fetchFilteredApplications() {
    const searchTerm = document.getElementById('searchInput').value;
    const statusFilter = document.getElementById('statusFilter').value;
    const dateFilter = document.getElementById('dateFilter').value;
    const sortOrder = document.getElementById('sortOrder').value;

    try {
        const response = await fetch(`../Includes/applicationSearch.inc.php?search=${encodeURIComponent(searchTerm)}&status=${statusFilter}&date=${dateFilter}&sort=${sortOrder}`);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        let applications = await response.json();
        console.log('Fetched applications:', applications); // Debugging output
        renderApplications(applications);
    } catch (error) {
        console.error('Error fetching applications:', error);
        alert('Failed to fetch applications. Please try again.');
    }
}

// Function to render applications
function renderApplications(applications) {
    const tbody = document.querySelector('tbody');
    
    if (applications.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="px-6 py-4 text-center text-gray-600">No applications found</td></tr>';
        return;
    }
    
    tbody.innerHTML = applications.map(application => `
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4 text-gray-800 font-medium">${application.user_uid || ''}</td>
            <td class="px-6 py-4 text-gray-600">
                <span class="flex items-center">
                    ${application.application_status === 'Approved' ? 
                        '<i class="fas fa-check-circle mr-2 text-gray-600"></i>' : 
                        application.application_status === 'Rejected' ? 
                        '<i class="fas fa-times-circle mr-2 text-gray-600"></i>' : 
                        '<i class="fas fa-clock mr-2 text-gray-600"></i>'}
                    <span id="stts-${application.id}">${application.application_status || ''}</span>
                </span>
            </td>
            <td class="px-6 py-4 space-x-3">
                <button onclick="openFile('${application.resumee || ''}')" 
                        class="text-gray-600 hover:text-gray-800 flex items-center">
                    <i class="fas fa-file-pdf mr-1"></i>Resume
                </button>
                <button onclick="openFile('${application.cover_letter || ''}')" 
                        class="text-gray-600 hover:text-gray-800 flex items-center">
                    <i class="fas fa-file-word mr-1"></i>Cover
                </button>
            </td>
            <td class="px-6 py-4 text-gray-600">${application.submission_date || ''}</td>
            <td class="px-6 py-4 space-x-3">
                <button onclick="updateApplicationStatus(${application.id}, 'Approved')" 
                        class="text-gray-600 hover:text-gray-800 flex items-center">
                    <i class="fas fa-check mr-1"></i>Accept
                </button>
                <span class="text-gray-300">||</span>
                <button onclick="updateApplicationStatus(${application.id}, 'Rejected')" 
                        class="text-gray-600 hover:text-gray-800 flex items-center">
                    <i class="fas fa-times mr-1"></i>Reject
                </button>
            </td>
            <td class="px-6 py-4">
                <button onclick="showFeedbackForm('${application.id || ''}')" 
                 class="text-gray-600 hover:text-gray-800 flex items-center">
                <i class="fas fa-comment-dots mr-2"></i>Add Feedback
                </button>
            </td>
        </tr>
    `).join('');
}

// Add event listeners
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('searchInput').addEventListener('keyup', debounce(fetchFilteredApplications, 300));
    document.getElementById('statusFilter').addEventListener('change', fetchFilteredApplications);
    document.getElementById('dateFilter').addEventListener('change', fetchFilteredApplications);
    document.getElementById('sortOrder').addEventListener('change', fetchFilteredApplications);
});