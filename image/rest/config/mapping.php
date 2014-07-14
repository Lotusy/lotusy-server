<?php
// comment end points
//
register('GET',  '/display/comment/:imageid', new GetCommentImageHandler());
register('GET',  '/comment/:commentid/links', new GetCommentImageLinksHandler());
register('POST', '/comment/:commentid',       new PostCommentImageHandler());

// user end points
//
register('GET',  '/display/user/:userid',          new GetUserCurrentProfileImageHandler());
register('GET',  '/display/user/:userid/:imageid', new GetUserProfileImageHandler());
register('GET',  '/user/:userid/profile/links',    new GetUserProfileImageLinksHandler());
register('GET',  '/user/:userid/comment/links',    new GetUserCommentImageLinksHandler());
register('POST', '/user',                          new PutUserImageHandler());

// business end points
//
register('GET',  '/display/business/:businessid', new GetBusinessProfileImageHandler());
register('GET',  '/business/:businessid/links',   new GetBusinessCommentImageLinksHandler());
register('POST', '/business/:businessid',         new PutBusinessImageHandler());
?>