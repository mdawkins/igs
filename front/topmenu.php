<script type="text/javascript">
function changesubmenu(item) {
var menu_front='front';
var menu_orders='orders';
var menu_edit='edit';
var menu_reports='reports';
   switch(item) {
   case menu_front :
     var submenu='<div class=title><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=cat&lsmain=cat">Categories<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=subcat&lsmain=subcat">Subcategories<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=product&lsmain=product">Products<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=botarea">Bottom Area<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=subject&lsmain=subject">Subjects<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=artist&lsmain=artist">Artist<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=uploadimage">Upload Images<\/a><\/div>';
      break;
   case menu_orders :
     var submenu='<div class=title><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=cust&lsmain=cust">Customers<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=pos&lsmain=prod_list">New Invoice<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=order">Search Orders<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=ship&lsmain=ship">Ship Rate<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=tax&lsmain=tax">Tax Rate<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=zip_code&lsmain=zip_code">Zip Code<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=order_info">Order Info<\/a><\/div>';
      break;
   case menu_edit :
     var submenu='<div class=title><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=file&file=about">About Us<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=file&file=contact">Contact Us<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=file&file=greeting">Greeting<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=file&file=instr">Intructions<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=file&file=policies">Policies<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=file&file=priv">Privite Policies<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=file&file=faq">FAQ<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=event&lsmain=event">Events<\/a><\/div>';
      break;
   case menu_reports :
     var submenu='<div class=title><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=list_report&list=year">Order Reports<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=spread&pp=1">Ordered Product<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=spread&pp=2">Searched Product<\/a><a class=lite_large style="padding: 0 10px 0 10px;" href="index.php?main=list_prodimages">Product Images<\/a><\/div>';
      break;
   default :
      var submenu='';
   }
   document.getElementById("submenu").innerHTML = submenu;
};
</script>

<div class=title>
	<a class=litemed style="padding: 0 10px 0 10px;" onmouseover="changesubmenu('front'); return false;">Frontpage</a>
	<a class=litemed style="padding: 0 10px 0 10px;" onmouseover="changesubmenu('orders'); return false;">Orders & Clients</a>
	<a class=litemed style="padding: 0 10px 0 10px;" onmouseover="changesubmenu('edit'); return false;">Edit Pages</a>
	<a class=litemed style="padding: 0 10px 0 10px;" onmouseover="changesubmenu('reports'); return false;">Reports</a>
</div>
<div id=submenu><div class=title>&nbsp;</div></div>
