let assignmentCount = 1; // Start with 1 since the first assignment already exists

document.getElementById("add-assignment").addEventListener("click", function () {
    if (assignmentCount < 3) {
        const assignments = document.getElementById("assignments");
        const newAssignment = document.querySelector(".assignment-group").cloneNode(true);
        // Clear the values of the cloned selects
        newAssignment.querySelectorAll("select").forEach(select => select.value = "");
        // Add event listener to the delete button
        const deleteButton = newAssignment.querySelector(".delete-assignment");
        deleteButton.addEventListener("click", function () {
            newAssignment.remove();
            assignmentCount--; // Decrease count when an assignment is removed
            document.getElementById("add-assignment").disabled = false; // Re-enable the button
        });
        assignments.appendChild(newAssignment);
        assignmentCount++; // Increase the count when a new assignment is added

        if (assignmentCount === 3) {
            document.getElementById("add-assignment").disabled = true; // Disable the button after 3 assignments
        }
    }
});

// Add event listeners for existing delete buttons
document.querySelectorAll(".delete-assignment").forEach(button => {
    button.addEventListener("click", function () {
        button.parentElement.remove();
        assignmentCount--; // Decrease count when an assignment is removed
        document.getElementById("add-assignment").disabled = false; // Re-enable the button
    });
});
