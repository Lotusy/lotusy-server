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


// location comment end points
//
register('GET', '/location', new GetLocationCommentHandler());


// user comment end points
//
register('GET',  '/user/:userid/comments',      new GetUserCommentHandler());
register('POST', '/collect/comment/:commentid', new CollectCommentHandler());
register('GET',  '/user/:userid/collection',    new GetUserCommentCollectionHandler());


// business comment end points
//
register('GET',  '/business/:businessid/comment/count', new GetBusinessCommentCountHandler());
register('GET',  '/business/:businessid/comments',      new GetBusinessCommentHandler());


// dish comment end points
//
register('GET',  '/dish/:dishid/comment/count', new GetDishCommentCountHandler());
register('GET',  '/dish/:dishid/comments',      new GetDishCommentHandler());
?>