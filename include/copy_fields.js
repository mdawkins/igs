<SCRIPT LANGUAGE="JavaScript">

<!-- Begin
var ship_fn = "";
var ship_ln = "";
var ship_mi = "";
var ship_addr1 = "";
var ship_addr2 = "";
var ship_city = "";
var ship_state = "";
var ship_zip1 = "";
var ship_zip2 = "";

function InitSaveVariables(form) {
ship_fn = form.ship_fn.value;
ship_ln = form.ship_ln.value;
ship_mi = form.ship_mi.value;
ship_addr1 = form.ship_addr1.value;
ship_addr2 = form.ship_addr2.value;
ship_city = form.ship_city.value;
ship_zip1 = form.ship_zip1.value;
ship_zip2 = form.ship_zip2.value;
ship_state = form.ship_state.value;
}

function copy_fields(form) {
if (form.ship_copy.checked) {
InitSaveVariables(form);
form.ship_fn.value = form.cust_fn.value;
form.ship_ln.value = form.cust_ln.value;
form.ship_mi.value = form.cust_mi.value;
form.ship_addr1.value = form.cust_addr1.value;
form.ship_addr2.value = form.cust_addr2.value;
form.ship_city.value = form.cust_city.value;
form.ship_zip1.value = form.cust_zip1.value;
form.ship_zip2.value = form.cust_zip2.value;
form.ship_state.value = form.cust_state.value;
}
else {
form.ship_fn.value = ship_fn;
form.ship_ln.value = ship_ln;
form.ship_mi.value = ship_mi;
form.ship_addr1.value = ship_addr1;
form.ship_addr2.value = ship_addr2;
form.ship_city.value = ship_city;
form.ship_zip1.value = ship_zip1;       
form.ship_zip2.value = ship_zip2;       
form.ship_state.value = ship_state;
   }
}
//  End -->
</script>
