<?php
// business end points
//
register('POST', '/business',            new CreateBusinessHandler());
register('GET',  '/:businessid/profile', new GetBusinessProfileHandler());
register('GET',  '/location',            new GetLocationBusinessHandler());

// rating end points
//
register('GET',  '/:businessid/rating',                       new GetBusinessRatingHandler());
register('POST', '/:businessid/rate',                         new PostBusinessRatingHandler());
register('GET',  '/:businessid/rating/count',                 new GetBusinessRatingCountHandler());
register('GET',  '/business/:businessid/user/:userid/rating', new GetBusinessUserRatingHandler());
?>