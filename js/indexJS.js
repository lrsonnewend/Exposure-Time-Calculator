document.getElementsByClassName("tablink")[0].click();

// Responsible to switch tabs
function openTab(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].classList.remove("w3-light-grey");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.classList.add("w3-light-grey");
}
// It controls the ETC MODE animation
function changeState(el, style, el1, style1) {
    //deixando o objeto a ser usado visible
    document.getElementById(el).style.display = style;
    //deixado o objeto não utilizado invisible
    document.getElementById(el1).style.display = style1;
}

//To deal with shortcuts
function key(event)
{
  if(event.keyCode == 13)
  {  
     var form = document.querySelector('#fEtc');
     if (form.checkValidity()) 
     {
      form.submit();
     }
     else  
     {
       form.querySelector('input[type="submit"]').click();
     } 
  }
  else if(event.keyCode == 27)
  {
    document.getElementById('id01').style.display='none';
  }
}