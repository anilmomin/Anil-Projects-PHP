<script type="text/javascript">
$(document).ready(function(){
	jQuery("#grdWines").jqGrid({
	   	url:'<?php echo site_url( "admin/wines/getWines/" );?>',
		datatype: "json",
		mtype : "post",
		colNames:['ids', 'Wine Unique Code', 'Wine Brand', 'Vintage', 'Style', 'Description', 'Price', 'Winery', 'Region', 'Edit' ],
	   	colModel:[
			{name:'wineId',index:'wineId', hidden:true },   	
			{name:'wineUniqueId',index:'wineUniqueId', hidden:true },
			{name:'wineName',index:'wineName', width:380, editable:true },
			{name:'wineVintage',index:'wineVintage', align:"center", width:120, editable:true },
			{name:'wineStyle',index:'wineStyle', width:350, editable:true },
			{name:'wineDescription',index:'wineDescription', width:400, editable:true, edittype:"textarea", editoptions:{rows:"8",cols:"20"}},
			{name:'winePrice',index:'winePrice', width:150, align:"center", editable:true },
			{name:'wineryName',index:'wineryName', width:280, editable:true },
			{name:'regionName',index:'regionName', width:280, editable:true },
			{name:'act',index:'act', width:75, sortable:false}
			
	   	],
	   	rowNum:10,
	   	rowList:[10,20,30],
	   	pager: jQuery('#pgrWines'),
	   	sortname: 'ids',
	   	autowidth: true,
		rownumbers: true,
	   	height: "100%",
	    viewrecords: true,
	    multiselect: true,
	    editurl: '<?php echo site_url('/admin/wines/actions/') ?>',
	    sortorder: "desc",
	    gridComplete: function(){
			var ids = jQuery("#grdWines").jqGrid('getDataIDs');
			for(var i=0;i < ids.length;i++){
				var cl = ids[i];
				be = "<a href=\"<?php echo site_url('admin/wines/editwines'); ?>/"+cl+"\">Edit</a>"; 
				jQuery("#grdWines").jqGrid('setRowData',ids[i],{act:be});
			}	
		},
	    jsonReader: { repeatitems : false, id: "0" },
	    caption:"Wines"
	}).navGrid('#pgrWines',{edit:false,add:false,del:true,search:false});
	
});

</script>
<?php $pageheader = 'Wine Inventory';?>
			<div>
    	     <h1 class="formHead">
				<?php echo $pageheader; ?>
                </h1>
            </div>
			<?php include 'sidenav.php'; ?>
            
<div class="grid">
	<h1>
		Edit / Show / Delete Wines
    </h1>

	<table id="grdWines" cellpadding="0" cellspacing="0"></table>
	<div id="pgrWines" class="scroll" style="text-align: center;"></div>
</div>

<div class="cb"></div>
