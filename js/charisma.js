// -------------------------------------------------------------------
function invoice(inv,ord,ttl,print) {
 $.post("invoice_print.php",{
 	inv:inv,ord:ord,ttl:ttl
 },function(data){
 	if(!data){
 		window.location.reload();
 	}
 		$('.mr-modal-text').html(data);$('#add-mr-modal').modal('show');
 });
 if(print==1){
 	printInvoice();
 }
}
function new_invoice(){
	var inv_code=$('#hidden_invcode').val();
	var tbl=$('#hidden_tblname').val();
	ord_code=$('#hidden_ordcode').val();
	dlvr_date=$('#date01').val();
o_disc=$('#o_disc').val();
if ($('.cusrtm').val()=="") {
	$('.mr-modal-text').html("Please Select Customer");$('#add-mr-modal').modal('show');
	//$('.cusrtm').focus();
} else{
	customr=$('.cusrtm').val();
	//alert(customr);
	gtotal_t=$('.gtotal1').val();
	//alert(gtotal_t);
	if($('.net_pf').val()==0){
	gtotal_f=$('.gtotal1').val();	
	}
	else{
		gtotal_f=$('.net_pf').val();
	}
	//alert(gtotal_f);
	$.post("creat_inv.php",{
		inv_code:inv_code,
		ord_code:ord_code,
		dlvr_date:dlvr_date,
		customr:customr,
		gtotal_t:gtotal_t,
		gtotal_f:gtotal_f,
		o_disc:o_disc,
		tbl:tbl
	},function(data){
		if (data=="alldone") {
			window.location.href="view-invoice?inv="+inv_code;
		}
		else{
			$('.mr-modal-text').html(data);$('#add-mr-modal').modal('show');
		}
	});
	
};
}
$('#selectCategory').on('change',function(){
	if($(this).val()=='Company'){
		$('input[name="cust_cname"]').attr("required","required");
	}else{
		$('input[name="cust_cname"]').attr("required","").removeAttr('required');
	}
});
$('#date01').on("change",function(){
	var date=$(this).val().split("/");
	if(date[2]<Y){
		$(this).val(m+"/"+d+"/"+Y);
	}else if(date[0]<m){
		$(this).val(m+"/"+d+"/"+Y);
	}else if(date[1]<d){
		$(this).val(m+"/"+d+"/"+Y);
	}
});

$('#itm_qnty').keyup(function(){
	var maxstent=parseInt($('#itemDetails option:selected').attr("st"));
	if(parseInt($(this).val())>maxstent){
		$(this).val(maxstent);
	}
});
// --------------------------------------------------------------------------

function view_order (id) {
 // alert(id);
}
function dltit(pid) {
	//alert(pid);
	var pid=pid;
  var tblname=$('#hidden_tblname').val();
 // alert(tblname);
  ord_code=$('#hidden_ordcode').val(); 
  //alert(ord_code);
  $.post("dltit.php",{pid:pid,tblname:tblname},function(data){
  	$('#itmtr'+pid).remove();
  $.post("get_ord_total",{
	ord_code:ord_code
	},function(data){
		$('.gtotal, .gtotal1,.net_p,.net_pf').val(data);
	});
  });
 
}
function dltit2(pid) {
	var pid=pid;
  //var tblname=$('#hidden_tblname').val();
  ord_code=$('#hidden_ordcode').val(); 
  $.post("dltit2.php",{pid:pid,ord_code:ord_code},function(data){
  	var d= data.split("@");
  	if(d[0]==0){
  		$('#itmtr'+pid).remove();
		$('.gtotal, .gtotal1,.net_p,.net_pf').val(d[1]);
	}else{
		alert(d[1]);
	}
  });
 
}

function dlt_ord(ord_code) {
  $.post("dlt_ord.php",{ord_code:ord_code},function(data){
  	if(data==1){
  		window.location.href="order-view.php";
  	}
  	else{
  		$('#rslt').html(data);
  		//alert(data);
  	}
  });
}

$(document).ready(function(){
	$('#quantity').numeric();
	$('#costPrice').numeric();
	$('#sellingPrice').numeric();
	$('input[name="cust_mobile"]').numeric();
	$('.itm_qnty').numeric();
	$('#inv_itemqty').numeric();
	$('#inv_itemprice').numeric();
	$('#txt-discount').numeric();
	$('#txt-advancePayment').numeric();
	$('#txt-cust-contact').numeric();
	$('#o_disc').numeric();
	$('#rec_cash').numeric();
$('.full_fixed').hide();
$('#stockentry').submit(function(){
	var data3=$('#stockentry').serialize();
	$.post("upload_stock.php ", data3,function(data,success){
		$('.mr-modal-text').html(data);$('#add-mr-modal').modal('show');
		
		});
	return false;
});

$('#stockupdate').submit(function(){
	var data4=$('#stockupdate').serialize();
	$.post("update_stock.php ", data4,function(data,success){
		$('.mr-modal-text').html(data);
		$('#add-mr-modal').modal('show');
		
		});
	
	return false;
});


$('#e_itm').click(function(){
	if ($('#itemDetails').val()=="") {
		$('.mr-modal-text').html("Please Select a Product");$('#add-mr-modal').modal('show');
	} else if($('.itm_qnty').val()==""){
		$('.mr-modal-text').html("Please Enter Quantity");$('#add-mr-modal').modal('show');
	}else{
		var itemcode=$('#itemDetails').val();
		 var itm_quantity=$('.itm_qnty').val();
		 ord_code=$('#hidden_ordcode').val();
		$.post("get_price_edit.php",{
	 	itemcode:itemcode,
	 	itm_quantity:itm_quantity,
	 	ord_code:ord_code,
	 },function(data){ 
	$('.itms_appender').append(data);
	$('.itm_qnty').val("");
	$('#itemDetails option[value=""]').prop("selected","selected");
	$.post("get_ord_total.php",{
	ord_code:ord_code
	},function(data){
		$('.gtotal, .gtotal1,.net_p,.net_pf').val(data);
	});
	 });
	}
	 
	 return false;
});


$('#add_cat_form').submit(function(){
	
	var data2=$('#add_cat_form').serialize();
	//alert(data3);
	$.post("add_cat.php ", data2,function(data,success){$('#addCategory').modal('hide');
	if(data!=""){
		//alert(data);
		$.post("get_cat.php",{ },function(data,success){
			
			location.reload();
		});
	}else{
		$('.mr-modal-text').html(data);$('#add-mr-modal').modal('show');
	}
	});
	return false;
});





$('#global_form').submit(function(){
	$.post("save_global.php",$('#global_form').serialize(),function(data){
		if (data==1) {
		window.location.href = "index.php";	
		} else{
			//call($button, $noty);
			$('.mr-modal-text').html(data);$('#add-mr-modal').modal('show');
		};
	});
	
	return false;
});

$('#cust_addform').submit(function(){
	// alert($('#cust_addform').serialize());
	$.post("save_cust.php",$('#cust_addform').serialize(),function(data){
		$.post("get_new_cid.php",{
			ping:1
		},function(data){
			$('#cust_code').html(data);
		});
	$('.mr-modal-text').html(data);$('#add-mr-modal').modal('show');
	$('#cust_addform')[0].reset();
	$.post('get_all',{what:'cust'},function(data){
		var c=$.parseJSON(data);
		var out='<option>..Select Customer..</option>';
		for(var i=0,j=c.length; i<j; i++){
		  out+='<option value="'+c[i].mob+'">'+c[i].name+'</option>';
		};
		console.log(out);
		$('#cust_name').html(out);
		$('*').modal('hide');
	});
	});
	return false;
});

//--------------------UPDATE CUSTOMER FORM-----------------
$('#cust_updateform').submit(function(){
    var data5=$('#cust_updateform').serialize();
	$.post("update_cust.php ", data5,function(data,success){
		$('.mr-modal-text').html(data);
		$('#add-mr-modal').modal('show');
		});
	//window.location.href ="stock-view.php";
	return false;
});
// -----------------------------------------------------------------------
$('#o_itm').click(function(){
	$('#ajax_order').css("display","block");
	if ($('#itemDetails').val()=="") {
		$('.mr-modal-text').html("Please Select a Product");$('#add-mr-modal').modal('show');
		$('#ajax_order').css("display","none");
	} else if($('.itm_qnty').val()==""){
		$('.mr-modal-text').html("Please Enter Quantity");$('#add-mr-modal').modal('show');
		$('#ajax_order').css("display","none");
	}else{
		var itemcode=$('#itemDetails').val();
		 var itm_quantity=$('.itm_qnty').val();
		 ord_code=$('#hidden_ordcode').val();
		 // $('.full_fixed').show();
		$.post("get_price.php",{
	 	itemcode:itemcode,
	 	itm_quantity:itm_quantity,
	 	ord_code:ord_code
	 },function(data){ 
	 	// $('.full_fixed').hide();	
	$('.itms_appender').append(data);
	$('.itm_qnty').val("");
	$('#itemDetails option[value=""]').prop("selected","selected");
	$('#ajax_order').css("display","none");
	$.post("get_ord_total",{
		ord_code:ord_code
	},function(data){
		$('.gtotal,.gtotal1,.net_p,.net_pf').val(data);
	});
	 });
	}
	 
	 return false;
});
$('#itemDetails').on("change",function(){
	var instock=$('#itemDetails option:selected').attr("st");
	$('#stock_count').html("<br/ >In Stock :"+instock);
	$("#itm_qnty").val("");
});

$('#o_item').click(function(){
	if ($('#itemDetails').val()=="") {
		$('.mr-modal-text').html("Please Select a Product");$('#add-mr-modal').modal('show');
	} else if($('.itm_qnty').val()==""){
		
		$('.mr-modal-text').html("Please Enter Quantity");$('#add-mr-modal').modal('show');
	}else{
		var itemcode=$('#itemDetails').val();
		 var itm_quantity=$('.itm_qnty').val();
		 ord_code=$('#hidden_ordcode').val();
		 // $('.full_fixed').show();
		$.post("get_price_exord.php",{
	 	itemcode:itemcode,
	 	itm_quantity:itm_quantity,
	 	ord_code:ord_code
	 },function(data){ 
	 	// $('.full_fixed').hide();	
	$('.itms_appender').append(data);
	$('.itm_qnty').val("");
	$('#itemDetails option[value=""]').prop("selected","selected");
	$.post("get_ord_total.php",{
	ord_code:ord_code
	},function(data){
		$('.gtotal, .gtotal1,.net_p,.net_pf').val(data);
	});
	 });
	}
	 return false;
});


$('.truncate_tempo').click(function(){
	ord_code=$('#hidden_ordcode').val();
	$.post("truncate.php",{
		ord_code:ord_code
	},function(data){
		window.location.href ="order-add.php";
	});
});
$('.taxi').keyup(function(){
	taxi=$(this).val();
	gtotal=$('.gtotal').val();
	net=taxi/100*gtotal;
	net_p=gtotal-net;
	$('.net_p,.net_pf').val(net_p);
});
$('.place_order').click(function(){
ord_code=$('#hidden_ordcode').val();
dlvr_date=$('#date01').val();
o_disc=$('#o_disc').val();
if ($('.cusrtm').val()=="") {
	$('.mr-modal-text').html("Please Select Customer");$('#add-mr-modal').modal('show');
	//$('.cusrtm').focus();
} else{
	customr=$('.cusrtm').val();
	//alert(customr);
	gtotal_t=$('.gtotal1').val();
	//alert(gtotal_t);
	if($('.net_pf').val()==0){
	gtotal_f=$('.gtotal1').val();	
	}
	else{
		gtotal_f=$('.net_pf').val();
	}
	//alert(gtotal_f);
	$.post("place_order.php",{
		ord_code:ord_code,
		dlvr_date:dlvr_date,
		customr:customr,
		gtotal_t:gtotal_t,
		gtotal_f:gtotal_f,
		o_disc:o_disc
	},function(data){
		if (data=="alldone") {
			window.location.href="view-order?order="+ord_code;
		}
		else{
			$('.mr-modal-text').html(data);$('#add-mr-modal').modal('show');
		}
	});
	
};
// return false;
});


//-----------------------------------------------------------------------------

$('#inv_itm').click(function(){
	$('#ajax_order_inv').css("display","block");
	if ($('#itemDetails').val()=="") {
		$('.mr-modal-text').html("Please Select a Product");$('#add-mr-modal').modal('show');
		$('#ajax_order_inv').css("display","none");
	} else if($('.itm_qnty').val()==""){
		$('#ajax_order_inv').css("display","none");
		$('.mr-modal-text').html("Please Enter Quantity");$('#add-mr-modal').modal('show');
	}else{
		var itemcode=$('#itemDetails').val();
		 var itm_quantity=$('.itm_qnty').val();
		 var inv_code=$('#hidden_invcode').val();
		 var ord_code=$('#hidden_ordcode').val();
		 var tbl=$('#hidden_tblname').val();
		 //alert(inv_code);
		 // $('.full_fixed').show();
		$.post("get_price_inv.php",{
	 	itemcode:itemcode,
	 	itm_quantity:itm_quantity,
	 	inv_code:inv_code,
	 	ord_code:ord_code,
	 	tbl:tbl
	 },function(data){ 
		$('.itms_appender').append(data);
		$('.itm_qnty').val("");
		$('#itemDetails').val("");
		$.post("get_inv_total",{
			inv_code:inv_code,
			tbl:tbl
		},function(data){
			$('.gtotal, .gtotal1').val(data);
			$('#ajax_order_inv').css("display","none");
		});
	 });
	}
	 return false;
});

//---------------------Add user---------------------------------
$('#usr_addform').submit(function(){
	var data_usr=$('#usr_addform').serialize();
	$.post("save_user.php ", data_usr,function(data,success){
		$('.mr-modal-text').html(data);$('#add-mr-modal').modal('show');
		});
	
	//window.location.href ="stock-entry.php";
	return false;
});
// ---------------------------------------------------------------------------------
$('#rec_cash').blur(function(){
	var old_balance=$('#old_balance').val();
	var rec_cash=$('#rec_cash').val();

	if(Number(rec_cash)>Number(old_balance)) {
	$("#rec_cash").val(old_balance);
	$("#balanceamt").val('0');
	return;
	}
	
	var newbalance=old_balance-rec_cash;
	$("#balanceamt").val(newbalance);
});

//-----------------------------------------------------------------------------
$('.click_fill_cust').change(function(){
	var fullcust=$('.click_fill_cust').val();
	var custarry=fullcust.split("/");
	$('#txt-cust-name').val($.trim(custarry[0]));
	$('#txt-cust-contact').val($.trim(custarry[1]));
});
//-----------------------------------------------------------------------------
$('.instantStock').change(function(){
	var itemName=$('.instantStock option:selected').text() + "/" + $('.instantStock').val();
	var itemPrice=$('.instantStock option:selected').attr("pr");
	var itemStockQty=$('.instantStock option:selected').attr("st");
	$('#inv_itemname').val($.trim(itemName));
	$('#inv_itemname').attr('readonly',true);
	$('#inv_itemprice').val($.trim(itemPrice));
	$('#inv_itemprice').attr('readonly',true);
	$('#inv_itemqty').attr("placeholder", "Available in Stock " + itemStockQty);
});
$('#inv_itemqty').keyup(function(){
	var maxstent=parseInt($('.instantStock option:selected').attr("st"));
	if(parseInt($(this).val())>maxstent){
		$(this).val(maxstent);
	}
});

$('#rpt-enddate').change(function(){
	var startdate=$('#rpt-startdate').val();
	var enddate=$('#rpt-enddate').val();
	
	if(startdate>enddate){
		$('#rpt-errmsg').text("Start date should be less than end date").fadeOut(4000, function() { $(this).remove(); });
		$('#rpt-enddate').val("");		
		return false;
	}
});

$('#rpt-startdate').change(function(){
	var startdate=$('#rpt-startdate').val();
	var enddate=$('#rpt-enddate').val();
	if(!enddate.trim()){
		return;
	}
	
	if(startdate>enddate){
		$('#rpt-errmsg').text("Start date should be less than end date").fadeOut(4000, function() { $(this).remove(); });
		$('#rpt-enddate').val("");		
		return false;
	}
});


	//themes, change CSS with JS   echo $_SESSION['or_total'];
	//default theme(CSS) is cerulean, change it if needed
	var current_theme = $.cookie('current_theme')==null ? 'cerulean' :$.cookie('current_theme');
	switch_theme(current_theme);
	
	$('#themes a[data-value="'+current_theme+'"]').find('i').addClass('icon-ok');
				 
	$('#themes a').click(function(e){
		e.preventDefault();
		current_theme=$(this).attr('data-value');
		$.cookie('current_theme',current_theme,{expires:365});
		switch_theme(current_theme);
		$('#themes i').removeClass('icon-ok');
		$(this).find('i').addClass('icon-ok');
	});
	
	
	function switch_theme(theme_name)
	{
		$('#bs-css').attr('href','css/bootstrap-'+theme_name+'.css');
	}
	
	//ajax menu checkbox
	$('#is-ajax').click(function(e){
		$.cookie('is-ajax',$(this).prop('checked'),{expires:365});
	});
	$('#is-ajax').prop('checked',$.cookie('is-ajax')==='true' ? true : false);
	
	//disbaling some functions for Internet Explorer
	if($.browser.msie)
	{
		$('#is-ajax').prop('checked',false);
		$('#for-is-ajax').hide();
		$('#toggle-fullscreen').hide();
		$('.login-box').find('.input-large').removeClass('span10');
		
	}
	
	
	//highlight current / active link
	$('ul.main-menu li a').each(function(){
		if($($(this))[0].href==String(window.location))
			$(this).parent().addClass('active');
	});
	
	//establish history variables
	var
		History = window.History, // Note: We are using a capital H instead of a lower h
		State = History.getState(),
		$log = $('#log');

	//bind to State Change
	History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
		var State = History.getState(); // Note: We are using History.getState() instead of event.state
		$.ajax({
			url:State.url,
			success:function(msg){
				$('#content').html($(msg).find('#content').html());
				$('#loading').remove();
				$('#content').fadeIn();
				var newTitle = $(msg).filter('title').text();
				$('title').text(newTitle);
				docReady();
			}
		});
	});
	
	//ajaxify menus
	$('a.ajax-link').click(function(e){
		if($.browser.msie) e.which=1;
		if(e.which!=1 || !$('#is-ajax').prop('checked') || $(this).parent().hasClass('active')) return;
		e.preventDefault();
		if($('.btn-navbar').is(':visible'))
		{
			$('.btn-navbar').click();
		}
		$('#loading').remove();
		$('#content').fadeOut().parent().append('<div id="loading" class="center">Loading...<div class="center"></div></div>');
		var $clink=$(this);
		History.pushState(null, null, $clink.attr('href'));
		$('ul.main-menu li.active').removeClass('active');
		$clink.parent('li').addClass('active');	
	});
	
	//animating menus on hover
	$('ul.main-menu li:not(.nav-header)').hover(function(){
		$(this).animate({'margin-left':'+=5'},300);
	},
	function(){
		$(this).animate({'margin-left':'-=5'},300);
	});
	
	//other things to do on document ready, seperated for ajax calls
	docReady();
});
		
		
function docReady(){
	//prevent # links from moving to top
	$('a[href="#"][data-top!=true]').click(function(e){
		e.preventDefault();
	});
	
	//rich text editor
	$('.cleditor').cleditor();
	
	//datepicker
	$('.datepicker').datepicker();
	
	//notifications
	$('.noty').click(function(e){
		e.preventDefault();
		var options = $.parseJSON($(this).attr('data-noty-options'));
		noty(options);
	});


	//uniform - styler for checkbox, radio and file input
	$("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();

	//chosen - improves select
	$('[data-rel="chosen"],[rel="chosen"]').chosen();

	//tabs
	$('#myTab a:first').tab('show');
	$('#myTab a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	});

	//makes elements soratble, elements that sort need to have id attribute to save the result
	$('.sortable').sortable({
		revert:true,
		cancel:'.btn,.box-content,.nav-header',
		update:function(event,ui){
			//line below gives the ids of elements, you can make ajax call here to save it to the database
			//console.log($(this).sortable('toArray'));
		}
	});

	//slider
	$('.slider').slider({range:true,values:[10,65]});

	//tooltip
	$('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement":"bottom",delay: { show: 400, hide: 200 }});

	//auto grow textarea
	$('textarea.autogrow').autogrow();

	//popover
	$('[rel="popover"],[data-rel="popover"]').popover();

	//file manager
	var elf = $('.file-manager').elfinder({
		url : 'misc/elfinder-connector/connector.php'  // connector URL (REQUIRED)
	}).elfinder('instance');

	//iOS / iPhone style toggle switch
	$('.iphone-toggle').iphoneStyle();

	//star rating
	$('.raty').raty({
		score : 4 //default stars
	});

	//uploadify - multiple uploads
	$('#file_upload').uploadify({
		'swf'      : 'misc/uploadify.swf',
		'uploader' : 'misc/uploadify.php'
		// Put your options here
	});

	//gallery controlls container animation
	$('ul.gallery li').hover(function(){
		$('img',this).fadeToggle(1000);
		$(this).find('.gallery-controls').remove();
		$(this).append('<div class="well gallery-controls">'+
							'<p><a href="#" class="gallery-edit btn"><i class="icon-edit"></i></a> <a href="#" class="gallery-delete btn"><i class="icon-remove"></i></a></p>'+
						'</div>');
		$(this).find('.gallery-controls').stop().animate({'margin-top':'-1'},400,'easeInQuint');
	},function(){
		$('img',this).fadeToggle(1000);
		$(this).find('.gallery-controls').stop().animate({'margin-top':'-30'},200,'easeInQuint',function(){
				$(this).remove();
		});
	});


	//gallery image controls example
	//gallery delete
	$('.thumbnails').on('click','.gallery-delete',function(e){
		e.preventDefault();
		//get image id
		//alert($(this).parents('.thumbnail').attr('id'));
		$(this).parents('.thumbnail').fadeOut();
	});
	//gallery edit
	$('.thumbnails').on('click','.gallery-edit',function(e){
		e.preventDefault();
		//get image id
		//alert($(this).parents('.thumbnail').attr('id'));
	});

	//gallery colorbox
	$('.thumbnail a').colorbox({rel:'thumbnail a', transition:"elastic", maxWidth:"95%", maxHeight:"95%"});

	//gallery fullscreen
	$('#toggle-fullscreen').button().click(function () {
		var button = $(this), root = document.documentElement;
		if (!button.hasClass('active')) {
			$('#thumbnails').addClass('modal-fullscreen');
			if (root.webkitRequestFullScreen) {
				root.webkitRequestFullScreen(
					window.Element.ALLOW_KEYBOARD_INPUT
				);
			} else if (root.mozRequestFullScreen) {
				root.mozRequestFullScreen();
			}
		} else {
			$('#thumbnails').removeClass('modal-fullscreen');
			(document.webkitCancelFullScreen ||
				document.mozCancelFullScreen ||
				$.noop).apply(document);
		}
	});

	//tour
	if($('.tour').length && typeof(tour)=='undefined')
	{
		var tour = new Tour();
		tour.addStep({
			element: ".span10:first", /* html element next to which the step popover should be shown */
			placement: "top",
			title: "Custom Tour", /* title of the popover */
			content: "You can create tour like this. Click Next." /* content of the popover */
		});
		tour.addStep({
			element: ".theme-container",
			placement: "left",
			title: "Themes",
			content: "You change your theme from here."
		});
		tour.addStep({
			element: "ul.main-menu a:first",
			title: "Dashboard",
			content: "This is your dashboard from here you will find highlights."
		});
		tour.addStep({
			element: "#for-is-ajax",
			title: "Ajax",
			content: "You can change if pages load with Ajax or not."
		});
		tour.addStep({
			element: ".top-nav a:first",
			placement: "bottom",
			title: "Visit Site",
			content: "Visit your front end from here."
		});
		
		tour.restart();
	}

	//datatable
	$('.datatable').dataTable({
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
			}
		} );
	$('.btn-close').click(function(e){
		e.preventDefault();
		$(this).parent().parent().parent().fadeOut();
	});
	$('.btn-minimize').click(function(e){
		e.preventDefault();
		var $target = $(this).parent().parent().next('.box-content');
		if($target.is(':visible')) $('i',$(this)).removeClass('icon-chevron-up').addClass('icon-chevron-down');
		else 					   $('i',$(this)).removeClass('icon-chevron-down').addClass('icon-chevron-up');
		$target.slideToggle();
	});
	$('.btn-setting').click(function(e){
		e.preventDefault();
		$('#myModal').modal('show');
	});
		
	//initialize the external events for calender

	$('#external-events div.external-event').each(function() {

		// it doesn't need to have a start or end
		var eventObject = {
			title: $.trim($(this).text()) // use the element's text as the event title
		};
		
		// store the Event Object in the DOM element so we can get to it later
		$(this).data('eventObject', eventObject);
		
		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
		
	});


	//initialize the calendar
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar !!!
		drop: function(date, allDay) { // this function is called when something is dropped
		
			// retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			
			// assign it the date that was reported
			copiedEventObject.start = date;
			copiedEventObject.allDay = allDay;
			
			// render the event on the calendar
			// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
			
		}
	});
	
	
	//chart with points
	if($("#sincos").length)
	{
		var sin = [], cos = [];

		for (var i = 0; i < 14; i += 0.5) {
			sin.push([i, Math.sin(i)/i]);
			cos.push([i, Math.cos(i)]);
		}

		var plot = $.plot($("#sincos"),
			   [ { data: sin, label: "sin(x)/x"}, { data: cos, label: "cos(x)" } ], {
				   series: {
					   lines: { show: true  },
					   points: { show: true }
				   },
				   grid: { hoverable: true, clickable: true, backgroundColor: { colors: ["#fff", "#eee"] } },
				   yaxis: { min: -1.2, max: 1.2 },
				   colors: ["#539F2E", "#3C67A5"]
				 });

		function showTooltip(x, y, contents) {
			$('<div id="tooltip">' + contents + '</div>').css( {
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 5,
				border: '1px solid #fdd',
				padding: '2px',
				'background-color': '#dfeffc',
				opacity: 0.80
			}).appendTo("body").fadeIn(200);
		}

		var previousPoint = null;
		$("#sincos").bind("plothover", function (event, pos, item) {
			$("#x").text(pos.x.toFixed(2));
			$("#y").text(pos.y.toFixed(2));

				if (item) {
					if (previousPoint != item.dataIndex) {
						previousPoint = item.dataIndex;

						$("#tooltip").remove();
						var x = item.datapoint[0].toFixed(2),
							y = item.datapoint[1].toFixed(2);

						showTooltip(item.pageX, item.pageY,
									item.series.label + " of " + x + " = " + y);
					}
				}
				else {
					$("#tooltip").remove();
					previousPoint = null;
				}
		});
		


		$("#sincos").bind("plotclick", function (event, pos, item) {
			if (item) {
				$("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
				plot.highlight(item.series, item.datapoint);
			}
		});
	}
	
	//flot chart
	if($("#flotchart").length)
	{
		var d1 = [];
		for (var i = 0; i < Math.PI * 2; i += 0.25)
			d1.push([i, Math.sin(i)]);
		
		var d2 = [];
		for (var i = 0; i < Math.PI * 2; i += 0.25)
			d2.push([i, Math.cos(i)]);

		var d3 = [];
		for (var i = 0; i < Math.PI * 2; i += 0.1)
			d3.push([i, Math.tan(i)]);
		
		$.plot($("#flotchart"), [
			{ label: "sin(x)",  data: d1},
			{ label: "cos(x)",  data: d2},
			{ label: "tan(x)",  data: d3}
		], {
			series: {
				lines: { show: true },
				points: { show: true }
			},
			xaxis: {
				ticks: [0, [Math.PI/2, "\u03c0/2"], [Math.PI, "\u03c0"], [Math.PI * 3/2, "3\u03c0/2"], [Math.PI * 2, "2\u03c0"]]
			},
			yaxis: {
				ticks: 10,
				min: -2,
				max: 2
			},
			grid: {
				backgroundColor: { colors: ["#fff", "#eee"] }
			}
		});
	}
	
	//stack chart
	if($("#stackchart").length)
	{
		var d1 = [];
		for (var i = 0; i <= 10; i += 1)
		d1.push([i, parseInt(Math.random() * 30)]);

		var d2 = [];
		for (var i = 0; i <= 10; i += 1)
			d2.push([i, parseInt(Math.random() * 30)]);

		var d3 = [];
		for (var i = 0; i <= 10; i += 1)
			d3.push([i, parseInt(Math.random() * 30)]);

		var stack = 0, bars = true, lines = false, steps = false;

		function plotWithOptions() {
			$.plot($("#stackchart"), [ d1, d2, d3 ], {
				series: {
					stack: stack,
					lines: { show: lines, fill: true, steps: steps },
					bars: { show: bars, barWidth: 0.6 }
				}
			});
		}

		plotWithOptions();

		$(".stackControls input").click(function (e) {
			e.preventDefault();
			stack = $(this).val() == "With stacking" ? true : null;
			plotWithOptions();
		});
		$(".graphControls input").click(function (e) {
			e.preventDefault();
			bars = $(this).val().indexOf("Bars") != -1;
			lines = $(this).val().indexOf("Lines") != -1;
			steps = $(this).val().indexOf("steps") != -1;
			plotWithOptions();
		});
	}

	//pie chart
	var data = [
	{ label: "Internet Explorer",  data: 12},
	{ label: "Mobile",  data: 27},
	{ label: "Safari",  data: 85},
	{ label: "Opera",  data: 64},
	{ label: "Firefox",  data: 90},
	{ label: "Chrome",  data: 112}
	];
	
	if($("#piechart").length)
	{
		$.plot($("#piechart"), data,
		{
			series: {
					pie: {
							show: true
					}
			},
			grid: {
					hoverable: true,
					clickable: true
			},
			legend: {
				show: false
			}
		});
		
		function pieHover(event, pos, obj)
		{
			if (!obj)
					return;
			percent = parseFloat(obj.series.percent).toFixed(2);
			$("#hover").html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
		}
		$("#piechart").bind("plothover", pieHover);
	}
	
	//donut chart
	if($("#donutchart").length)
	{
		$.plot($("#donutchart"), data,
		{
				series: {
						pie: {
								innerRadius: 0.5,
								show: true
						}
				},
				legend: {
					show: false
				}
		});
	}




	 // we use an inline data source in the example, usually data would
	// be fetched from a server
	var data = [], totalPoints = 300;
	function getRandomData() {
		if (data.length > 0)
			data = data.slice(1);

		// do a random walk
		while (data.length < totalPoints) {
			var prev = data.length > 0 ? data[data.length - 1] : 50;
			var y = prev + Math.random() * 10 - 5;
			if (y < 0)
				y = 0;
			if (y > 100)
				y = 100;
			data.push(y);
		}

		// zip the generated y values with the x values
		var res = [];
		for (var i = 0; i < data.length; ++i)
			res.push([i, data[i]])
		return res;
	}

	// setup control widget
	var updateInterval = 30;
	$("#updateInterval").val(updateInterval).change(function () {
		var v = $(this).val();
		if (v && !isNaN(+v)) {
			updateInterval = +v;
			if (updateInterval < 1)
				updateInterval = 1;
			if (updateInterval > 2000)
				updateInterval = 2000;
			$(this).val("" + updateInterval);
		}
	});

	//realtime chart
	if($("#realtimechart").length)
	{
		var options = {
			series: { shadowSize: 1 }, // drawing is faster without shadows
			yaxis: { min: 0, max: 100 },
			xaxis: { show: false }
		};
		var plot = $.plot($("#realtimechart"), [ getRandomData() ], options);
		function update() {
			plot.setData([ getRandomData() ]);
			// since the axes don't change, we don't need to call plot.setupGrid()
			plot.draw();
			
			setTimeout(update, updateInterval);
		}

		update();
	}
}


//additional functions for data table
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
	return {
		"iStart":         oSettings._iDisplayStart,
		"iEnd":           oSettings.fnDisplayEnd(),
		"iLength":        oSettings._iDisplayLength,
		"iTotal":         oSettings.fnRecordsTotal(),
		"iFilteredTotal": oSettings.fnRecordsDisplay(),
		"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
		"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
	};
}
$.extend( $.fn.dataTableExt.oPagination, {
	"bootstrap": {
		"fnInit": function( oSettings, nPaging, fnDraw ) {
			var oLang = oSettings.oLanguage.oPaginate;
			var fnClickHandler = function ( e ) {
				e.preventDefault();
				if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
					fnDraw( oSettings );
				}
			};

			$(nPaging).addClass('pagination').append(
				'<ul>'+
					'<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
					'<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
				'</ul>'
			);
			var els = $('a', nPaging);
			$(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
			$(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
		},

		"fnUpdate": function ( oSettings, fnDraw ) {
			var iListLength = 5;
			var oPaging = oSettings.oInstance.fnPagingInfo();
			var an = oSettings.aanFeatures.p;
			var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

			if ( oPaging.iTotalPages < iListLength) {
				iStart = 1;
				iEnd = oPaging.iTotalPages;
			}
			else if ( oPaging.iPage <= iHalf ) {
				iStart = 1;
				iEnd = iListLength;
			} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
				iStart = oPaging.iTotalPages - iListLength + 1;
				iEnd = oPaging.iTotalPages;
			} else {
				iStart = oPaging.iPage - iHalf + 1;
				iEnd = iStart + iListLength - 1;
			}

			for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
				// remove the middle elements
				$('li:gt(0)', an[i]).filter(':not(:last)').remove();

				// add the new list items and their event handlers
				for ( j=iStart ; j<=iEnd ; j++ ) {
					sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
					$('<li '+sClass+'><a href="#">'+j+'</a></li>')
						.insertBefore( $('li:last', an[i])[0] )
						.bind('click', function (e) {
							e.preventDefault();
							oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
							fnDraw( oSettings );
						} );
				}

				// add / remove disabled classes from the static elements
				if ( oPaging.iPage === 0 ) {
					$('li:first', an[i]).addClass('disabled');
				} else {
					$('li:first', an[i]).removeClass('disabled');
				}

				if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
					$('li:last', an[i]).addClass('disabled');
				} else {
					$('li:last', an[i]).removeClass('disabled');
				}
			}
		}
	}
});
