<?php
// comment end points
//
register('GET',  '/display/comment/:commentid/:imageid', new GetCommentImageHandler());
register('POST', '/comment/:commentid',                  new PostCommentImageHandler());
register('GET',  '/comment/:commentid/links',            new GetCommentImageLinksHandler());
register('GET',  '/comments/:commentids/links',          new GetCommentsImageLinksHandler());

// dish end points
//
register('GET',  '/display/dish/:dishid/:imageid',	 new GetDishImageHandler());
register('POST', '/dish/:dishid',                    new PostDishImageHandler());
register('POST', '/dish/:dishid/comment/:commentid', new PostCommentDishImageHandler());
register('GET',  '/dish/:dishid/links',              new GetDishImageLinksHandler());

// user end points
//
register('GET',  '/display/user/:userid',               new GetUserCurrentProfileImageHandler());
register('GET',  '/display/user/:userid/:imageid',      new GetUserProfileImageHandler());
register('GET',  '/display/user/:userid/fast/:imageid', new GetUserFastImageHandler());
register('GET',  '/user/:userid/profile/links',         new GetUserProfileImageLinksHandler());
register('GET',  '/user/:userid/comment/links',         new GetUserCommentImageLinksHandler());
register('POST', '/user',                               new PutUserImageHandler());

// business end points
//
register('GET',  '/display/business/:businessid/fast/:imageid', new GetBusinessFastImageHandler());
register('GET',  '/display/business/:businessid',               new GetBusinessProfileImageHandler());
register('GET',  '/business/:businessid/links',                 new GetBusinessFastImageLinksHandler());
register('POST', '/business/:businessid',                       new PutBusinessImageHandler());
?>