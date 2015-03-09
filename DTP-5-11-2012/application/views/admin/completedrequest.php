<script type="text/javascript">
$(document).ready(function(){
	jQuery("#grid_name").jqGrid({
	   	url:'<?php
	   	echo site_url( "admin/wineusers/getClaimedRequest" );
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
		multiselect: false,
		rownumbers: true,
	   	height: "100%",
	    viewrecords: true,
	    sortorder: "desc",
	    jsonReader: { repeatitems : false, id: "0" },
	    caption:"All Completed Requests"
	}).navGrid('#pager2',{edit:false,add:false,del:false,search:false});
	
});


</script>

			
<div class="grid">
<table id="grid_name" cellpadding="0" cellspacing="0"></table>
<div id="pager2" class="scroll" style="text-align: center;"></div>
</div>

<div class="cb"></div>