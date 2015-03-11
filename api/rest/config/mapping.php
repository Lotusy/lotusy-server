<?php
// mobile flow end points
//
// Flow-Add food tried
register('GET', '/flow/dish/:dishid/detail', new GetDishDetailHandler());
// Flow-Discover-addnewfood-rankup
register('GET', '/flow/user/followings/dishes',  new GetFollowingRecentDishesHandler());
register('GET', '/flow/search/business/dish',    new SearchBusinessByNameHandler());
register('GET', '/flow/dish/:dishid/popularity', new GetDishPopularityInfoHandler());
// Flow-Food details-comments-takephoto
register('GET', '/flow/dish/:dishid/preference', new GetDishPreferenceDetailHandler());
register('GET', '/flow/dish/:dishid/infograph',  new GetDishInfoGraphFlowHandler());
// Flow-Profile-Me
register('GET', '/flow/user/:userid/activities', new GetFlowUserActivityHandler());
register('GET', '/flow/me/profile',              new GetMeProfileHandler());
register('GET', '/flow/me/buddy',                new GetMeBuddyHandler());
register('GET', '/flow/me/buddy/add',            new GetMeBuddyAddHandler());
register('GET', '/flow/me/buddy/add/network',    new GetMeBuddyAddNetworkHandler());
register('GET', '/flow/me/buddy/add/suggest',    new GetMeBuddyAddSuggestHandler());
// Flow-Profile-others
register('GET', '/flow/user/:userid/profile/ranking', new GetProfileRankingHandler());
register('GET', '/flow/user/:userid/profile',         new GetOtherProfileHandler());
register('GET', '/flow/user/:userid/buddy',           new GetOtherBuddyHandler());
// Flow-Restaurant view
// Flow-Settings
// Flow-Stamps


// token end points
//
register('POST', '/token/auth/:type', new TokenAuthenticationHandler());
register('POST', '/register/:type',   new RegistrationHandler());
register('GET',  '/auth/:type/:id',   new AuthenticationHandler());
register('GET',  '/tokeninfo',        new GetTokenInfoHandler());


// user end points
//
register('GET',    '/user/profile',                 new GetCurrentUserProfileHandler());
register('GET',    '/user/:userid/profile',         new GetUserProfileHandler());
register('GET',    '/user/search/name',             new SearchUserByNameHandler()); // NOT IMPLEMENTED
register('POST',   '/user/profile',                 new UpdateCurrentUserProfileHandler());
register('POST',   '/user/follow/:userid',          new FollowUserHandler());
register('DELETE', '/user/follow/:userid',          new UnfollowUserHandler());
register('GET',    '/user/:userid/followers',       new GetUserFollowersHandler());
register('GET',    '/user/:userid/followings',      new GetUserFollowingsHandler());
register('GET',    '/user/:userid/dishes',          new GetUserDishCollectionHandler());
register('GET',    '/user/:userid/hitlist',         new GetUserDishHitlistHandler());
register('GET',    '/user/:userid/activites',       new GetUserRecentActivitiesHandler());
register('GET',    '/user/:userid/activites/count', new GetUserActivitiesCountHandler());
register('GET',    '/user/:userid/alters',          new GetUserActiveAlertsHandler());
register('GET',    '/user/alert/:language/terms',   new GetAlertItermHandler());
register('POST',   '/user/alert/:code/:action',     new PostUserAlertHandler());


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
register('POST',   '/image/dish/:dishid',                                  new PostDishImageHandler());
register('GET',    '/image/dish/:dishid/profile/links',                    new GetDishProfileImageLinksHandler());
register('GET',    '/image/dish/:dishid/user/:userid/display',             new DisplayDishUserImageHandler());
register('GET',    '/image/dish/:dishid/profile/display',                  new DisplayDishProfileDefaultImageHandler());
register('POST',   '/image/signature',                                     new PostUserSignatureImageHandler());
register('GET',    '/image/signature/user/:userid/links',                  new GetUserSignatureImageLinksHandler());
register('GET',    '/image/signature/:signatureid/user/:userid/display',   new DisplayUserSignatureImageHandler());
register('DELETE', '/image/signature/:signatureid',                        new DeleteUserSigntureImageHandler());
register('POST',   '/image/user',                                          new PutUserImageHandler());
register('GET',    '/image/user/:userid/profile/:imageid/display',         new GetUserProfileImageHandler());
register('GET',    '/image/user/:userid/profile/display',                  new GetUserProfileDefaultImageHandler());
register('POST',   '/image/business/:businessid',                          new PutBusinessImageHandler());
register('GET',    '/image/business/:businessid/profile/:imageid/display', new GetBusinessProfileImageHandler());
?>