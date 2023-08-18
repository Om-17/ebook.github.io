(() => {
  $(document).ready(function () {
    setTimeout(() => {
      $(".loader").hide();
    }, 800);

    //
  });
  $(window).on("load", function () {
    $("#wishdropdownbtn").click(() => {
      $("#WishDropdown").toggleClass("show");
    });
    // $('.loader').fadeOut('slow');
  });
})();

function loginlink() {
  window.location.href = "./login.php";
}
function signuplink() {
  window.location.href = "./signup.php";
}
function homelink() {
  window.location.href = "./";
}
function showToast(message) {
  var toast = $('<div class="toast">' + message + "</div>");
  $("body").append(toast);
  toast
    .fadeIn(400)
    .delay(2000)
    .fadeOut(400, function () {
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
}

function mybookdropdownFunction(bookid, status, statustab) {
  console.log(status);
  console.log(statustab);

  // Close all dropdowns except the current one
  $('.mybookdropdown-content').not("#mybookDropdown" + statustab + bookid).removeClass('d-block');

  if (status == "On-Hold") {
      $('#on_hold' + bookid + statustab).addClass('btn-active');
  } else if (status == "Plan-To-Read") {
      $('#plantoread' + bookid + statustab).addClass('btn-active');
  } else if (status == "Dropped") {
      $('#dropped' + bookid + statustab).addClass('btn-active');
  } else if (status == "Completed") {
      $('#completed' + bookid + statustab).addClass('btn-active');
  }

  var dropdown = $("#mybookDropdown" + statustab + bookid);
  if (dropdown.hasClass("d-block")) {
      dropdown.removeClass("d-block");
  } else {
      dropdown.addClass("d-block");
  }
}

window.onclick = function (event) {
  if (!event.target.matches(".mybookdropbtn")) {
    var dropdowns = document.getElementsByClassName("mybookdropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("d-block")) {
        openDropdown.classList.remove("d-block");
      }
    }
  }
};

function searchbar() {
  document.getElementById("searchDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
// window.onclick = function(event) {
//   if (!event.target.matches('.search_btn')) {
//     var dropdowns = document.getElementsByClassName("dropdown-search");
//     var i;
//     for (i = 0; i < dropdowns.length; i++) {
//       var openDropdown = dropdowns[i];
//       if (openDropdown.classList.contains('show')) {
//         openDropdown.classList.remove('show');
//       }
//     }
//   }
// }