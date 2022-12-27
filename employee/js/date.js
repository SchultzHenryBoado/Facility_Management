var today = new Date();
var dd = String(today.getDate()).padStart(2, "0");
var mm = String(today.getMonth() + 1).padStart(2, "0");
var yyyy = today.getFullYear();

today = yyyy + "-" + mm + "-" + dd;

$("#dateFrom").attr("min", today);
$("#dateTo").attr("min", today);
$("#updateDateFrom").attr("min", today);
$("#updateDateFrom").attr("min", today);
