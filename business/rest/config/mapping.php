<?php
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
register('GET',  '/dishes/:dishids',         new GetDishesHandler());
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
?>