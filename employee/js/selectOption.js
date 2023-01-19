$(document).ready(function () {
  $("#roomType").on('change', function() {
    var roomTypeId = $(this).val();

    if (roomTypeId) {
      $.ajax({
        type: 'POST',
        url: '../php/select_facility.php',
        data: 'room_type_id'+roomTypeId,
        success: function(html) {
          $('#roomNumber').html(html);
        }
      })
    } else {
      $("#roomNumber").html('<option value="">Select facility Type first</option>')
    }
  })
})