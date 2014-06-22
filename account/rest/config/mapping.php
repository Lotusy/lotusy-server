<?php
// token end points
//
register('POST', '/register/:type',   new RegistrationHandler());
register('GET',  '/auth/:type/:id',   new AuthenticationHandler());
register('GET',  '/tokeninfo',        new GetTokenInfoHandler());


// user end points
//
register('GET',  '/profile',         new GetCurrentUserProfileHandler());
register('GET',  '/:userid/profile', new GetUserProfileHandler());
register('PUT',  '/profile',         new UpdateCurrentUserProfileHandler());
?>