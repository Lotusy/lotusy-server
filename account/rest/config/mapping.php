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
register('PUT',  '/profile',            new UpdateCurrentUserProfileHandler());
register('POST', '/follow/:userid',     new FollowUserHandler());
register('GET',  '/:userid/followers',  new GetUserFollowersHandler());
register('GET',  '/:userid/followings', new GetUserFollowingsHandler());
?>