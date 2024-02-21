
window.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
 };
 
 
 function cancel(){
    document.querySelector('.edit-form-container').style.display = 'none';
    // window.location.href = 'lipadmin.php';
 };

//  function close(){
//     document.getElementById("#close-alert")
//  }


const myTimeout = setTimeout(myGreeting, 10000);

function myGreeting() {
  document.getElementById("close-alert").style.display = "none";
  document.getElementById("close-alert").style.transition = "opacity 2s linear";
  document.getElementById("close-alert").style.webkitTransition = "opacity 2s linear";

  
}



// // Get the button:
// let mybutton = document.getElementById("myBtn");

// // When the user scrolls down 20px from the top of the document, show the button
// window.onscroll = function() {scrollFunction()};

// function scrollFunction() {
//   if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
//     mybutton.style.display = "block";
//   } else {
//     mybutton.style.display = "none";
//   }
// }

// // When the user clicks on the button, scroll to the top of the document
// function topFunction() {
//   document.body.scrollTop = 0; // For Safari
//   document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
// }


var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});

function myFunction() {
   var x = document.getElementById("myInput");
   var y = document.getElementById("myConfirmInput");
   if (x.type === "password") {
     x.type = "text";
     y.type = "text";
   } else {
     x.type = "password";
     y.type = "password";

   }
 }




