<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\Tutorials;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request as LaraRequest;

class TutorialsController extends Controller
{   
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $data = Tutorials::all();
        return compact('success', 'data');

        // $theads = [
        //     'Id',
        //     'Name',
        //     'File',
        //     'Thumbnail Path'
        // ];

        // $tdata = [];
        // foreach ($model as $m) {
        //     $tdata[] = [
        //         'id' => $m->id,
        //         'name' => $m->name,
        //         'file_url' => $m->file_url,
        //         'thumbnail_url' => $m->thumbnail_url
        //     ];
        // }

        // $class = '';

        // return view('layouts.list', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = Tutorials::findById($id);
        return compact('success', 'data');
    }

    /**
     * Handles saving 
     * @return [type] [description]
     */
    public function store()
    {
        $input = Request::all();

        $model = new Tutorials;
        $result = $model->setAttributesAndSave($input);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        return compact('success', 'data', 'errors');
    }

    /**
     * Load edit page
     * @return [type] [description]
     */
    public function edit()
    {
    	echo json_encode(['success' => true, 'data' => 'this is for edit page.']);
    }

    public function create()
    {
        echo 'here';
    }
}