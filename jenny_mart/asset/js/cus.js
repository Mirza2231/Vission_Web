
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