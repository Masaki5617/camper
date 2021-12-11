
$("#campsite_info").on("click",function() {
  location.href = "detail.php";
});


const l = console.log;
const Event = document.addEventListener;

Event("click",(e)=> {
  if([...document.querySelectorAll(".delete")].includes(e.target)) {
   
    if(!confirm("削除しますか？")) e.preventDefault();
 
    console.log(e.target.href);
  }
 });