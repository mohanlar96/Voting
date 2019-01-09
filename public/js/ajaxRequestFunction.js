function ajaxDatabaseUpdateRequest(url) {
    $.get(url, function(data, status) {
        if(status === "success") {
            if(data === "Success") {
                //double checking that the response is correct
                window.location.reload();
            } else if(data === "Malicious Attack") {
                alert("You can't Vote For Same Contestants Type Twice. This is consider malicious attempt. Please Don't Try Any Malicious Attempt.");
                window.location.reload();
            } else {
                alert('error while voting please wait for some minutes, refresh the page and try again!!!');
            }
        }

    });

}

function ajaxRequestToValidateNStore(ajaxRequestURI, data) {
    $.ajax({
        type: 'GET',
        url: 'ajaxQRCodeValidationRequest/' + data.id + "/" + data.qrCode,

        beforeSend: function() {
            $('.loading-message').removeClass('display-none');
        },

        //disable the loading animation
        complete: function() {
            $('.loading-message').addClass('display-none');
        },

        success: function(server_response) {
            //if the code is a valid one
            if(server_response.is_valid) {
                $('.qrcode-text').val('');
                $('.modal a.close').click();

                //get the name of the clicked contestant
                let userId = server_response.user_id,
                    contestantId = server_response.contestant_id,
                    contestantName = server_response.contestant_name,
                    contestantType = server_response.contestant_type,
                    url = ajaxRequestURI + '/ajaxDatabaseUpdateRequest/' + userId + '/' + contestantId;

                //if user confirm insert a new record in db
                if(confirm('Are You Sure You Want To Vote For ' + contestantType.toUpperCase() + ": " + contestantName)) {
                    ajaxDatabaseUpdateRequest(url);
                }

            } else {
                $('.qrcode-text').blur().val('');
                $('.form-group').addClass('has-error');
                $('.error-message').html('This QR Code is already used or May be you are just trying out with gibberish One!!!. Please Try With a Valid One.');
            }
        },

        error: function(xhr,status,error) {
            $('.error-message').html(error + " occur when trying to validate the input");
        }
    });
}
