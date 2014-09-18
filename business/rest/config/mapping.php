<?php
// business end points
//
register('POST', '/business',            new CreateBusinessHandler());
register('POST', '/business/external',   new CreateExternalBusinessHandler());
register('POST', '/business/quick',      new CreateQuickBusinessHandler());
register('GET',  '/:businessid/profile', new GetBusinessProfileHandler());
register('GET',  '/location',            new GetLocationBusinessHandler());

// rating end points
//
register('GET',  '/:businessid/rating',                       new GetBusinessRatingHandler());
register('POST', '/:businessid/rate',                         new PostBusinessRatingHandler());
register('GET',  '/:businessid/rating/count',                 new GetBusinessRatingCountHandler());
register('GET',  '/business/:businessid/user/:userid/rating', new GetBusinessUserRatingHandler());

// dish end points
//
register('POST', '/:businessid/dish',   new CreateDishHandler());
register('GET',  '/:businessid/dishes', new GetBusinessDishesHandler());
?>