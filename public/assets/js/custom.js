$(document).on('click', '.delete', function () {
    let url = $(this).data('url');
    let reload = $(this).data('reload');
    let tableId = '#' + $(this).data('table');
    let redirect = $(this).data('redirect');
    let message = $(this).data('message');
    deleteConfirmation(url, tableId, reload, redirect, message, $(this));
});
// function changeStatus(url, tableId, formData, message, inputField) {
//     var html = `<p> ` + message + ` </p>`;
//     if (formData.status == 'rejected') {
//         html += `<label class="col-form-label">
//                     Please, provide disapproval reason:
//                 </label>
//                 <textarea name="rejected_reason" id="rejection-reason" class="form-control" rows="3" required></textarea>`;
//     }
//     window.swal.fire({
//         title: 'Are you sure?',
//         text: message,
//         icon: 'warning',
//         html: html,
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: "Yes",
//         preConfirm: () => {
//             if (formData.status == 'rejected') {
//                 if (document.getElementById('rejection-reason').value) {
//                     // Handle return value
//                     formData['rejection_reason'] = document.getElementById('rejection-reason').value;
//                 } else {
//                     window.swal.showValidationMessage('Rejection reason is required')
//                 }
//             }
//         }
//     }).then((result) => {
//         let toggleStatus = inputField.is(':checked') ? false : true;
//         // if alert is confirmed
//         if (result.isConfirmed) {
//             // axios put method request here
//             window.axios.put(url, formData).then(response => {
//                 if (response.status === 200) {
//                     window.swal.close();
//                     $(tableId).DataTable().ajax.reload(null, false);

//                     // // Show toast message
//                     // Toast.fire({
//                     //     icon: 'success',
//                     //     title: response.data.message
//                     // });

//                     //show alert message
//                     alertMessage(response.data.message, 'success');
//                 }
//             }).catch(error => {
//                 inputField.prop('checked', toggleStatus);

//                 // Show toast message
//                 Toast.fire({
//                     icon: 'error',
//                     title: error.response.data.message
//                 });
//             });
//         }

//         // if alert is dismissed
//         if (result.isDismissed) {
//             inputField.prop('checked', toggleStatus);
//         }
//     });
// }
function deleteConfirmation(url, tableId, reload=false, redirect=false, message='You want to delete this record', _self) {

    window.swal.fire({
        title: 'Are you sure?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.value) {
            window.swal.fire({
                title: "",
                text: "Please wait...",
                showConfirmButton: false,
                backdrop: true
            });
            window.axios.delete(url).then(response => {
                if (response.status === 200) {
                    window.swal.close();
                    // Show toast message
                    Toast.fire({
                        icon: 'success',
                        title: response.data.message
                    });
                    if (reload == true) {
                        window.location.reload();
                    }

                    if (redirect) {
                        window.location.href = redirect;
                    }

                    $(tableId).DataTable().ajax.reload(null, false);

                    $(document).trigger(!_self.data('event') ? 'file.deleted' : _self.data('event'), [_self]);
                }
            }).catch(error => {
                window.swal.close();
                // Show toast message
                // Toast.fire({
                //     icon: 'error',
                //     title: error.response.data.message
                // });
                toastMessage(error.response.data.message, 'error');
            });
        }
    });
}

function toastMessage(message = '', status = '') {
    status = status=='' ? 'error' : status;

    if (message=='')
        message = status=='error' ? 'Something went wrong' : 'Success';

    Toast.fire({
        title: message,
        icon: status,
    });
}

$('body').on('click', '[data-act=ajax-modal]', function () {
    const _self = $(this);

    const content = $("#ajax_model_content");
    const spinner = $("#ajax_model_spinner");

    content.hide();
    spinner.show();

    $("#ajax_model").modal({backdrop: "static"});

    const modal_size = _self.attr('data-size')
    var type = _self.attr('data-type');
    var metaData = {};
    $(this).each(function () {
        $.each(this.attributes, function () {
            if (this.specified && this.name.match("^data-post-")) {
                var dataName = this.name.replace("data-post-", "");
                metaData[dataName] = this.value;
            }
        });
    });

    axios({
        method: _self.attr('data-method'),
        url: _self.attr('data-action-url'),
        data: metaData,
        params: {
            type: type ?? null
          }
          
    })
    .then(response => {
        spinner.hide();

        if (response.status === 200)
        {
            content.html(response.data).show();
            $('#ajax_model').modal('show');
            $("#ajax_model_title").text(_self.attr('data-title'));
            $('#ajax_model select').css('width', '100%');
            if(modal_size !=='') $('#ajax_model').addClass(modal_size);
            $('.form-select-modal').select2({
                width:'100%',
            });
            $(document).trigger('ajaxmodal.loaded');
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",

             });
             $('.form-select').select2({
                dropdownParent: $("#ajax_model")
             });
        }
        else toastMessage();
        // $('input.open-time-picker').timepicker({
        //     timeFormat: 'HH:mm:ss',
        // });
        // $('input.close-time-picker').timepicker({
        //     timeFormat: 'HH:mm:ss',
        // });
        // $('textarea:not(.without-summernote)').summernote({
        //     height: 200
        // });




    }).catch(error => {
        spinner.hide();
        //  toastMessage(error.response.data.message);
         toastMessage(error.response.data.message, 'error');
    });
});

$(document).on('ajaxmodal.loaded', function () {
    let _self = $(this);
    let ajaxmodal = $('#ajax_model');

    NioApp.BS.fileinput('.custom-file-input');
});

// $('body').on('submit', '[data-form=ajax-form]', function(e) {
//     e.preventDefault();
//     const form = this;
//     const confirm = $(form).data('confirm');

//     isProcessing = false;

//     if (confirm=='yes') {
//         window.swal.fire({
//             title: 'Are you sure?',
//             text: "Do you really want to submit this form?",
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: "Yes, do it!"
//         }).then((result) => {
//             if (result.value) sendAjaxForm(form);
//         });
//     } else {
//         sendAjaxForm(form);
//     }
// });

// function sendAjaxForm(form) {
//     const _self = $(form);
//     const btn = _self.find('[data-button=submit]');
//     const btnHtml = btn.html();
//     const modal = _self.data('modal');
//     const dt = _self.data('datatable');
//     const reload = _self.data('reload');
//     const redirect = _self.data('redirect');
//     const formReset = _self.data('form-reset');
//     const hideLeader = _self.data('hide');
//     const eventName = _self.data('event');

//     btn.attr('disabled', 'disabled');
//     btn.html(btnHtml + '&nbsp;&nbsp;<span class="spinner-border spinner-border-sm m-0"></span>');

//     isProcessing = true;

//     axios({
//         url: _self.attr('action'),
//         method: _self.attr('method'),
//         data: new FormData(_self[0]),
//     })
//     .then(response => {
//         if (response.status == 200) {
//             if (modal !== '') $(modal).modal('hide');
//             if (dt !== '') $(dt).DataTable().ajax.reload(null,false);

//             if (eventName && typeof response.data.data !== 'undefined') {
//                 $(document).trigger(eventName, [_self.attr('action'), response.data.data]);

//                 toastMessage(response.data.data.message, 'success');
//             } else {
//                 if (eventName) $(document).trigger(eventName, [_self.attr('action')]);
//                 toastMessage(response.data.message, 'success');
//             }

//             if (formReset==true)  _self.trigger('reset');

//             if (reload==true) window.location.reload();

//             if(hideLeader==true) {
//                 $('#add_entity_leadership').addClass('d-none');
//                 $('#entity_leadership_alert').addClass('d-none');
//             }
//             if (redirect) {
//                 window.location.href = redirect;
//             }
//         }

//         else toastMessage();
//     })
//     .catch(error => {
//         toastMessage(error.response.data.message);
//     })
//     .finally(response => {
//         btn.removeAttr('disabled');
//         btn.html(btnHtml);
//         isProcessing = false;
//     });
// }

// setting up toast
const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

// Logo Preview
$(document).on('click','.modal-logo', function(e) {
    $(this).siblings('.logo').click();
});

$(document).on('change','.logo', function(e) {
    var input = e.target;
    if (input.files && input.files[0]) {
    var file = input.files[0];

    var reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = function(e) {
        $('.modalCompanyLgo').attr('src', reader.result).addClass('hasImage');
        }
    }
});

$(document).on('click','#modal-logo', function(e) {
    $(this).siblings('#avatar').click();
});

$(document).on('change','#avatar', function(e) {

  var input = e.target;
    if (input.files && input.files[0]) {
    var file = input.files[0];

    var reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = function(e) {
        $('#modalAvatar').attr('src', reader.result).addClass('hasImage');
        }
    }
});

$(document).on('click','#modal-logo', function(e) {
    $(this).siblings('#avatar-edit').click();
});

$(document).on('change','#avatar-edit', function(e) {


    var input = e.target;
    if (input.files && input.files[0]) {
    var file = input.files[0];

    var reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = function(e) {
        $('#modalAvatarEdit').attr('src', reader.result).addClass('hasImage');
        }
    }
});

function initMap(mapDiv, searchInput, latitudeInput, longitudeInput, isEdit, addressValue,latitudeValue, longitudeValue) {
    var map = new google.maps.Map(document.getElementById(mapDiv), {
        center: {lat: 25.2192508, lng: 55.2821709},
        zoom: 12
    });
    var input = document.getElementById( searchInput);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.setComponentRestrictions({'country': 'AE'});
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29),
        draggable: true
    });
    if (isEdit && addressValue!='' && latitudeValue && longitudeValue) {
        document.getElementById(searchInput).value = addressValue;
        let lat = latitudeValue
        let lng = longitudeValue
        addMarkerOnMap(map, marker, infowindow, lat, lng,addressValue)
    }
    google.maps.event.addListener(marker, 'dragend', async function() {
        const geocoder = new google.maps.Geocoder();
        const pos = {
            lat: parseFloat(marker.getPosition().lat()),
            lng: parseFloat(marker.getPosition().lng()),
        };
        var address = await geocodePosition(pos, geocoder, marker, infowindow);
        document.getElementById( searchInput).value = address;
        document.getElementById(latitudeInput).value = marker.getPosition().lat();
        document.getElementById(longitudeInput).value = marker.getPosition().lng();
    })
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(18);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
        }

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
        document.getElementById(latitudeInput).value = place.geometry.location.lat();
        document.getElementById(longitudeInput).value = place.geometry.location.lng();

    });
}
async function geocodePosition(pos, geocoder, marker, infowindow) {
    var address = '';
    await new Promise((resolve, reject) => {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                address = responses[0].formatted_address;
                resolve(address);
            } else {
                address = 'Cannot determine address at this location.';
                reject(address);
            }
            infowindow.setContent('<div><strong>' + address + '</strong><br>' + address);
            infowindow.open(map, marker);
        });
    })
    return address;
}
function addMarkerOnMap (map, marker, infowindow, lat, lng, address) {
    marker.setPosition(new google.maps.LatLng(lat, lng));
    map.setZoom(18)
    map.panTo(marker.getPosition())
    infowindow.setContent('<div><strong>' + address + '</strong><br>' + address);
    infowindow.open(map, marker);
}


function changeStatus(url, tableId, formData, message, inputField) {
    var isHide = inputField.data('hide-alert');
    newStatus = formData.status ? 'activate':'deactivate';
    message = message ?? "You want to "+newStatus +" this record";
    var redirect = inputField.data('redirect');
    window.swal.fire({
        title: 'Are you sure?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes"
    }).then((result) => {
        let toggleStatus = inputField.is(':checked') ? false : true;
        // if alert is confirmed
        if (result.isConfirmed) {
            // axios put method request here
            window.axios.put(url, formData).then(response => {
                if (response.status === 200) {
                    window.swal.close();
                    $(tableId).DataTable().ajax.reload(null, false);

                    if(isHide==true) {
                        $('#add_entity_leadership').addClass('d-none');
                        $('#entity_leadership_alert').addClass('d-none');
                    } 
                    if(isHide==false){
                        $('#add_entity_leadership').removeClass('d-none');
                        $('#entity_leadership_alert').removeClass('d-none');
                    }
                    if(redirect !== undefined) window.location.href = redirect;
                    // Show toast message
                    Toast.fire({
                        icon: 'success',
                        title: response.data.message
                    });
                }
            }).catch(error => {
                inputField.prop('checked', toggleStatus);

                // Show toast message
                Toast.fire({
                    icon: 'error',
                    title: error.response.data.message
                });
            });
        }

        // if alert is dismissed
        if (result.isDismissed) {
            inputField.prop('checked', toggleStatus);
        }
    });
}

$(document).on('click', '.toggle-clicked', function (e) {
    _self = $(this);
    var data = {
        'status': _self.data('status')
        // 'reason': $('[name=rejected_reason]').val(),
    }
    let url = _self.data('url');
    let table = _self.data('table');
    const message = _self.data('message');

    changeStatus(url, table, data, message, _self);
});
function trackPrice(url, tableId, formData, message, inputField) {
    var isHide = inputField.data('hide-alert');
    newStatus = formData.status ? 'activate':'deactivate';
    message = message ?? "You want to "+newStatus +" this record";
    var redirect = inputField.data('redirect');
            // axios put method request here
            window.axios.put(url, formData).then(response => {
                if (response.status === 200) {
                    window.swal.close();
                    if(redirect !== undefined) window.location.href = redirect;
                    // Show toast message
                    Toast.fire({
                        icon: 'success',
                        title: response.data.message
                    });
                }
            }).catch(error => {
                // Show toast message
                Toast.fire({
                    icon: 'error',
                    title: error.response.data.message
                });
            });

}

$('body').on('submit', '[data-form=ajax-form]', function(e) {
    e.preventDefault();
    const form = this;
    const confirm = $(form).data('confirm');
    if (confirm == 'yes') {
        window.swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to submit this form?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, do it!"
        }).then((result) => {
            if (result.value) sendAjaxForm1(form);
        });
    } else {
        sendAjaxForm1(form);
    }
});

function sendAjaxForm1(form) {
    const _self = $(form);
    const btn = _self.find('[type=submit]');
    const btnHtml = btn.html();
    const modal = _self.data('modal');
    const dt = _self.data('datatable');
    const reload = _self.data('reload');
    const redirect = _self.data('redirect');
    btn.attr('disabled', 'disabled');
     btn.html(btnHtml + '&nbsp;&nbsp;<span><span class="spinner-border spinner-border-sm"></span></span>');

    axios({
            url: _self.attr('action'),
            method: _self.attr('method'),
            data: new FormData(_self[0]),
        })
        .then(response => {
            // showing success message
            toastMessage(response.data.message, 'success');
            if (modal !== '') $(modal).modal('hide');

            if (dt !== undefined) $(dt).DataTable().ajax.reload(null,false);

            if (reload==true) window.location.reload();
            if(redirect !== undefined) window.location.href= redirect;
            _self.trigger('reset');
            // Check if the attribute exists
            if (response.data.hasOwnProperty('redirect')) {
                    window.location.href = response.data.redirect;
            }
        })
        .catch(error => {
            console.log(error);
            if (error.response.status === 422) {
                if (error.response.data.hasOwnProperty('status_check')) {
                    $('input[name="_token"]').val('');
                    toastMessage(error.response.data.message);
                }
            else{
                handleErrors(error.response.data.errors);
            }
            } else {
                toastMessage(error.response.data.message);
            }
        })
        .finally(response => {
            btn.removeAttr('disabled');
            btn.html(btnHtml);
        });
}
// Show errors
const handleErrors = (errors) => {
    // Clear existing error messages
    $('.is-invalid').removeClass('is-invalid');
    $('.error-message').remove();
    
    for (const error in errors) {
        $(`[name^="${error}"]`).addClass('is-invalid').closest('.form-gap,.form-group').append(`<span class="error-message" style="color:red">` + errors[error][0] + `</span>`);
    }
}
window.handleErrors = handleErrors;
$('.language-item').on('click', function (e) {
            e.preventDefault();
    var locale = $(this).attr('data-code');
    $.ajax({
        url: "/set-locale/"+locale,
        method: "get",
        success: function(response) {
            if (response.status) {
                window.location.reload();
            }
        }
    });
});

$(document).on('click', '.change-status-clicked', function (e) {
    alert('main yaha ho ');
    _self = $(this);
    var data = {
        'status': _self.data('status')
        // 'reason': $('[name=rejected_reason]').val(),
    }
    let url = _self.data('url');
    let table = _self.data('table');
    const message = ""

    changeStatus(url, table, data, message, _self);
});

$(document).on('click', '#test-preview', function(e) {

    const _self = $('#notifications-form');
    data = new FormData(_self[0]);
    data.append('is_test', 1);
    data.append('type', 'notification');
    if(data.has('_method')){
        data.delete('_method');
    }
    axios({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: data,
        })
        .then(response => {
            if (response.status == 200) {
                toastMessage(response.data.message, 'success');
            } else toastMessage();
        })
        .catch(error => {
            toastMessage(error.response.data.message);
        })
        .finally(response => {
            // btn.removeAttr('disabled');
            // btn.html(btnHtml);
        });
});



isProcessing = false;

$(document).on('submit', '#bulk_import_form', function(e) {
    e.preventDefault();

    const _self = $(this);
    const btn = _self.find('button[type="submit"]');
    const btnHtml = btn.html();
    const modal = _self.data('modal');
    const dt = _self.data('datatable');

    btn.attr('disabled', 'disabled');
    btn.html('<span class="spinner-border spinner-border-sm m-0"></span>' + btnHtml);

    isProcessing = true;

    axios({
            url: _self.attr('action'),
            method: _self.attr('method'),
            data: new FormData(_self[0]),
        })
        .then(response => {
            if (response.status == 200) {
                if (modal !== '') $(modal).modal('hide');
                if (dt !== '') $(dt).DataTable().ajax.reload();

                toastMessage(response.data.message, 'success');
            } else toastMessage();
        })
        .catch(error => {
            toastMessage(error.response.data.message);
        })
        .finally(response => {
            btn.removeAttr('disabled');
            btn.html(btnHtml);
            isProcessing = false;
        });
});

$(document).on('click', '.close-modal', function() {
    if (!isProcessing) $('#ajax_model').modal('toggle');
});
$(document).on('click','.modal-close',function(){
    $('#ajax_model').modal('hide');
});
