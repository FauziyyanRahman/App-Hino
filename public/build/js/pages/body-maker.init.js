const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

(function() {
	'use strict';
	window.addEventListener('load', function() {
        fetchData();
        createTimeline();
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
		form.addEventListener('submit', function(event) {
			if (form.checkValidity() === false) {
			event.preventDefault();
			event.stopPropagation();
			}
			form.classList.add('was-validated');
		}, false);
		});
	}, false);
})();

function fetchData() {
    fetch('/body-maker-show').then(response => response.json())
    .then(result => {
        data = result.data;
        console.log(data);
        if(data.length > 0) {
            displayData(data);
        } else {
            displayNoDataMessage();
        }
    })
    .catch(error => console.error('Error fetching data:', error));
}

document.getElementById('pic-web').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    if (!e.target.checkValidity()) {
        return;
    }

    const formData = new FormData(this);

    fetch('/body-maker', {
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
        //check if data not empty return sweetalert
        if(data.data){
            Swal.fire({
                title: 'Success!',
                text:  data.data.ms_name + ' has been added.',
                icon: 'success',
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
});

function displayData(data) {
    const ul = document.querySelector(".verti-timeline");

    ul.appendChild(createListItem(data[0], true));
    // Loop through the remaining data and add list items
    data.slice(1, 4).forEach(item => {
        ul.appendChild(createListItem(item, false));
    });
}

function displayNoDataMessage() {
    const ul = document.querySelector(".verti-timeline");
    const messageLi = document.createElement("li");
    ul.innerHTML = "";

    messageLi.classList.add("event-list");
    messageLi.textContent = "No data to display";
    
    ul.appendChild(messageLi);
}

function createListItem(item, isActive) {
    const li = document.createElement("li");    
    const date = moment(item.created_at);
    const formattedDate = date.format('DD MMM YYYY, HH:mm');
    const iconClass = isActive
        ? "bx bxs-right-arrow-circle font-size-24 bx-fade-right" 
        : "bx bx-right-arrow-circle font-size-24";
    
    li.classList.add("event-list");
    li.classList.add('pb-3');
  
    if (isActive) {
      li.classList.add("active");
    }
  
    li.innerHTML = `
        <div class="event-timeline-dot">
            <i class="${iconClass}"></i>
        </div> 
        <div class="d-flex">
            <div class="flex-shrink-0 me-2">
                <img src="build/images/user-dummy-img.jpg" alt="" class="avatar-xs rounded-circle">
            </div>
            <div class="flex-grow-1 font-size-12">
                <div class="overflow-hidden">
                    <b>${item.ms_name}</b> joined. 
                    <br class="d-none d-sm-block">
                    <b>Approval Need</b>
                    <p class="mb-0 text-muted">${formattedDate}</p>
                </div>
            </div>
        </div>`;
    return li;
}

function createTimeline() {
    const eventData = [
        { step: 1, title: "A. Identity", link: "/body-maker-identity" },
        { step: 2, title: "B. Design Tool", link: "/body-maker-design" },
        { step: 3, title: "C. Equipment And Tools", link: "/body-maker-equipment" },
        { step: 4, title: "D. Person In Charge", link: "/body-maker-pic" },
        { step: 5, title: "E. Production Capacity", link: "/body-maker-production" },
        { step: 6, title: "F. Hino Chassis Use", link: "/body-maker-chassis" },
        { step: 7, title: "G. Variant Product Body Builder", link: "/body-maker-variant" },
        { step: 8, title: "H. SKRB Above 2015", link: "/body-maker-skrb" },
        { step: 9, title: "I. PIC Website Apps", link: "/body-maker-website" },
    ];

    const timelineCarousel = $("#timeline-carousel");
    eventData.forEach((event, index) => {
        const eventItem = $("<div>").addClass("item event-list");
            // if (index === 0) { 
            //     eventItem.addClass("active");
            // }
        const eventContent = `
            <div class="event-date">
                <div class="event-down-icon">
                    <a href="${event.link}" class="text-muted down-arrow-link">
                        <i class="bx bx-down-arrow-circle h1 text-muted down-arrow-icon"></i>
                    </a>
                </div>
                <div class="text-muted mb-2">Step - ${event.step}</div>
                <h6 class="mb-2 text-muted">${event.title}</h6>
            </div>`;
        eventItem.html(eventContent);
        timelineCarousel.append(eventItem);

        const link = eventItem.find('.down-arrow-link');
        link.on('click', function (e) {
            e.preventDefault(); // Prevent the default link behavior
        });
    });
    
    timelineCarousel.owlCarousel({
        items: 1,
        loop: false,
        margin:0,
        nav: true,
        navText : ["<i class='mdi mdi-chevron-left'></i>","<i class='mdi mdi-chevron-right'></i>"],
        dots: false,
        responsive:{
            576: { items:2 },
            768: { items:4 },
        }
    });
}

$("#btn-body-maker-register").click(function () {
    const $this = $(this);
    const isReset = $this.text() === "Reset";

    if (isReset) {
        $(this).text("Register");
        $("#pic-web :input").prop("disabled", false);
        $("#pic-web button[type='submit']").prop("disabled", false);
        $(".event-list:eq(0) .text-success").removeClass("text-success").addClass("text-muted");
        $(".event-list:eq(0)").removeClass("active");
        $(".down-arrow-link").on("click", function (e) {
            e.preventDefault(); // Prevent the default link behavior
        });
    } else {
        $(this).text("Reset");        
        $("#pic-web :input").prop("disabled", true);
        $("#pic-web button[type='submit']").prop("disabled", true);
        $(".event-list:eq(0) .text-muted").removeClass("text-muted").addClass("text-success");
        $(".event-list:eq(0)").addClass("active");
        $(".down-arrow-link").off("click");
    }
});