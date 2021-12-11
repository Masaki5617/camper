
const l = console.log;
const Event = document.addEventListener;
const star = $(".star")[0].dataset.score;

$(function raty() {
  
  $(".star").raty({
       half:true,
       starOn:       '/js/star-on.png',
       starHalf:     '/js/star-half.png',
       starOff:      '/js/star-off.png',
       readOnly:true
  });

  $(".star").data('raty').score(star);
});

Event("click",(e)=> {
  if([...document.querySelectorAll(".delete")].includes(e.target)) {
   
    if(!confirm("削除しますか？")) e.preventDefault();
 
    console.log(e.target.href);
  }
 });