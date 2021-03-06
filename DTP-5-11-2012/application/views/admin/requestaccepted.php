<script type="text/javascript">
$(document).ready(function(){
	jQuery("#grid_name").jqGrid({
	   	url:'<?php
	   	echo site_url( "admin/wineusers/getAcceptedRequests/" );
	   	?>',
		datatype: "json",
		mtype : "post",
		colNames:['ids', 'First Name','Last Name', 'Email', 'Address', 'Request Date/Time'],
	   	colModel:[
			{name:'user_id',index:'user_id', width:1, hidden:true},
			{name:'first_name',index:'first_name', width:40},
	   		{name:'last_name',index:'last_name', width:60,align:"left"},
	   		{name:'email',index:'email', width:80,align:"left"},
	   		{name:'address',index:'address', width:250,align:"left"},
			{name:'created',index:'created',sorttype:'date', width:70,align:"left"}
			
			
	   	],
	   	rowNum:10,
	   	rowList:[10,20,30],
	   	pager: jQuery('#pager2'),
	   	sortname: 'username',
	   	autowidth: true,
		multiselect: true,
		rownumbers: true,
	   	height: "100%",
	    viewrecords: true,
	    sortorder: "desc",

	    jsonReader: { repeatitems : false, id: "0" },
	    caption:"Wine Dispatch List"
	}).navGrid('#pager2',{edit:false,add:false,del:false,search:false});
	
	jQuery("#dispatch").click( function() {
		
		items = jQuery("#grid_name").jqGrid('getGridParam','selarrrow');
		items = items.toString();
	
		if(!items) 
	   	{
			alert("Please select users to clear them from the list");
		}
		else
	   	{
			var intIndexOfMatch = items.indexOf( "," );
 			while (intIndexOfMatch != -1)
			{
				// Relace out the current instance.
				items = items.replace(',', '-' )
 
				// Get the index of any next matching substring.
				intIndexOfMatch = items.indexOf( ",");
			}
 
			
			var url = "<?php echo site_url('/admin/wineusers/clearlist') ?>" + '/' +  items;
			window.location=url;
		}
				
	});
	
	
});


</script>
<div class="grid">
<table id="grid_name" cellpadding="0" cellspacing="0"></table>
<div id="pager2" class="scroll" style="text-align: center;"></div>
<br/>
<a href="javascript:void(0)" style="font-size:18px" id="dispatch">Clear Accepted Request</a>
</div>

<div class="cb"></div>