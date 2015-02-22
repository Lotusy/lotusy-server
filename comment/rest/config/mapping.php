<?php
// comment end points
//
register('POST',   '/comment',                    new CreateCommentHandler());
register('GET',    '/comment/:commentid',         new GetCommentInfoHandler());
register('DELETE', '/comment/:commentid',         new DeleteCommentHandler());


// like end points
//
register('PUT',    '/comment/:commentid/like',    new CommentLikeHandler());
register('PUT',    '/comment/:commentid/dislike', new CommentDislikeHandler());


// reply end points
//
register('POST', '/:commentid/reply',       new CreateReplyHandler());
register('GET',  '/:commentid/replies',     new GetCommentReplyHandler());


// business comment end points
//
register('GET',  '/business/:businessid/comment/count', new GetBusinessCommentCountHandler());
register('GET',  '/business/:businessid/comments',      new GetBusinessCommentHandler());


// dish comment end points
//
register('GET', '/dish/:dishid/comment/count',        new GetDishCommentCountHandler());
register('GET', '/dish/:dishid/comments',             new GetDishCommentHandler());
register('GET', '/dish/:dishid/user/:userid/comment', new GetUserDishCommentHandler());
?>