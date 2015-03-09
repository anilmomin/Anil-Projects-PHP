<script type="text/javascript">
$(document).ready(function(){
	jQuery("#grdNews").jqGrid({
	   	url:'<?php echo site_url( "admin/newsletters/getnewsletters/" );?>',
		datatype: "json",
		mtype : "post",
		colNames:['ids', 'Heading', 'Newsletters', 'Created Date'],
	   	colModel:[
			{name:'newsletterId',index:'newsletterId', width:180, hidden:true},
			{name:'heading',index:'heading', width:180},
			{name:'newsltrtext',index:'newsltrtext', width:380, editable:true, edittype:"textarea", editoptions:{rows:"13",cols:"35"} },
	   		{name:'created_date',index:'created_date',sorttype:'date', width:280,align:"left"},
	   	],
	   	rowNum:10,
	   	rowList:[10,20,30],
	   	pager: jQuery('#pgrNews'),
	   	sortname: 'created_date',
	   	autowidth: true,
		rownumbers: true,
	   	height: "100%",
	    viewrecords: true,
	    sortorder: "desc",
	    gridComplete: function(){
			var ids = jQuery("#grdNews").jqGrid('getDataIDs');
			for(var i=0;i < ids.length;i++){
				var cl = ids[i];
				be = "<a href=\"<?php echo site_url('admin/auth/edituserbyadmin'); ?>/"+cl+"\">Edit</a>"; 
				jQuery("#grdUsers").jqGrid('setRowData',ids[i],{act:be});
			}	
		},
	    jsonReader: {repeatitems : false, id: "0"},
	    caption:"Newsletter"
	}).navGrid('#pgrNews',{edit:false,add:false,del:true,search:false});
	
});

</script>
<div>
   	<h1 class="formHead">
		Edit / Show / Delete Newsletter
    </h1>
</div>
<?php include 'sidenav.php'; ?>
<div class="grid">
	<table id="grdNews" cellpadding="0" cellspacing="0"></table>
	<div id="pgrNews" class="scroll" style="text-align: center;"></div>
</div>

<div class="cb"></div>
