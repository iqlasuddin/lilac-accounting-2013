// window.onbeforeunload = function (event) {
  // var message = 'Sure you want to leave?';
  // if (typeof event == 'undefined') {
    // event = window.event;
  // }
  // if (event) {
    // event.returnValue = message;
  // }
  // return message;
// }

// window.unload(function(){
	// ord_code=$('#hidden_ordcode').val();
// confirm('Are you sure you want to delete this item?');
  // if (confirm == true) {
    // $.post("truncate.php",{
    	// ord_code:ord_code
    // })
  // }
// 	
// });
window.onbeforeunload = function(e) {
confirm('Are you sure you want to delete this item?');
if (confirm) {
	"unload",this,true;
};
};
 // $(window).unload(function() {
//                
                  // confirm('Are you sure you want to delete this item?');
//                 
            // });