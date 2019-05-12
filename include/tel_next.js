<script type="text/javascript">
function checkLen(x,y)
{
if (y.length==x.maxLength)
	{
		var next=x.tabIndex
		if (next<document.getElementById("custForm").length)
		{
			document.getElementById("custForm").elements[next].focus()
		}
	}
}
</script>

