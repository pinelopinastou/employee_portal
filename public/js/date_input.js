//used in new_request form.
//does not allow date from value to be higher than date to value
//does not allow either value to be lower than today's date

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10){
  dd='0'+dd;
}

if(mm<10){
  mm='0'+mm;
} 

today = yyyy+'-'+mm+'-'+dd;

var tomorrow = new Date();
var tomday = tomorrow.getDate();
var tommonth = tomorrow.getMonth() + 1;
var tomyear = tomorrow.getFullYear();

if(tomday<10){tomday='0'+tomday} if(tommonth<10){tommonth='0'+tommonth} tomorrow = tommonth+'/'+tomday+'/'+tomyear;

$("#date_from").attr("min", today);
$("#date_to").attr("min", today);
$("#date_from").on('change', function(e) {
    $("#date_to").attr("min", $("#date_from").val());
});