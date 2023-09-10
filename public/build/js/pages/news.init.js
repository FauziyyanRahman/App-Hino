const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const cardsPerPage = 8; // Number of cards to display per page
let currentPage = parseInt(new URLSearchParams(window.location.search).get('page')) || 1; // Get the current page from the URL or default to page 1
let data = []; // Your data fetched from the API
let totalPages;

function fetchData() {
    fetch('/yajra-news').then(response => response.json())
    .then(result => {
        data = result.data;
        totalPages = Math.ceil(data.length / cardsPerPage);
        initializePagination(totalPages, currentPage);
        displayDataForPage(currentPage);
    })
    .catch(error => console.error('Error fetching data:', error));
}

function initializePagination(totalPages, currentPage) {
    const paginationDiv = document.getElementById('paging');
    paginationDiv.innerHTML = '';

    paginationDiv.innerHTML += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a href="?page=${currentPage - 1}" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
        </li>
    `;

    for (let page = 1; page <= totalPages; page++) {
        paginationDiv.innerHTML += `
            <li class="page-item ${page === currentPage ? 'active' : ''}">
                <a href="?page=${page}" class="page-link">${page}</a>
            </li>
        `;
    }

    paginationDiv.innerHTML += `
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a href="?page=${currentPage + 1}" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
        </li>
    `;
}

function displayDataForPage(page, dataToDisplay = data) {
    const startIndex = (page - 1) * cardsPerPage;
    const endIndex = startIndex + cardsPerPage;
    const dataSlice = dataToDisplay.slice(startIndex, endIndex);

    const contentContainer = document.getElementById('news-container');
    contentContainer.innerHTML = '';

    // Replace this with your rendering logic
    dataSlice.forEach(item => {
        let imageUrl;

        if (item.ms_berita_image) {
            imageUrl = 'http://localhost:80/' + item.ms_berita_image;
        } else {
            imageUrl = 'http://localhost:80/dokumen/berita/news.jpg';
        }

        const createDate = moment(item.create_date).format('DD MMM YYYY');
        const status = item.active == 1 ? 'Published' : 'Unpublished';
        const author = capitalizeFirstLetter(item.create_id);
        const titleStyle = ` 
            max-height: 2.4em; /* 2 lines with some padding */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;`;
        const fixSized = ` 
            width: 171px; /* Set your desired width */
            height: 96px;
            object-fit: cover;`;
        const card = document.createElement('div');
        card.className = 'col-sm-3';
        card.innerHTML = `
            <div class="card p-1 border shadow-none">
                <div class="p-3">
                    <h6 style="${titleStyle}"><a href="blog-details" class="text-dark">${item.ms_berita_judul}</a></h6>
                    <p class="text-muted mb-0">
                        <span class="list-inline-item me-3 font-size-12">
                            <i class="bx bx-calendar align-middle text-muted me-1"></i>
                            ${createDate}
                        </span>
                    </p>
                </div>
                <div class="position-relative">
                    <img src="${imageUrl}" alt="" style="${fixSized}" class="img-thumbnail" loading="lazy">
                </div>
                <div class="p-3">
                    <ul class="list-inline">
                        <li class="list-inline-item me-3">
                            <a href="#" class="text-muted">
                                <i class="bx bx-user-circle align-middle text-muted me-1"></i>
                                ${author}
                            </a>
                        </li>
                        <li class="list-inline-item me-3">
                            <a href="#" class="text-muted">
                                <i class="bx bx-news align-middle text-muted me-1"></i>
                                ${status}
                            </a>
                        </li>
                    </ul>
                    <div>
                        <a href="#" class="text-danger" data-remove-id="${item.ms_berita_id}">Delete <i class="mdi mdi-delete"></i></a>
                        <a href="#newContactModal" data-bs-toggle="modal" class="text-primary" data-edit-id="${item.ms_berita_id}">Edit <i class="mdi mdi-pencil"></i></a>
                    </div>
                </div>
            </div>
        `;
        contentContainer.appendChild(card);
    });
}

fetchData();

document.addEventListener('click', event => {
    if (event.target.matches('#paging a')) {
        event.preventDefault();
        const page = parseInt(new URLSearchParams(event.target.getAttribute('href').split('?')[1]).get('page'));
        
        if (!isNaN(page) && page !== currentPage) {
            currentPage = page;
            displayDataForPage(currentPage);
            initializePagination(totalPages, currentPage);
        }
    }
});

function capitalizeFirstLetter(str) {
    if (str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
    return 'Unknown'; // Default value for null or undefined
}

const searchInput = document.getElementById('searchTableList');
searchInput.addEventListener('keyup', function () {
    const searchTerm = searchInput.value.toLowerCase();
    const filteredData = data.filter(item => {
        // Replace 'item.ms_berita_judul' with the property you want to search in.
        return item.ms_berita_judul.toLowerCase().includes(searchTerm);
    });

    // Update the display with the filtered data.
    displayDataForPage(currentPage, filteredData);
});

document.querySelector('.addNews-modal').addEventListener('click', function() {
    var imageUrl = 'http://localhost:80/dokumen/berita/news.jpg';
    document.getElementById("createNews-form").reset();
    document.getElementById("newContactModalLabel").innerHTML = 'Add News';
    document.getElementById("addContact-btn").innerHTML = "Add";
    document.getElementById("image-preview").src = imageUrl;
    document.getElementById("image-zoom").href = imageUrl;
    document.getElementById("image-input").value = '';
    document.getElementById("image-input").setAttribute('onchange', 'previewImage("' + imageUrl + '")');
    initOrUpdateTinyMCE('content-id', '');   
});

$(document).on('click', 'a[data-edit-id]', function () {    
    var id = $(this).data('edit-id');

    $('#news-id-input').val(id);
    document.getElementById("newContactModalLabel").innerHTML = 'Edit News';
    document.getElementById("addContact-btn").innerHTML = "Update";

    fetch('/news/' + id).then(response => response.json())
    .then(result => {
        data = result.data;

        $('#subject-id-input').val(data.ms_berita_judul);
        $('#subject-en-input').val(data.ms_berita_judul_en);

        var imageUrl = '';

        if (data.ms_berita_image == null || data.ms_berita_image == '') {
            imageUrl = 'http://localhost:80/dokumen/berita/news.jpg';
        } else {
            imageUrl = 'http://localhost:80/' + data.ms_berita_image.replace(/\s/g, '%20');
        }

        $('#image-zoom').attr('href', imageUrl);
        $('#image-preview').attr('src', imageUrl);
        $('#image-input').attr('onchange', 'previewImage("' + imageUrl + '")');

        initOrUpdateTinyMCE('content-id', data.ms_berita_content);
    })
    .catch(error => console.error('Error fetching data:', error));
});

$(document).on('click', 'a[data-remove-id]', function () {
    var id = $(this).data('remove-id');

    Swal.fire({
        title: 'Are you sure?',
        text: "News data will not revert back!",
        icon: 'warning',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        stopKeydownPropagation: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/news/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text:  'News been deleted.',
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
                        text:  'News failed to delete.',
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
                console.log('Error:', error);
            });
        }
    });
});

function previewImage(originPath) {
    const imageInput = document.getElementById('image-input');
    const imagePreview = document.getElementById('image-preview');
    const imageZoom = document.getElementById('image-zoom');
    const spinner = document.querySelector('.spinner-border');

    if (imageInput.files && imageInput.files[0]) {
        const reader = new FileReader();

        spinner.style.display = 'block';

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imageZoom.href = e.target.result;

            spinner.style.display = 'none';
        };

        reader.readAsDataURL(imageInput.files[0]);
    } else {
        spinner.style.display = 'block';

        imagePreview.src = originPath;
        imageZoom.href = originPath;

        spinner.style.display = 'none';
    }
}

function initOrUpdateTinyMCE(textareaId, content) {
    var editor = tinymce.get(textareaId);

    if (editor) {
        editor.setContent(content);
    } else {
        // TinyMCE is not initialized; initialize it now
        tinymce.init({
            selector: 'textarea#' + textareaId,
            height: 350,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:"Poppins",sans-serif; font-size:16px }',
            setup: function (editor) {
                editor.on('init', function () {
                    // Set the content once initialized
                    editor.setContent(content);
                });
            }
        });
    }
}

// Add an event listener to the form's submit button
document.getElementById('addContact-btn').addEventListener('click', function (e) {
    e.preventDefault(); // Prevent the default form submission
    //get values from newContactModalLabel
    var newContactModalLabel = $('#newContactModalLabel').text();

    if(newContactModalLabel == 'Add News') {
        addNews();
    } else {
        updateNews();
    }
});

function addNews() {
    // Create a FormData object to send the form data
    const formData = new FormData();
    const subjectId = document.getElementById('subject-id-input').value;
    const subjectEn = document.getElementById('subject-en-input').value;
    const contentId = tinymce.get('content-id').getContent();
    const imageInput = document.getElementById('image-input').files[0];

    if(imageInput != null) {
        const fileType = imageInput.type;
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
        if (!validImageTypes.includes(fileType)) {
            Swal.fire({
                title: 'Error!',
                text: 'Please upload correct image file format',
                icon: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: false,
                showConfirmButton: true
            });
    
            return;
        } else {
            formData.append('berita_foto', imageInput);
        }
    }

    formData.append('berita_judul', subjectId);
    formData.append('berita_content', contentId);
    formData.append('berita_judul_en', subjectEn);
    formData.append('berita_content_en', contentId);

    fetch('/news', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken },
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            Swal.fire({
                title: 'Success!',
                text:  subjectId + ' been added.',
                icon: 'success',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: false,
                showConfirmButton: true
            }).then(function (result) {
                if (result.value) {
                    location.reload();
                    $('#newContactModal').modal('hide');
                }
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text:  subjectId + ' failed to add.',
                icon: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: false,
                showConfirmButton: true
            }).then(function (result) {
                if (result.value) {
                    location.reload();
                    $('#newContactModal').modal('hide');
                }
            });
        }
    })
}

function updateNews() {
    // Create a FormData object to send the form data
    const formData = new FormData();
    const editId = document.getElementById('news-id-input').value;
    const subjectId = document.getElementById('subject-id-input').value;
    const subjectEn = document.getElementById('subject-en-input').value;
    const contentId = tinymce.get('content-id').getContent();
    const imageInput = document.getElementById('image-input').files[0];

    if(imageInput != null) {
        const fileType = imageInput.type;
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
        if (!validImageTypes.includes(fileType)) {
            Swal.fire({
                title: 'Error!',
                text: 'Please upload correct image file format',
                icon: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: false,
                showConfirmButton: true
            });
    
            return;
        } else {
            formData.append('ubah_berita_foto', imageInput);
        }
    }

    formData.append('ubah_berita_id', editId);
    formData.append('ubah_berita_judul', subjectId);
    formData.append('ubah_berita_content', contentId);
    formData.append('ubah_berita_judul_en', subjectEn);
    formData.append('ubah_berita_content_en', contentId);

    fetch('/news-update', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken },
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            Swal.fire({
                title: 'Success!',
                text:  subjectId + ' been updated.',
                icon: 'success',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: false,
                showConfirmButton: true
            }).then(function (result) {
                if (result.value) {
                    location.reload();
                    $('#newContactModal').modal('hide');
                }
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text:  subjectId + ' failed to update.',
                icon: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: false,
                showConfirmButton: true
            }).then(function (result) {
                if (result.value) {
                    location.reload();
                    $('#newContactModal').modal('hide');
                }
            });
        }
    })
    .catch(error => {
        console.log('Error:', error);
    });
}

$('.image-popup-no-margins').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    fixedContentPos: true,
    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
    image: {
        verticalFit: true
    },
    zoom: {
        enabled: true,
        duration: 300 // don't foget to change the duration also in CSS
    }
});