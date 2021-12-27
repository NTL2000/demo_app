$(".comment").on("click","#btn_comment",async function(){
    await $('#comment').ajaxForm(function() {});

    var user_name=$(this).prev().prev().val();
    var message=$(this).prev().prev().prev().val();
    if(message!=""){
        var html= "<li><h5>#"+user_name+"</h5><p>"+message+"</p></li>";
        $(this).parent().parent().prev().find('ul').append(html);
        $(this).prev().prev().prev().val("");    
    }

})