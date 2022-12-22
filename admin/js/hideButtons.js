$(document).ready(function () {
  $("#acceptForm").on("submit", function (e) {
    $("#btnAccept").on("click", function () {
      $(this).remove();
    });

    // e.preventDefault();
  });
});
