<script type="text/javascript">
$(document).ready(function(){
	jQuery("#grdFeedback").jqGrid({
	   	url:'<?php echo site_url( "admin/feedbackmanager/getfeedback/" );?>',
		datatype: "json",
		mtype : "post",
		colNames:['ids', 'First Name', 'Last Name', 'Product Code', 'Est. Value', 'Quality', 'Style', 'Label', 'LabelInfo', 'Comments', 'Hear about Us', 'Opinion', 'Feedback Date'],
	   	colModel:[
			{name:'winefeedbackId',index:'winefeedbackId', width:1, hidden:true},
			{name:'firstname', index:'firstname',  width:100},
			{name:'lastname', index:'lastname',  width:100},
			{name:'productcode', index:'productcode',  width:100},
			{name:'estimateValue',index:'estimateValue', width:210,align:"left"},
	   		{name:'quality',index:'quality', width:100,align:"left"},
	   		{name:'style',index:'style', width:100,align:"left"},
	   		{name:'label',index:'label', width:100,align:"left"},	
	   		{name:'labelInfo',index:'labelInfo', width:140,align:"left"},
	   		{name:'comments',index:'comments', width:300,align:"left"},
	   		{name:'hearaboutus',index:'hearaboutus', width:300,align:"left"},
	   		{name:'opinion',index:'opinion', width:300,align:"left"},
	   		{name:'feedbackDate',index:'feedbackDate', width:280,align:"left"},
	   		
	   	],
	   	rowNum:10,
	   	rowList:[10,20,30],
	   	pager: jQuery('#pgrFeedback'),
	   	sortname: 'news',
	   	autowidth: true,
		rownumbers: true,
	   	height: "100%",
	    viewrecords: true,
	    sortorder: "desc",
	    jsonReader: { repeatitems : false, id: "0" },
	    //editurl: "<?php echo site_url( "admin/feedbackmanager/actions/" );?>",
	    caption:"Feedback"
	}).navGrid('#pgrFeedback',{edit:false,add:false,del:false,search:false});
	
});

</script>
<div>
   	<h1 class="formHead">
		Show Feedback
    </h1>
</div>
<?php //include 'sidenav.php'; ?>
<div >
	<table id="grdFeedback"></table>
	<div id="pgrFeedback" class="scroll" style="text-align: center;"></div>
</div>

<div class="cb"></div>
