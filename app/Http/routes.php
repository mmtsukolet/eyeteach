<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/**
 * @todo Correct the codes on templates
 * @todo Use bower_components for js libs. Work it with gulpfile.js, elixir 
 * @todo Add Authentications on authenticated requests (admin, logins/register)
 */


/**
 * Handles api routes
 */
$app->group(['prefix' => 'api'], function ($app) {

    $app->get('/childprogress/{childId}/child', 'api\ChildprogressController@getChildProgress');
    $app->post('/user/login', 'api\UserController@login');
    
    $app->get('/{controller}/{id}/edit', 'api\ApiController@edit');
    $app->get('/{controller}', 'api\ApiController@get');
    $app->get('/{controller}/{action}', 'api\ApiController@get');
    $app->get('/{controller}/{action}/{lang_id}/{category_id}/', 'api\ApiController@get');
    $app->post('/{controller}', 'api\ApiController@post');
    $app->post('/{controller}/{id}/delete', 'api\ApiController@delete');

});

if (isset($_SESSION['user_id'])) {

    $app->get('/', 'admin\UserController@index');
    $app->get('/logout', 'admin\UserController@logoutaccount');

    $app->group(['prefix' => 'admin'], function ($app) {

        $app->get('/childprogress/{childId}/child', 'admin\ChildprogressController@getChildProgress');

        $app->get('/{controller}/', 'admin\PagesController@get');
        $app->get('/{controller}/{action}', 'admin\PagesController@get');
        $app->post('/{controller}', 'admin\PagesController@post');
        $app->get('/{controller}/{id}/edit', 'admin\PagesController@edit');
        $app->post('/{controller}/{id}/{action}', 'admin\PagesController@post'); //edit

    });

} else {
    $app->get('/', function () use ($app) {
        return view('auth.login');
        //return "Welcome! I am built from " . $app->version();
    });

    /**
     * Handles logins
     */
    $app->get('/login', function () use ($app) {
        return view('auth.login');
    });

    $app->post('/checklogin', 'admin\UserController@validateaccount');

    $app->get('/register', function () use ($app) {
        return view('auth.register');
    });

    $app->get('/report', function () use ($app) {
        return view('report.bargraph');
    });
}

/**
 * Admin routes with Authentications
 */



/**
 * @todo : Hook admin routes to this
 */
// $app->group(['middleware' => 'auth'], function ($app) {}); 


$app->get('/{any:.*}', function ($any) use ($app) {
    return view('errors.error400');
});

