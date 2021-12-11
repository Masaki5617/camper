$(function raty() {
  $("#star1").raty({
       half:true,
       number: 5,
       score : 3,
       starOn:       '/js/star-on.png',
       starHalf:     '/js/star-half.png',
       starOff:      '/js/star-off.png',
       readOnly:true
  });
});


$(function() {
    $('.btn_vote').click(function() {
        $(this).toggleClass('on');
    });
});

$(function() {
  $("#vote_01").click(function() {
    var user_id = $(this).data('user_id');
    var campsite_id = location.search.split('=')[1];
    $.ajax({
      type:"POST",
      url:"../favorite/favorite.php",
      data:{
        "user_id":user_id,
        "campsite_id":campsite_id
      }
    })
  });
})





