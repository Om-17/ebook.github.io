


(()=>{

    $(document).ready(function () {
       
        setTimeout(() => {
            $('.loader').hide();
                
            }, 
            800);
      

     });
     $(window).on('load', function () {
      
        // $('.loader').fadeOut('slow');
       
     })
})();
function loginlink(){
   
    window.location.href ='./login.php';
}
function signuplink(){
   
    window.location.href ='./signup.php';
}
function homelink(){
   
    window.location.href ='./';
}
function showToast(message) {
    var toast = $('<div class="toast">' + message + '</div>');
    $('body').append(toast);
    toast.fadeIn(400).delay(2000).fadeOut(400, function() {
      $(this).remove();
    });
  }
  
function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
    //document.getElementById("header").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    //document.getElementById("header").style.marginLeft= "0";
}; 