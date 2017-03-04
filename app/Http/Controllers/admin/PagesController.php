<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    
    /**
     * Handles GET method
     * @param  [type] $controller [description]
     * @param  string $action     [description]
     * @return [type]             [description]
     */
    public function get($controller, $action = "index")
    {
        $controller_ = ucfirst($controller)."Controller";
        switch ($action) {
            case 'create':
                return app('App\Http\Controllers\admin\\'.$controller_)->create();
                break;
            case 'index':
                return app('App\Http\Controllers\admin\\'.$controller_)->index();
                break;
            default:
                return app('App\Http\Controllers\admin\\'.$controller_)->show($action);
                break;
        }
    }

    /**
     * Handles POST method
     * @param  [type] $controller [description]
     * @param  string $action     [description]
     * @return [type]             [description]
     */
    public function post($controller, $id =null, $action = "create")
    {
        $controller_ = ucfirst($controller)."Controller";
        if ($action == 'create') {
            return app('App\Http\Controllers\admin\\'.$controller_)->store();
        } elseif ($action == 'update') {
            return app('App\Http\Controllers\admin\\'.$controller_)->update($id);
        }
    }

    /**
     * Load update page
     * @param  [type] $controller [description]
     * @param  string $action     [description]
     * @return [type]             [description]
     */
    public function edit($controller, $id =null, $action = "edit")
    {
        $controller_ = ucfirst($controller)."Controller";
        switch ($action) {
            case 'edit':
                if ($id)
                    return app('App\Http\Controllers\admin\\'.$controller_)->edit($id);
                else
                    return app('App\Http\Controllers\admin\\'.$controller_)->index();
            case 'delete':
                if ($id)
                    return app('App\Http\Controllers\admin\\'.$controller_)->destroy($id);
                else
                    return app('App\Http\Controllers\admin\\'.$controller_)->index();
                break;
            default:
                echo "<h1>Error 404. Page not found.</h1>";
        }
    }
}