const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

(function() {
	'use strict';
	window.addEventListener('load', function() {
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

document.getElementById('form-identity').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    if (!e.target.checkValidity()) {
        return;
    }

    const formData = new FormData(this);
	const idCompanyEst = moment(formData.get('id-company-est'), "DD MMM YYYY").format('YYYYMMDD');

	formData.set('id-company-est', idCompanyEst);

    fetch('/body-maker-identity', {
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
                text:  'Step 1 of 9 completed. Moving to next step.',
                icon: 'success',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: false,
                showConfirmButton: true
            }).then(function (result) {
                if (result.value) {
					localStorage.setItem('company_id', data.data.id);
					location.href = '/body-maker-design';
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