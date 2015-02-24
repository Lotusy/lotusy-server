<?php
// token end points
//
register('POST', '/token/auth/:type', new TokenAuthenticationHandler());
register('POST', '/register/:type',   new RegistrationHandler());
register('GET',  '/auth/:type/:id',   new AuthenticationHandler());
register('GET',  '/tokeninfo',        new GetTokenInfoHandler());


// user end points
//
register('GET',  '/profile',              new GetCurrentUserProfileHandler());
register('GET',  '/:userid/profile',      new GetUserProfileHandler());
register('POST', '/profile',              new UpdateCurrentUserProfileHandler());
register('POST', '/follow/:userid',       new FollowUserHandler());
register('GET',  '/:userid/followers',    new GetUserFollowersHandler());
register('GET',  '/:userid/followings',   new GetUserFollowingsHandler());


// dish collection end points
//
register('POST', '/dish/:dishid/collect',           new CollectDishHandler());
register('POST', '/dish/:dishid/hitlist',           new HitlistDishHandler());
register('GET',  '/:userid/dishes',                 new GetUserDishCollectionHandler());
register('GET',  '/:userid/hitlist',                new GetUserDishHitlistHandler());
register('GET',  '/:dishid/users/info',             new GetDishUserInfoHandler());
register('GET',  '/recent/:userid/activites',       new GetUserRecentActivitiesHandler());
register('GET',  '/recent/:userid/activites/count', new GetUserActivitiesCountHandler());
register('GET',  '/recent/followings/dishes',       new GetFollowingRecentDishesHandler());

// business end points
//
register('POST', '/business',            new CreateBusinessHandler());
register('POST', '/business/external',   new CreateExternalBusinessHandler());
register('POST', '/business/quick',      new CreateQuickBusinessHandler());
register('GET',  '/:businessid/profile', new GetBusinessProfileHandler());
register('GET',  '/location',            new GetLocationBusinessHandler());
register('GET',  '/search/name',         new SearchBusinessByNameHandler());


// rating end points
//
register('GET',  '/:businessid/rating',                       new GetBusinessRatingHandler());
register('POST', '/:businessid/rate',                         new PostBusinessRatingHandler());
register('GET',  '/:businessid/rating/count',                 new GetBusinessRatingCountHandler());
register('GET',  '/business/:businessid/user/:userid/rating', new GetBusinessUserRatingHandler());


// dish end points
//
register('POST', '/:businessid/dish',        new CreateDishHandler());
register('GET',  '/:businessid/dishes',      new GetBusinessDishesHandler());
register('POST', '/dish/:dishid/like',       new DishLikeHandler());
register('POST', '/dish/:dishid/dislike',    new DishDislikeHandler());
register('GET',  '/dish/location',           new GetLocationDishHandler());
register('GET',  '/dish/:dishid/preference', new GetDishPreferenceDetailHandler());
register('GET',  '/:dishid/popularity/info', new GetDishPopularityInfoHandler());


// keywords end points
//
register('POST', '/dish/keywords',                                new PostUserDishKeywordHandler());
register('GET',  '/user/:userid/dish/:dishid/keywords/:language', new GetUserDishKeywordHandler());
register('GET',  '/dish/:dishid/keywords/count/:language',        new GetDishKeywordCountHandler());
register('GET',  '/dish/:dishid/keywords/:language',              new GetDishKeywordsHandler());
register('GET',  '/keyword/:langauge/terms',                      new GetKeywordItermHandler());


// dish rating end points
//
register('GET',  '/dish/:dishid/infograph',              new GetDishInfoGraphHandler());
register('POST', '/dish/:dishid/infograph',              new PostDishInfoGraphHandler());
register('GET',  '/user/:userid/dish/:dishid/infograph', new GetUserDishInfoGraphHandler());


// iterm end points
//
register('GET', '/cuisine/:language/terms', new GetCuisineItermHandler());


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
register('GET',  '/business/:businessid/comments',      new GetBusinessCommentHandler());


// dish comment end points
//
register('GET', '/dish/:dishid/comment/count',        new GetDishCommentCountHandler());
register('GET', '/dish/:dishid/comments',             new GetDishCommentHandler());
register('GET', '/dish/:dishid/user/:userid/comment', new GetUserDishCommentHandler());

register('POST', '/dish/:dishid/comment/:commentid', new PostCommentDishImageHandler());


// comment end points
//
register('GET',  '/display/comment/:commentid/:imageid', new GetCommentImageHandler());


// dish end points
//
register('GET',  '/display/dish/:dishid/:imageid',	 new GetDishImageHandler());
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