var check = false;
    $(function(){
      $("#form").on('submit',function(e){
        e.preventDefault();
        var form_data = this;
        if (check) {
          $.ajax({
            url: $(form_data).attr('action'),
            method: $(form_data).attr('method'),
            data: new FormData(form_data),
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(Response) {
              console.log(Response['output']);
              if (Response['output'] == "User name already exist") {
                $("#error").text("Username is already existed");
                $("#error").css("color", "red");

              } else {
                $("#error").text("Form is submited successfully");
                $("#error").css("color", "green");

              }

              setTimeout(function() {
                $("#error").empty();
              }, 4000);
            },
            error: function(xhr, status, error) {
              $("#error").text("Form is failed :(");
              $("#error").css("color", "red");
              setTimeout(function() {
                $("#error").empty();
              }, 4000);
            },
          });
        } else {
          $("#error").css("color", "red");
          $("#error").text("Password confirmation is not correct");
          setTimeout(function() {
            $("#error").empty();
          }, 4000);
        }
      })
    });
    $('#BDS').click(function() {
      var date = new Date($('#dd').val());
      var day = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getFullYear();
      var data = {
        day: day,
        month: month,
        year: year,
        // CSRF: getCSRFTokenValue()
      };
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'http://127.0.0.1:8000/getAPIData',
        method: "POST",
        data: data,
        success: function(res) {
          alert(res['output']);
        }
      })
    })

    function resetForm() {
      window.location.href = "/en";
    }

    function recaptchaCallback() {
      $('#submitBtn').removeAttr('disabled');
      $("#captchaError").empty();
    };

    function passValidation(passConf) {
      var pass = $('#pass').val();
      if (pass != passConf) {
        $("#checkpass").text("password confirmation is not correct");
        check = false;
      } else {
        $("#checkpass").empty();
        check = true;
      }
    }
  //+ '&_token=' + "{{csrf_token()}}"