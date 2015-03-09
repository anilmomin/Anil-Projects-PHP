<script type="text/javascript">
$(document).ready(function(){
	jQuery("#grdNews").jqGrid({
	   	url:'<?php echo site_url( "admin/newsmanager/getnews/" );?>',
		datatype: "json",
		mtype : "post",
		colNames:['ids', 'News','Created Date'],
	   	colModel:[
			{name:'newsId',index:'newsId', width:180, hidden:true},
			{name:'news',index:'news', width:380, editable:true, edittype:"textarea", editoptions:{rows:"13",cols:"35"} },
	   		{name:'created_date',index:'created_date',sorttype:'date', width:280,align:"left"}
			
	   	],
	   	rowNum:10,
	   	rowList:[10,20,30],
	   	pager: jQuery('#pgrNews'),
	   	sortname: 'news',
	   	autowidth: true,
		rownumbers: true,
	   	height: "100%",
	    viewrecords: true,
	    sortorder: "desc",
	    jsonReader: { repeatitems : false, id: "0" },
	    editurl: "<?php echo site_url( "admin/newsmanager/actions/" );?>",
	    caption:"News"
	}).navGrid('#pgrNews',{edit:true,add:false,del:true,search:false});
	
});

</script>
<div>
   	<h1 class="formHead">
		Edit / Show / Delete News
    </h1>
</div>
<?php include 'sidenav.php'; ?>
<div class="grid">
	<table id="grdNews" cellpadding="0" cellspacing="0"></table>
	<div id="pgrNews" class="scroll" style="text-align: center;"></div>
</div>

<div class="cb"></div>
