const cardTotal = 8;
const cardContainer = document.getElementById("card-container");
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const emptyCardTemplate = `<div class="card-fade-in empty-card"></div>`;
let isValidationEnabled = true; 

(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            document.getElementById("btn-add-chassis").addEventListener("click", function(event) {
                if (isValidationEnabled && form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();

                    const types = document.getElementById("ch-types").value;
                    const unit = document.getElementById("ch-unit").value;

                    if(types === "" || unit === "") {
                        document.getElementById("ch-types").setAttribute("required", "required");
                        document.getElementById("ch-unit").setAttribute("required", "required");

                        return;
                    }

                    createCard(types, unit);

                    isValidationEnabled = false;
                    document.getElementById("ch-types").removeAttribute("required");
                    document.getElementById("ch-unit").removeAttribute("required");
                    document.getElementById("btn-save-chassis").removeAttribute("hidden");

                    form.reset();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

function createCard(chassisName, quantity) {
    const existingCards = cardContainer.querySelectorAll(".card");

    if (existingCards.length >= cardTotal) {
        Swal.fire({
            title: 'Error',
            text:  'You can only add up to 8 chassis.',
            icon: 'error',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            stopKeydownPropagation: false
        });
        return;
    }

    //check if chassis already exists
    for (let i = 0; i < existingCards.length; i++) {
        const card = existingCards[i];
        const cardChassisName = card.querySelector(".text-success").textContent;

        if (cardChassisName === chassisName) {
            Swal.fire({
                title: 'Error',
                text:  'Chassis already exists.',
                icon: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: false
            });
            return;
        }
    }

    const emptySlots = cardContainer.querySelectorAll(".empty-card");

    if (emptySlots.length > 0) {
        const emptySlot = emptySlots[0];
        emptySlot.classList.remove("empty-card");
        emptySlot.innerHTML = createCardHTML(chassisName, quantity);
        fadeInCard(emptySlot);
    } else {
        const card = document.createElement("div");
        card.className = "col-xl-3 col-sm-4 card-fade-in";
        card.style.opacity = 0;
        card.innerHTML = createCardHTML(chassisName, quantity);
        cardContainer.appendChild(card);
        fadeInCard(card);
    }
}

function fadeInCard(card) {
    card.getBoundingClientRect();
    setTimeout(() => {
        card.style.opacity = 1;
    }, 10);
}

function removeCard(chassisName) {
    const cards = cardContainer.getElementsByClassName("card");

    for (let i = 0; i < cards.length; i++) {
        const card = cards[i];
        const cardChassisName = card.querySelector(".text-success").textContent;

        if (cardChassisName === chassisName) {
            card.classList.add('card-fade-out');
            card.style.opacity = 0;
            setTimeout(() => {
                const emptyCard = document.createElement("div");
                emptyCard.classList.add("empty-card");
                emptyCard.innerHTML = emptyCardTemplate;

                if (card.parentNode) {
                    card.parentNode.replaceChild(emptyCard, card);
                }
            }, 300);
            break;
        }
    }
}

function createCardHTML(chassisName, quantity) {
    return `
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <div class="flex-shrink-0 me-4">
                    <div class="avatar-md">
                        <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                            <img src="build/images/chassis.png" alt="" height="30">
                        </span>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h6 class="text-truncate text-success font-size-14">${chassisName}</h6>
                    <p class="text-black mb-2">${quantity} / Month</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success mb-0">Chassis</span>
                        <a href="#" class="text-danger" onclick="removeCard('${chassisName}')">Remove <i class="bx bxs-trash-alt me-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
}

cardContainer.addEventListener("click", function(event) {
    if (event.target && event.target.matches(".text-danger")) {
        const card = event.target.closest(".card");
        if (card) {
            const chassisName = card.querySelector(".text-success").textContent;
            removeCard(chassisName);
        }
    }
});

document.getElementById("btn-save-chassis").addEventListener("click", function(event) {
    event.preventDefault();

    Swal.fire({
        title: 'Information',
        text:  'Only the chassis that are added will be saved.',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        stopKeydownPropagation: false
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("ch-types").removeAttribute("required");
            document.getElementById("ch-unit").removeAttribute("required");
            
            const cards = cardContainer.getElementsByClassName("card");
            const chassis = [];

            for (let i = 0; i < cards.length; i++) {
                const card = cards[i];
                const chassisName = card.querySelector(".text-success").textContent;
                let quantity = card.querySelector(".text-black").textContent;

                quantity = quantity.substring(0, quantity.length - 8);

                chassis.push({
                    "ch-types": chassisName,
                    "ch-unit": quantity,
                    "company_id": localStorage.getItem("company_id")
                });
            }

            formData = new FormData();
            formData.append('data', JSON.stringify(chassis));
            fetch('/body-maker-chassis', {
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
                        text:  'Step 6 of 9 completed. Moving to next step.',
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
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'Cancelled',
                text:  'Chassis not saved.',
                icon: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: false
            });
        }
    });
});