<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    
    /**
     * Handles GET method
     * @param  [type] $controller [description]
     * @param  string $action     [description]
     * @return [type]             [description]
     */
    public function get($controller, $action = "index", $lang_id = "0", $category_id = "0")
    {
        $controller_ = ucfirst($controller)."Controller";
        switch ($action) {
            case 'create':
                return app('App\Http\Controllers\api\\'.$controller_)->create();
                break;
            case 'index':
                return app('App\Http\Controllers\api\\'.$controller_)->index();
                break;
            case 'specific':
                //die('sulod specific lang_id='.$lang_id.' category_id='.$category_id);
                return app('App\Http\Controllers\api\\'.$controller_)->specific($lang_id,$category_id);
                break;
            default:
                return app('App\Http\Controllers\api\\'.$controller_)->show($action);
                break;
        }
    }

    /**
     * Handles POST method
     * @param  [type] $controller [description]
     * @param  string $action     [description]
     * @return [type]             [description]
     */
    public function post($controller, $action = "create")
    {
        $controller_ = ucfirst($controller)."Controller";
        switch ($action) {
            case 'create':
                return app('App\Http\Controllers\api\\'.$controller_)->store();
                break;
            default:

                break;
        }
        if ($action == 'create') {
            
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
                    return app('App\Http\Controllers\api\\'.$controller_)->edit($id);
                else
                    return app('App\Http\Controllers\api\\'.$controller_)->index();
            case 'delete':
                if ($id)
                    return app('App\Http\Controllers\api\\'.$controller_)->destroy($id);
                else
                    return app('App\Http\Controllers\api\\'.$controller_)->index();
                break;
            default:
                echo "<h1>Error 404. Page not found.</h1>";
        }
    }

    public function delete($controller, $id)
    {
        $controller_ = ucfirst($controller)."Controller";
        return app('App\Http\Controllers\api\\'.$controller_)->delete($id);
    }
}