<script type="text/javascript">
$(document).ready(function(){
	jQuery("#grdUsers").jqGrid({
	   	url:'<?php echo site_url( "admin/usermanagement/getUsers/" );?>',
		datatype: "json",
		mtype : "post",
		colNames:['ids','First Name', 'Last Name', 'Email', 'Address', 'DOB', 'Edit' ],
	   	colModel:[
			{name:'id',index:'id', hidden:true },   	
			{name:'first_name',index:'first_name', width:380, editable:true },
			{name:'last_name',index:'last_name', width:380, editable:true },
			{name:'email',index:'email', width:380, editable:true },
			{name:'address',index:'address', width:380, editable:true, edittype:"textarea", editoptions:{rows:"8",cols:"20"}},
			{name:'dob',index:'dob', width:380, editable:true },
			{name:'act',index:'act', width:75, sortable:false}
			
	   	],
	   	rowNum:10,
	   	rowList:[10,20,30],
	   	pager: jQuery('#pgrUsers'),
	   	sortname: 'news',
	   	autowidth: true,
		rownumbers: true,
	   	height: "100%",
	    viewrecords: true,
	    sortorder: "desc",
	    gridComplete: function(){
			var ids = jQuery("#grdUsers").jqGrid('getDataIDs');
			for(var i=0;i < ids.length;i++){
				var cl = ids[i];
				be = "<a href=\"<?php echo site_url('admin/auth/edituserbyadmin'); ?>/"+cl+"\">Edit</a>"; 
				jQuery("#grdUsers").jqGrid('setRowData',ids[i],{act:be});
			}	
		},
	    jsonReader: { repeatitems : false, id: "0" },
	    caption:"Users"
	}).navGrid('#pgrUsers',{edit:false,add:false,del:true,search:false});
	
});

</script>
<?php $pageheader = 'Site Users';?>
			<div>
    	     <h1 class="formHead">
				<?php echo $pageheader; ?>
                </h1>
            </div>
			<?php include 'sidenav.php'; ?>
<div class="grid">
	<h1>
		Edit / Show / Delete Users
    </h1>
	<table id="grdUsers" cellpadding="0" cellspacing="0"></table>
	<div id="pgrUsers" class="scroll" style="text-align: center;"></div>
</div>

<div class="cb"></div>
