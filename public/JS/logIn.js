$(function(){
    $("#form").on('submit',function(e){
        e.preventDefault();
        var form_data = this;
        $.ajax({
            url: $(form_data).attr('action'),
            method: $(form_data).attr('method'),
            data: new FormData(form_data),
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(response) {
                console.log(response['output']);
                if (response['output'] == "success") {
                    window.location.href = "http://127.0.0.1:8000/profile/en";
                } else $("#error").text(response['output']);
            },
            error: function(xhr, status, error) {
                $("#error").text("login failed");
            },
        });
    });
});