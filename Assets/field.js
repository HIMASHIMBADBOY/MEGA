// Handling the Add Field form submission
document.addEventListener("DOMContentLoaded", () => {
    const addFieldForm = document.querySelector("#addFieldForm");
    if (addFieldForm) {
        addFieldForm.addEventListener("submit", handleAddField);
    }

    // Adding event listeners for edit and delete buttons
    const fieldsTable = document.querySelector("#fieldsTableBody");
    if (fieldsTable) {
        fieldsTable.addEventListener("click", handleFieldActions);
    }
});

function handleAddField(event) {
    event.preventDefault();

    const form = event.target;
    const formData = {
        action: "add",
        field_name: form.field_name.value,
        description: form.description.value,
        location: form.location.value,
    };

    // Send the form data to the server using fetch
    fetch("../../Includes/fieldManage.inc.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert(data.message);

                // Hide the form
                form.reset();
                form.style.display = "none";

                // Update the fields table
                updateFieldsTable(data.fields);
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("An error occurred while adding the field.");
        });
}

// Update the fields table dynamically
function updateFieldsTable(fields) {
    const tableBody = document.querySelector("#fieldsTableBody");
    if (tableBody) {
        tableBody.innerHTML = ""; // Clear existing rows

        fields.forEach((field) => {
            const row = document.createElement("tr");
            row.classList.add("hover:bg-gray-50", "transition-colors");

            row.innerHTML = `
                <td class="px-6 py-4 text-gray-800 font-medium">${field.field_name}</td>
                <td class="px-6 py-4 text-gray-600">${field.description}</td>
                <td class="px-6 py-4 text-gray-600">${field.location}</td>
                <td class="px-6 py-4 space-x-2">
                    <a href="#" class="edit-field text-gray-600 hover:text-gray-900 px-3 py-1 rounded-md transition-colors" data-id="${field.field_id}">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                    <a href="#" class="delete-field text-red-600 hover:text-red-800 px-3 py-1 rounded-md transition-colors" data-id="${field.field_id}">
                        <i class="fas fa-trash-alt mr-1"></i>Delete
                    </a>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }
}

function handleFieldActions(event) {
    const target = event.target;

    // Prevent default behavior of <a> tags
    event.preventDefault();

    // Check if the edit button was clicked
    if (target.closest(".edit-field")) {
        const fieldId = target.closest(".edit-field").dataset.id;
        handleEditField(fieldId);
    }

    // Check if the delete button was clicked
    if (target.closest(".delete-field")) {
        const fieldId = target.closest(".delete-field").dataset.id;
        handleDeleteField(fieldId);
    }
}

// Handle the edit field action
function handleEditField(fieldId) {
    const newFieldName = prompt("Enter the new field name:");
    const newDescription = prompt("Enter the new description:");
    const newLocation = prompt("Enter the new location:");

    if (newFieldName && newDescription && newLocation) {
        fetch("../../Includes/fieldManage.inc.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                action: "edit",
                field_id: fieldId,
                field_name: newFieldName,
                description: newDescription,
                location: newLocation,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert(data.message);
                    updateFieldsTable(data.fields);
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while editing the field.");
            });
    }
}

// Handle the delete field action
function handleDeleteField(fieldId) {
    if (confirm("Are you sure you want to delete this field?")) {
        fetch("../../Includes/fieldManage.inc.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                action: "delete",
                field_id: fieldId,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert(data.message);
                    updateFieldsTable(data.fields);
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while deleting the field.");
            });
    }
}