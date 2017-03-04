<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\User;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $model = User::all();
        
        $theads = [
            'Id',
            'Role',
            'Name',
            'Email',
            'Phone',
            'Address',
            '',  
            ''
        ];

        $tdata = [];
        foreach ($model as $m) :
            if (!$m->is_deleted) {
                $tdata[] = [
                    'id' => $m->id,
                    'role_id' => (new User)->getRoleId($m->role_id),
                    'name' => $m->name,
                    'email' => $m->email,
                    'phone' => $m->phone,
                    'address' => $m->address
                ];
            }
        endforeach;

        $class = 'user';

        return view('users.index', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = User::findById($id);
        return compact('success', 'data');
    }

    /**
     * Landing page for create
     * @return [type] [description]
     */
    public function create()
    {
        $attributes = [
            'role_id' => [
                'label' => 'Role',
                'type' => 'selectbox',
                'option' => [
                    1 => 'Parent',
                    2 => 'User'
                ]
            ],
            'name' => [
                'label' => 'Name', 
                'type' => 'text',
                'value' => ''
            ],
            'email' => [
                'label' => 'Email',
                'type' => 'email',
                'value' => ''
            ], 
            'phone' => [
                'label' => 'Phone', 
                'type' => 'text',
                'value' => ''
            ],
            'address' => [
                'label' => 'Address', 
                'type' => 'textarea',
                'value' => ''
            ],
            'password' => [
                'label' => 'Password', 
                'type' => 'password',
                'value' => ''
            ],

        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'user';

        return view('users.create', ['data' => $attributes, 'class' => $class]);
    }

    /**
     * Handles saving 
     * @return [type] [description]
     */
    public function store()
    {
        $input = Request::all();

        $model = new User;
        $result = $model->setAttributesAndSave($input);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/user/index');
        } else {
            return view('errors.error500');
        }
    }

    /**
     * Load edit page
     * @return [type] [description]
     */
    public function edit($id)
    {
        $model = User::findById($id);
        $attributes = [
            'role_id' => [
                'label' => 'Role',
                'type' => 'selectbox',
                'option' => [
                    1 => 'Parent',
                    2 => 'User'
                ],
                'value' => $model->role_id
            ],
            'name' => [
                'label' => 'Name', 
                'type' => 'text',
                'value' => $model->name
            ],
            'email' => [
                'label' => 'Email',
                'type' => 'email',
                'value' => $model->email
            ], 
            'phone' => [
                'label' => 'Phone', 
                'type' => 'text',
                'value' => $model->phone
            ],
            'address' => [
                'label' => 'Address', 
                'type' => 'textarea',
                'value' => $model->address
            ],
            'password' => [
                'label' => 'Password', 
                'type' => 'password',
                'value' => $model->password
            ],

        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'user';

        return view('users.edit', ['data' => $attributes, 'class' => $class, 'id' => $id]);
    }

    public function logoutaccount(){
        unset($_SESSION['user_id']);
        return view('auth.login');
    }

    public function validateaccount()
    {
        $input = Request::all();

        $data = User::where('email', $input['email'])
                      ->where('password', $input['password'])
                      ->get()->toArray();

        $message = "";
        $success = 0;

        if (empty($data)) {
            $message = "Invalid account!";
        } else {
            
            if (trim($data[0]['role_id']) == "1") {
                $_SESSION['user_id'] = trim($data[0]['id']);
                $message = "Welcome ".trim($data[0]['name'])."!";
                $success = 1;
            } else {
                $message = "No Data Found";
            }
        }

        return compact('message','success');
    }

    public function update($id)
    {
        $input = Request::all();

        $model = User::findById($id);
        $result = $model->setAttributesAndSave(array_merge(['id' => $id], $input));
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/user/index');
        } else {
            return view('errors.error500');
        }
    }
}