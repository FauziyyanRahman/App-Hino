var userListData = '';
var editList = false;
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// Function to get JSON data from a URL
var getJSON = function (jsonurl, callback) {
    fetch(jsonurl)
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function(data) {
            callback(null, data);
        })
        .catch(function(error) {
            callback(error, null);
        });
};

// Get JSON data from the Laravel route
getJSON("/yajra-users", function (err, data) {
    if (err !== null) {
        console.log("Something went wrong: " + err);
    } else {
        userListData = data.data;
        loadUserList(userListData);
    }
});

// load table list data
function loadUserList(datas) {
    $('#userList-table').DataTable({
        data: datas,
        "bLengthChange": false,
        order: [[0, 'desc']],
        language: {
            oPaginate: {
                sNext: '<i class="mdi mdi-chevron-right"></i>',
                sPrevious: '<i class="mdi mdi-chevron-left"></i>',
            }
        },
        columns: [
            {
                data: null,
                render: function (data, type, full) {
                    var firstChar = data.ms_user_name.charAt(0)
                    var isUserProfile = '<div class="avatar-title rounded-circle text-uppercase">' + firstChar + '</div>';
                    return '<div class="d-none">'+full.ms_user_id+'</div><div class="avatar-xs img-fluid rounded-circle">' + isUserProfile + '</div';
                },
            }, 
            {
                data: null,
                render: function (data, type, full) {
                    var str = full.ms_user_name;
                    var newStr = str.charAt(0).toUpperCase() + str.slice(1);

                    var str = full.ms_user_email;
                    var newStr2 = str.charAt(0).toUpperCase() + str.slice(1);
                    return '<div>\
                    <h5 class="text-truncate font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">'+ newStr + '</a></h5>\
                    <p class="text-muted mb-0" style="font-size: 11px;">'+ newStr2 + '</p>\
                    </div>';
                },
            },
            {
                data: "ms_role_name",
                render: function (data) {
                    return '\
                    <a href="javascript: void(0);" class="badge badge-soft-primary font-size-11 m-1">' + data.charAt(0).toUpperCase() + data.slice(1) +'\
                    </a>';
                }
            },
            {
                data: "ms_karoseri_name",
                render: function (data) {
                    if (data !== null) {
                        return '<p class="text-success mb-0">' + data.charAt(0).toUpperCase() + data.slice(1) + '</p>';
                    } else {
                        return '<p class="text-danger mb-0">Karoseri name not found</p>';
                    }
                }
            },
            {
                data: "update_id",
                render: function (data) {
                    if (data !== null) {
                        return data.charAt(0).toUpperCase() + data.slice(1);
                    } else {
                        return '';
                    }
                }
            },
            {
                data: "update_date",
                render: function (data) {
                    if (data === null) {
                        return '';
                    }

                    return data;
                }
            },
            {
                data: null,
                'bSortable': false,
                render: function (data, type, full) {
                    return '<ul class="list-inline font-size-20 contact-links mb-0">\
                    <li class="list-inline-item">\
                    <div class="dropdown">\
                        <a href="javascript: void(0);" class="dropdown-toggle card-drop px-2" data-bs-toggle="dropdown" aria-expanded="false">\
                            <i class="mdi mdi-dots-horizontal font-size-18"></i>\
                        </a>\
                        <ul class="dropdown-menu dropdown-menu-end">\
                            <li><a href="#newContactModal" data-bs-toggle="modal" class="dropdown-item edit-list" data-edit-id="'+ full.ms_user_id + '"><i class="mdi mdi-pencil font-size-16 text-success me-1"></i> Edit</a></li>\
                            <li><a href="#removeItemModal" data-bs-toggle="modal" class="dropdown-item remove-list" data-remove-id="'+ full.ms_user_id + '"><i class="mdi mdi-trash-can font-size-16 text-danger me-1"></i> Delete</a></li>\
                        </ul>\
                    </div>\
                    </li>\
                </ul>';
                },
            },
        ],
        drawCallback: function (oSettings) {
            editContactList();
            removeItem();
        },
    });

    $('#searchTableList').keyup(function () {
        $('#userList-table').DataTable().search($(this).val()).draw();
    });
    $(".dataTables_length select").addClass('form-select form-select-sm');
    $('.dataTables_paginate').addClass('pagination-rounded');
    $(".dataTables_filter").hide();
}

Array.from(document.querySelectorAll(".addContact-modal")).forEach(function(elem) {
    elem.addEventListener('click', function (event) {
        editList = false;
        document.getElementById("createContact-form").classList.remove("was-validated");
        document.getElementById("newContactModalLabel").innerHTML = "Add Users";
        document.getElementById("addContact-btn").innerHTML = "Add";
        document.getElementById("userid-input").value = "";
        document.getElementById("username-input").value = "";
        document.getElementById("username-input").readOnly = false;
        document.getElementById("password-label").style.display = "block";
        document.getElementById("password-input").style.display = "block";
        document.getElementById("password-input").setAttribute("required", "");
        document.getElementById("password-input").value = "";
        document.getElementById("email-input").value = "";
        document.getElementById("member-img").src = "build/images/user-dummy-img.jpg";

        $('#roles-select').val("").trigger('change');
    });
});

var createContactForms = document.querySelectorAll('.createContact-form')
Array.prototype.slice.call(createContactForms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();

            var userName = document.getElementById('username-input').value;
            var password = document.getElementById('password-input').value;
            var emailInput = document.getElementById('email-input').value;
            var rolesInputFieldValue = $("#roles-select").val();

            if (userName !== "" && emailInput !== "" && !editList) {
                var newList = {
                    "ms_user_name": userName,
                    "ms_user_password": password,
                    "ms_user_email": emailInput,
                    "ms_role_name": rolesInputFieldValue
                };

                fetch('/users', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify(newList)
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'User has been created.',
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
                        throw new Error('Something went wrong');
                    }
                })
                .catch(error => {
                    console.error('Edit request failed:', error);
                });
            }else if(userName !== "" && emailInput !== "" && editList){
                var getEditid = 0;
                getEditid = document.getElementById("userid-input").value;
                var editObj = {
                    "ms_user_name": userName,
                    "ms_user_email": emailInput,
                    "ms_role_name": rolesInputFieldValue,                    
                };

                fetch('/users/' + getEditid, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify(editObj)
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'User has been updated.',
                            icon: 'success',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            stopKeydownPropagation: false,
                            showConfirmButton: true
                        }).then(function (result) {
                            if (result.value) {
                                if ($.fn.DataTable.isDataTable('#userList-table')) {
                                    $('#userList-table').DataTable().destroy();
                                };
                                $("#newContactModal").modal("hide");
                                location.reload();
                            }
                        });
                    } else {
                        throw new Error('Something went wrong');
                    }
                })
                .catch(error => {
                    console.error('Edit request failed:', error);
                });

                editList = false;
            }

            if ($.fn.DataTable.isDataTable('#userList-table')) {
                $('#userList-table').DataTable().destroy();
            }
            loadUserList(userListData)
            $("#newContactModal").modal("hide");
        }
        form.classList.add('was-validated');
    }, false)
});

// edit list event
function editContactList() {
    $('#userList-table').on('click', '.edit-list', function () {
        var userId = $(this).data('edit-id');
        editList = true;
        userListData = userListData.map(function (item) {
            if (item.ms_user_id == userId) {            
                document.getElementById("newContactModalLabel").innerHTML = "Edit Users";
                document.getElementById("addContact-btn").innerHTML = "Update";
                document.getElementById("userid-input").value = item.ms_user_id;
                document.getElementById("member-img").src = "build/images/user-dummy-img.jpg";
                document.getElementById("username-input").value = item.ms_user_name;
                document.getElementById("username-input").readOnly = true;
                document.getElementById("password-input").removeAttribute("required");
                document.getElementById("password-input").style.display = "none";
                document.getElementById("password-label").style.display = "none";
                document.getElementById("email-input").value = item.ms_user_email;

                $('#roles-select').val(item.ms_role_name).trigger('change');
            }
            return item; // Return the item as is
        });
    });
}

function removeItem() {
    $('#userList-table').on('click', '.remove-list', function () {
        var userId = $(this).data('remove-id');
        $('#remove-item').on('click', function () {
            userListData = userListData.filter(function (item) {
                if(item.ms_user_id === userId) {
                    fetch('/users/' + item.ms_user_id, {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    })
                    .then(response => {
                        if (response.ok) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'User has been deleted.',
                                icon: 'success',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false,
                                stopKeydownPropagation: false,
                                showConfirmButton: true
                            }).then(function (result) {
                                if (result.value) {
                                    if ($.fn.DataTable.isDataTable('#userList-table')) {
                                        $('#userList-table').DataTable().destroy();
                                    };
                                    $("#removeItemModal").modal("hide");
                                    location.reload();
                                }
                            });
                        } else {
                            throw new Error('Something went wrong');
                        }
                    })
                    .catch(error => {
                        console.error('Edit request failed:', error);
                    });
                }
            });
        });
    });
}