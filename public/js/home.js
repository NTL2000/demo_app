// ajax comment
$(".comment").on("click",".btn_comment",async function(e){
    await $('.comment_form').ajaxForm(function() {});

    var user_name=$(this).prev().prev().val();
    var message=$(this).prev().prev().prev().prev().val();
    var user_id=$(this).prev().prev().prev().val();
    if(message!=""){
        var html= "<li><h5>"+'<a href="'+url+'user/'+user_id+'">'+user_name+'</a> <span class="date">Just finished</span>'+"</h5><p>"+message+"</p></li>";
        $(this).parent().parent().prev().find('ul').append(html);
        setTimeout(() => {
            $(this).prev().prev().prev().val(""); 
        }, 100);   
    }

})
// ajax follow
$(".follow_button").on('click','#btn_follow',function(){
    var id=$(this).parent().prev().val();
    $.ajax({
    url: url+"follow/"+id,
    method: "get",
    success: function (data) {
        var html='<button class="btn btn-primary px-4 ms-3" id="btn_unfollow">UnFollow</button> ';
        $(".follow_button").html(html);
        $('.follow_status').html("Following");
    },
    });
})
$(".follow_button").on('click','#btn_unfollow',function(){
    var id=$(this).parent().prev().val();
    $.ajax({
    url: url+"unfollow/"+id,
    method: "get",
    success: function (data) {
        var html='<button class="btn btn-primary px-4 ms-3" id="btn_follow">Follow</button> ';
        $(".follow_button").html(html);
        $('.follow_status').html("UnFollowed");
    },
    });
})
