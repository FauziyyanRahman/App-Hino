const selectedRoles = [];
const picData = [];
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const cardContainer = document.getElementById("card-container");

(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            document.getElementById("btn-save-identity").addEventListener("click", function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    const selectElement = document.getElementById("pic-level");
                    const selectedRole = selectElement.value;
                    const name = document.getElementById("pic-name").value;
                    const email = document.getElementById("pic-email").value;
                    const phone = document.getElementById("pic-phone").value;

                    if (selectElement.options.length === 2) {
                        event.preventDefault();
                        picData.push({
                            role: selectedRole,
                            name: name,
                            email: email,
                            phone: phone,
                            company_id: localStorage.getItem('company_id')
                        });

                        Swal.fire({
                            title: 'Are you sure?',
                            text:  'Person In Charge data will be saved.',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonText: 'Save',
                            cancelButtonText: 'Cancel',
                            reverseButtons: true
                        }).then(function (result) {
                            if (result.value) {
                                submitData(picData);
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                Swal.fire({
                                    title: 'Cancelled',
                                    text:  'Person In Charge data not saved.',
                                    icon: 'error'
                                });
                            }
                        });
                    } else if (selectedRole) {
                        event.preventDefault();

                        createCard(selectedRole, name, email, phone);
                        form.reset();
                    }
                }

                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

function submitData(data) { 
    formData = new FormData();
    formData.append('data', JSON.stringify(data));

    fetch('/body-maker-pic', {
        headers: { 'X-CSRF-TOKEN': csrfToken },
        method: 'POST',
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if(data.data) {
            Swal.fire({
                title: 'Success!',
                text:  'Step 4 of 9 completed. Moving to next step.',
                icon: 'success',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: false,
                showConfirmButton: true
            }).then(function (result) {
                if (result.value) {
					location.href = '/body-maker-production';
                }
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text:  'Failed to added.',
                icon: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: false,
                showConfirmButton: true
            }).then(function (result) {
                if (result.value) {
                    location.reload();
                }
            });
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
        // Handle errors and display an error message
    });
}

function createCard(role, name, email, phone) {
    const selectElement = document.getElementById("pic-level");
    const selectOptions = selectElement.options;

    // Remove the selected option from the dropdown
    for (let i = 0; i < selectOptions.length; i++) {
        if (selectOptions[i].value === role) {
            selectElement.remove(i);
            break;
        }
    }

    // Check if there are any existing empty card slots
    const emptySlots = cardContainer.querySelectorAll(".empty-card");
    if (emptySlots.length > 0) {
        // If there are empty slots, reuse the first one
        const emptySlot = emptySlots[0];
        emptySlot.classList.remove("empty-card");
        emptySlot.innerHTML = createCardHTML(role, name, email, phone);
        selectedRoles.push(role);
        fadeInCard(emptySlot);
    } else {
        // If there are no empty slots, create a new card
        const card = document.createElement("div");
        card.className = "col-xl-3 col-md-6 card-fade-in";
        card.style.opacity = 0;
        card.innerHTML = createCardHTML(role, name, email, phone);
        cardContainer.appendChild(card);
        selectedRoles.push(role);
        fadeInCard(card);
    }
}

function createCardHTML(role, name, email, phone) {
    picData.push({
        role: role,
        name: name,
        email: email,
        phone: phone,
        company_id: localStorage.getItem('company_id')
    });
    return `
        <div class="card h-100" data-role="${role}">
            <div class="card-body">
                <h5 class="fs-17 mb-2 text-primary">${role}</h5>
                <ul class="list-inline mb-0">
                    <li>
                        <p class="text-muted fs-14 mb-1"><i class="mdi mdi-account text-success"></i> ${name}</p>
                    </li>
                    <li>
                        <p class="text-muted fs-14 mb-1"><i class="mdi mdi-email text-warning"></i> ${email}</p>
                    </li>
                    <li>
                        <p class="text-muted fs-14 mb-0"><i class="mdi mdi-phone text-primary"></i> ${phone}</p>
                    </li>
                </ul>
                <div class="mt-3 hstack gap-2">
                    <span class="badge rounded-1 badge-soft-success">Name</span>
                    <span class="badge rounded-1 badge-soft-warning">Email</span>
                    <span class="badge rounded-1 badge-soft-info">Phone Number</span>
                </div>
                <div class="mt-4 hstack gap-2">
                    <button class="btn btn-soft-danger w-100" onclick="removeCard('${role}')">Remove</button>
                </div>
            </div>
        </div>`;
}

const emptyCardTemplate = `<div class="card-fade-in empty-card"></div>`;

function fadeInCard(card) {
    card.getBoundingClientRect();
    setTimeout(() => {
        card.style.opacity = 1;
    }, 10);
}

function removeCard(role) {
    const card = document.querySelector(`[data-role="${role}"]`);
    if (card) {
        card.classList.add('card-fade-out');
        card.style.opacity = 0;
        setTimeout(() => {
            const emptyCard = document.createElement("div");
            emptyCard.classList.add("empty-card");
            emptyCard.innerHTML = emptyCardTemplate;

            // Check if the card still exists before replacing it
            if (card.parentNode) {
                card.parentNode.replaceChild(emptyCard, card);
            }
        }, 300); // Adjust the delay as needed
        
        const selectElement = document.getElementById("pic-level");
        if (!Array.from(selectElement.options).some((option) => option.value === role)) {
            const newOption = document.createElement("option");
            newOption.value = role;
            newOption.text = role;
            selectElement.appendChild(newOption);
        }
    }

    const index = selectedRoles.indexOf(role);
    if (index !== -1) {
        selectedRoles.splice(index, 1);
        picData.splice(index, 1);
    }
}

cardContainer.addEventListener("click", function(event) {
    if (event.target && event.target.matches(".btn.btn-soft-danger")) {
        const card = event.target.closest(".card");
        if (card) {
            const role = card.getAttribute("data-role");
            removeCard(role);
        }
    }
});