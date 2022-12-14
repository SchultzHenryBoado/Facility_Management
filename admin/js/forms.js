$(document).ready(function () {
  $("form").submit(function (e) {
    var formData = {
      lastname: $("#lastName").val(),
      firstName: $("#firstName").val(),
      email: $("#email").val(),
      password: $("#password").val(),
    };

    $.ajax({
      type: "POST",
      url: "/facility_management/admin/php/create_users.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      $("form")
        .html('<div class="alert alert-success">Success!!</div>')
        .fail(function (data) {
          '<div class="alert alert-danger">Could not reach server, please try again later.</div>';
        });
    });

    e.preventDefault();
  });
});
