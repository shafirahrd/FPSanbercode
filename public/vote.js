function questionVote(id, value) {
    Swal.fire({
        title: 'Please wait',
        html: 'This takes few seconds',
        timerProgressBar: true,
        onBeforeOpen: () => {
            Swal.showLoading()
        }
    });
    $.ajax({
        type: "post",
        url: "/question/vote",
        data: {
            _token: $(this).data('token'),
            id: id,
            value: value
        },
        success: function(response) {
            if (!(response['msg'])) {
                window.location.replace("/login");
            } else {
                if (response['value']) {
                    Swal.fire({
                        title: 'Success!',
                        text: response['msg'],
                        icon: 'success',
                        confirmButtonText: 'ok'
                    })
                    $('i.fa-vote-yea#qv' + id).html(response['value']);
                } else {
                    Swal.fire({
                        title: 'Warning!',
                        text: response['msg'],
                        icon: 'warning',
                        confirmButtonText: 'ok'
                    })
                }
            }
        }
    });
}

function answerVote(id, value) {
    Swal.fire({
        title: 'Please wait',
        html: 'This takes few seconds',
        timerProgressBar: true,
        onBeforeOpen: () => {
            Swal.showLoading()
        }
    });
    $.ajax({
        type: "post",
        url: "/answer/vote/store",
        data: {
            _token: $(this).data('token'),
            id: id,
            value: value
        },
        success: function(response) {
            if (!(response['msg'])) {
                window.location.replace("/login");
            } else {
                if (response['value']) {
                    Swal.fire({
                        title: 'Success!',
                        text: response['msg'],
                        icon: 'success',
                        confirmButtonText: 'ok'
                    })
                    $('i.fa-vote-yea#av' + id).html(response['value']);
                } else {
                    Swal.fire({
                        title: 'Warning!',
                        text: response['msg'],
                        icon: 'warning',
                        confirmButtonText: 'ok'
                    })
                }
            }
        }
    });
}