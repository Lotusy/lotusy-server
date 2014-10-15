<?php
// token end points
//
register('POST', '/token/auth/:type', new TokenAuthenticationHandler());
register('POST', '/register/:type',   new RegistrationHandler());
register('GET',  '/auth/:type/:id',   new AuthenticationHandler());
register('GET',  '/tokeninfo',        new GetTokenInfoHandler());


// user end points
//
register('GET',  '/profile',            new GetCurrentUserProfileHandler());
register('GET',  '/:userid/profile',    new GetUserProfileHandler());
register('POST', '/profile',            new UpdateCurrentUserProfileHandler());
register('POST', '/follow/:userid',     new FollowUserHandler());
register('GET',  '/:userid/followers',  new GetUserFollowersHandler());
register('GET',  '/:userid/followings', new GetUserFollowingsHandler());


// dish collection end points
//
register('POST', '/dish/:dishid/collect',     new CollectDishHandler());
register('POST', '/dish/:dishid/hitlist',     new HitlistDishHandler());
register('GET',  '/:userid/dishes',           new GetUserDishCollectionHandler());
register('GET',  '/:userid/hitlist',          new GetUserDishHitlistHandler());
register('GET',  '/recent/:userid/activites', new GetUserRecentActivitiesHandler());
register('GET',  '/recent/followings/dishes', new GetFollowingRecentDishesHandler());
?>