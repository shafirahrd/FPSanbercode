function questionVote(id, value) {
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
                alert(response['msg']);
                if (response['value'])
                    $('i.fa-vote-yea#qv' + id).html(response['value']);
            }
        }
    });
}