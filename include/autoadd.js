<SCRIPT LANGUAGE=javascript>
<!--
function autoadd(strFieldName)
{
        total = document.form.total.value;
        if(isNaN(eval('document.form.' + strFieldName + '.value')))
        {
                var f=confirm("Please enter a valid number for all size fields");
                if(f==True)
                {
                        return true;
                }
                else
                {
                        return false;
                }
        }
        numEntered = document.form.subtotal.value;
        numEntered = numEntered - parseFloat(eval('document.form.discount.value'),10);
        tax = numEntered * .058;
	tax = tax.toFixed(2);
        document.forms[1].tax.value = tax;
	tax = parseFloat(tax);
	total = numEntered + tax;
	total = total.toFixed(2);
        document.forms[1].total.value = total;
	total = parseFloat(total);

        balance = numEntered + tax - document.form.tendered.value;
	balance = balance.toFixed(2);
        document.forms[1].invoice_balance.value = balance;
}
</script>
