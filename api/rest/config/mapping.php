<?php
// mobile flow end points
//
register('GET', '/flow/user/followings/dishes', new GetFollowingRecentDishesHandler());


// token end points
//
register('POST', '/token/auth/:type', new TokenAuthenticationHandler());
register('POST', '/register/:type',   new RegistrationHandler());
register('GET',  '/auth/:type/:id',   new AuthenticationHandler());
register('GET',  '/tokeninfo',        new GetTokenInfoHandler());


// user end points
//
register('GET',  '/user/profile',                 new GetCurrentUserProfileHandler());
register('GET',  '/user/:userid/profile',         new GetUserProfileHandler());
register('POST', '/user/profile',                 new UpdateCurrentUserProfileHandler());
register('POST', '/user/follow/:userid',          new FollowUserHandler());
register('GET',  '/user/:userid/followers',       new GetUserFollowersHandler());
register('GET',  '/user/:userid/followings',      new GetUserFollowingsHandler());
register('GET',  '/user/:userid/dishes',          new GetUserDishCollectionHandler());
register('GET',  '/user/:userid/hitlist',         new GetUserDishHitlistHandler());
register('GET',  '/user/:userid/activites',       new GetUserRecentActivitiesHandler());
register('GET',  '/user/:userid/activites/count', new GetUserActivitiesCountHandler());


// business end points
//
register('POST', '/business',                                 new CreateBusinessHandler());
register('POST', '/business/external',                        new CreateExternalBusinessHandler());
register('POST', '/business/quick',                           new CreateQuickBusinessHandler());
register('GET',  '/business/:businessid/profile',             new GetBusinessProfileHandler());
register('GET',  '/business/location',                        new GetLocationBusinessHandler());
register('GET',  '/business/search/name',                     new SearchBusinessByNameHandler()); // NOT IMPLEMENTED
register('GET',  '/business/:businessid/rating',              new GetBusinessRatingHandler());
register('POST', '/business/:businessid/rate',                new PostBusinessRatingHandler());
register('GET',  '/business/:businessid/rating/count',        new GetBusinessRatingCountHandler());
register('GET',  '/business/:businessid/user/:userid/rating', new GetBusinessUserRatingHandler());


// dish end points
//
register('POST', '/business/:businessid/dish',                    new CreateDishHandler());
register('GET',  '/business/:businessid/dishes',                  new GetBusinessDishesHandler());
register('POST', '/dish/:dishid/like',                            new DishLikeHandler());
register('POST', '/dish/:dishid/dislike',                         new DishDislikeHandler());
register('GET',  '/dish/location',                                new GetLocationDishHandler());
register('GET',  '/dish/:dishid/preference',                      new GetDishPreferenceDetailHandler());
register('GET',  '/dish/:dishid/popularity/info',                 new GetDishPopularityInfoHandler());
register('POST', '/dish/:dishid/collect',                         new CollectDishHandler());
register('POST', '/dish/:dishid/hitlist',                         new HitlistDishHandler());
register('GET',  '/dish/:dishid/users/info',                      new GetDishUserInfoHandler());
register('GET',  '/dish/keyword/:language/terms',                 new GetKeywordItermHandler());
register('POST', '/dish/:dishid/keywords',                        new PostUserDishKeywordHandler());
register('GET',  '/dish/:dishid/user/:userid/keywords/:language', new GetUserDishKeywordHandler());
register('GET',  '/dish/:dishid/keywords/count/:language',        new GetDishKeywordCountHandler());
register('GET',  '/dish/:dishid/keywords/:language',              new GetDishKeywordsHandler());
register('GET',  '/dish/:dishid/infograph',                       new GetDishInfoGraphHandler());
register('POST', '/dish/:dishid/infograph',                       new PostDishInfoGraphHandler());
register('GET',  '/dish/:dishid/user/:userid/infograph',          new GetUserDishInfoGraphHandler());
register('GET',  '/dish/cuisine/:language/terms',                 new GetCuisineItermHandler());


// comment end points
//
register('POST',   '/comment',                                   new CreateCommentHandler());
register('GET',    '/comment/business/:businessid/comments',     new GetBusinessCommentHandler());
register('GET',    '/comment/dish/:dishid/comment/count',        new GetDishCommentCountHandler());
register('GET',    '/comment/dish/:dishid/comments',             new GetDishCommentHandler());
register('GET',    '/comment/dish/:dishid/user/:userid/comment', new GetUserDishCommentHandler());
register('GET',    '/comment/:commentid',                        new GetCommentInfoHandler());
register('DELETE', '/comment/:commentid',                        new DeleteCommentHandler());
register('PUT',    '/comment/:commentid/like',                   new CommentLikeHandler());
register('PUT',    '/comment/:commentid/dislike',                new CommentDislikeHandler());
register('POST',   '/comment/:commentid/reply',                  new CreateReplyHandler());
register('GET',    '/comment/:commentid/replies',                new GetCommentReplyHandler());


// image end points
//
register('POST', '/image/dish/:dishid',                                  new PostDishImageHandler());
register('GET',  '/image/dish/:dishid/profile/links',                    new GetDishProfileImageLinksHandler());
register('GET',  '/image/dish/:dishid/profile/:imageid/display',         new DisplayDishProfileImageHandler());
register('GET',  '/image/dish/:dishid/profile/display',                  new DisplayDishProfileDefaultImageHandler());

register('POST', '/image/comment/:commentid',                            new PostCommentImageHandler());
register('GET',  '/image/comment/:commentid/:imageid/display',           new GetCommentImageHandler());
register('GET',  '/image/comment/dish/:dishid/:imageid/display',	     new GetDishImageHandler());
register('GET',  '/image/comment/dish/:dishid/links',                    new GetDishImageLinksHandler());
register('GET',  '/image/comment/business/:businessid/:imageid/display', new GetBusinessFastImageHandler());
register('GET',  '/image/comment/business/:businessid/links',            new GetBusinessFastImageLinksHandler());
register('GET',  '/image/comment/user/:userid/:imageid/display',         new GetUserFastImageHandler());
register('GET',  '/image/comment/user/:userid/links',                    new GetUserCommentImageLinksHandler());

register('POST', '/image/user',                                          new PutUserImageHandler());
register('GET',  '/image/user/:userid/profile/:imageid/display',         new GetUserProfileImageHandler());

register('POST', '/image/business/:businessid',                          new PutBusinessImageHandler());
register('GET',  '/image/business/:businessid/profile/:imageid/display', new GetBusinessProfileImageHandler());
?>