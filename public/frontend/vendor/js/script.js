$(document).ready(function () {
    $('.replyBox').hide();
    $('.reply_btn').click(function () {
        var replyBoxId= $(this).attr('replyBoxId');
        $('#'+replyBoxId).slideToggle();
    })
    $('.comment_hide').click(function () {
        var commentId = $(this).attr('comment_id');
        $.ajax({
            url:'/comment-status/'+commentId,
            type: 'get',
            data:{ commentId: commentId},
            success: function (res) {
                if(res.status == true)
                {
                    $('#commentBox-'+commentId).hide()
                }

            },
            error: function () {
                alert('problem')
            }

        });
    });
    $('.replyHide').click(function () {
        var replyId = $(this).attr('reply_id');
        $.ajax({
            url:'/reply-status/'+replyId,
            type: 'get',
            data:{ replyId: replyId},
            success: function (res) {
                if(res.status == true)
                {
                    $('#reply-'+replyId).hide();
                }

            },
            error: function (res) {
                alert('problem'+res)
            }

        });

    });
    $('.subReply').hide();
    $('.subReply_btn').click(function () {
        var subReplyBoxId= $(this).attr('subReplyBoxId');
        $('#subReply-'+subReplyBoxId).slideToggle();
    })

})
