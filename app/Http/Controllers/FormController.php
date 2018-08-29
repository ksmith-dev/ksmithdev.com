<?php

namespace App\Http\Controllers;

use stdClass;
use App\User;
use App\Skill;
use App\UserInfo;
use App\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    /**
     * @param string $table
     * @param string|null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function form(string $table, string $id = null)
    {
        if (Auth::check())
        {
            $user = Auth::user();

            //if user types user in url, form will still work
            $table == 'user' and $table = 'users';

            $inputs = DB::table('form')->where('table', $table)->get();

            $breadcrumbs['/'] = 'inactive';

            if (isset($id))
            {
                switch ($table)
                {
                    case 'experience' :
                        $model = $user->experiences()->where('id', $id)->first();
                        $breadcrumbs['experience'] = 'active';
                        break;
                    case 'skill' :
                        $model = $user->skills()->where('id', $id)->first();
                        $breadcrumbs['skill'] = 'active';
                        break;
                    default :
                        //TODO - tune this error message for public after finishing with development environment
                        return abort(403, 'RESOURCE MISSING: resource ' . $table . ' with id ' . $id . ' can not be located.');
                        break;
                }

            } else {
                switch ($table)
                {
                    case 'users' :
                        $model = $user;
                        $breadcrumbs['user'] = 'active';
                        break;
                    case 'user_info' :
                        $model = $user->userInfo()->where('user_id', $user->id)->first();
                        if (!isset($model))
                        {
                            $model = new UserInfo();
                            $model->id = Auth::user()->getAuthIdentifier();
                        }
                        $breadcrumbs['user_info'] = 'active';
                        break;
                    case 'experience' :
                        $breadcrumbs['experience'] = 'active';
                        break;
                    case 'skill' :
                        $breadcrumbs['skill'] = 'active';
                        break;
                    default :
                        //TODO - tune this error message for public after finishing with development environment
                        return abort(403, 'RESOURCE UNAVAILABLE: resource ' . $table . ' is unavailable.');
                        break;
                }
            }

            foreach ($inputs as $index => $input)
            {
                $column = $input->column;

                if ($input->protected == 0)
                {
                    isset($model->$column) ? $input->value = $model->$column : $input->value =  null;

                    if (isset($input->list) && $input->list != "json")
                    {
                        $json = json_decode($input->list);

                        foreach ($json as $key => $value)
                        {
                            $options[$column][$key] = $value;
                        }
                    }
                    if ($input->list == "json")
                    {
                        $inputs->forget($index);

                        if (isset($model->$column))
                        {
                            $json = json_decode($model->$column, true);

                            $count = 0;


                            if (empty($json))
                            {
                                $new_input = new stdClass();
                                $new_input->column = 'task_0';
                                $new_input->type = 'text';
                                $new_input->protected = 0;
                                $inputs->push($new_input);
                            } else {
                                foreach ($json as $key => $value)
                                {
                                    $new_input = new stdClass();
                                    $new_input->column = 'task_' . $key;
                                    $new_input->type = 'text';
                                    $new_input->value = $value;
                                    $new_input->protected = 0;
                                    $inputs->push($new_input);
                                    $count++;
                                }
                            }
                        } else {
                            $new_input = new stdClass();
                            $new_input->column = 'task_0';
                            $new_input->type = 'text';
                            $new_input->protected = 0;
                            $inputs->push($new_input);
                        }
                    }

                    if (isset($input->attribute))
                    {
                        $json = json_decode($input->attribute, true);

                        foreach ($json as $key => $value)
                        {
                            $attributes[$column][$key] = $value;
                        }
                    }
                }
            }
            $breadcrumbs = $this->createNavigationCollection($breadcrumbs);
            if (isset($model))
            {
                return view('form', [
                    'inputs' => $inputs,
                    'model' => $model,
                    'options' => $options,
                    'attributes' => $attributes,
                    'breadcrumbs' => $breadcrumbs
                ]);
            } else {
                return view('form', [
                    'inputs' => $inputs,
                    'options' => $options,
                    'attributes' => $attributes,
                    'breadcrumbs' => $breadcrumbs
                ]);
            }

        }
        return redirect('/login');
    }

    /**
     * @param Request $request
     * @param string $table
     * @param string|null $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, string $table, string $id = null)
    {
        if (Auth::check())
        {
            $user = Auth::user();

            $alerts = $this->validator($request, $table);

            if (isset($alerts))
            {
                $request->session()->flash('alerts', $alerts);
                return redirect()->back()->withInput($request->input());
            }

            //allow users to input user as a url to modify users table
            $table == 'user' and $table = 'users';

            $columns = Schema::getColumnListing($table);

            $protected = DB::table('form')
                ->select('column')
                ->where('protected', '=', 1)
                ->where('table', '=', $table)
                ->get();

            $inputs = $request->all();

            if (isset($id))
            {
                switch ($table)
                {
                    case 'skill' :
                        $model = $user->skills()->where('id', $id)->first();
                        if (empty($model))
                        {
                            return abort(403, 'RESOURCE MISSING: resource ' . $table . ' with id ' . $id . ' can not be located.');
                        }
                        break;
                    case 'experience' :
                        $model = $user->experiences()->where('id', $id)->first();
                        if (empty($model))
                        {
                            return abort(403, 'RESOURCE MISSING: resource ' . $table . ' with id ' . $id . ' can not be located.');
                        }
                        break;
                }
            } else {
                switch ($table)
                {
                    case 'users' :
                        $model = $user;
                        break;
                    case 'user_info' :
                        $model = $user->userInfo()->where('id', $user->id)->first();
                        if (empty($model))
                        {
                            return abort(403, 'RESOURCE MISSING: resource ' . $table . ' with id ' . $id . ' can not be located.');
                        }
                        break;
                    case 'skill' :
                        $model = new Skill();
                        $model->user_id = $user->id;
                        $model->tasks = '{';
                        break;
                    case 'experience' :
                        $model = new Experience();
                        $model->user_id = $user->id;
                        $model->tasks = '{';
                        break;
                }
            }

            if (isset($model))
            {

                foreach ($columns as $column)
                {
                    if (!$protected->contains('column', $column) && isset($inputs[$column]))
                    {
                        if (is_array($inputs[$column]))
                        {
                            $model->$column = json_encode($inputs[$column]);
                        } else {
                            $model->$column = $inputs[$column];
                        }
                    }
                }

                $count = 0;
                $tasks = '{';
                foreach ($inputs as $key => $value)
                {
                    if (!$protected->contains('column', $key))
                    {
                        if (preg_match('/task/', $key))
                        {
                            $tasks .= '"' . $count . '":"' . $value .  '",';
                            $count++;
                        }
                    }
                }
                $tasks .= '}';

                $tasks = str_replace(',}', '}', $tasks);

                if (!$model->tasks = $tasks)
                {
                    $model->tasks = $tasks;
                }

                $alerts = array();

                if ($model->save())
                {
                    $alert = new stdClass();
                    $alert->type = 'success';
                    $alert->heading = $table . ' record saved';
                    $alert->message = 'Thank you for your submission!';
                    array_push($alerts, $alert);
                } else {
                    $alert = new stdClass();
                    $alert->type = 'failure';
                    $alert->heading = $table . 'unable to save record';
                    $alert->message = 'We were unable to store your record, please refresh the page and try again.';
                    array_push($alerts, $alert);
                }
                $request->session()->flash('alerts', $alerts);
                return redirect('dashboard' );
            } else {
                return abort(401, 'AUTHENTICATION ERROR: you do not have permission to edit this resource.');
            }
        }
        return redirect('/');
    }

    /**
     * @param Request $request
     * @param string $table
     * @param string|null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(Request $request, string $table, string $id = null)
    {
        if ($this->hasPermission('destroy', $table, $id))
        {
            switch ($table)
            {
                case 'users' :
                    User::destroy($id);
                    $request->session()->flash('alert_type', 'success');
                    $request->session()->flash('alert_message',  $table . ' with and identity of ' . $id . ' successfully destroyed');
                    return view('delete', []);
                    break;
                case 'experience' :
                    return abort(404);
                    break;
            }
        }
    }

    /**
     * @param string $request
     * @param string $table
     * @param string $id
     * @return bool
     */
    private function hasPermission(string $request, string $table, string $id) : bool
    {
        switch ($table)
        {
            case 'users' :
                //TODO - implement permissions
                return true;
                break;
        }
        return false;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param Request $request
     * @param string $table
     * @return array
     */
    private function validator(Request $request, string $table) :?array
    {
        $validator = null;

        switch ($table)
        {
            case 'users' :
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'state' => 'alpha|max:2',
                    'notes' => 'string|max:65535',
                    'gender' => 'alpha|max:1',
                ]);
                break;
            case 'user_info' :
                $validator = Validator::make($request->all(), [
                    'building_number' => 'numeric|max:99999',
                    'address' => 'string|max:255',
                    'city' => 'string|max:100',
                    'state' => 'string|max:100',
                    'zip_code' => 'numeric|max:99999',
                    'zip_code_ext' => 'numeric|max:999',
                    'home_phone' => 'string|max:20',
                    'office_phone' =>'string|max:20',
                    'mobile_phone' => 'string|max:20',
                    'title' => 'string|max:100',
                    'bio' => 'string|max:65535',
                    'gender' => 'string|max:1',
                ]);
                break;
            case 'experience' :
                $validator = Validator::make($request->all(), [
                    'img_path' => 'string|max:100',
                    'title' => 'required|string|max:225',
                    'company_name' => 'string',
                    'end_date' => 'date',
                    'city' => 'string',
                    'state' => 'string|max:2',
                    'description' => 'max:600',
                ]);
                break;
            case 'skill' :
                $validator = Validator::make($request->all(), [
                    'img_path' => 'string|max:100',
                    'title' => 'required|string|max:225',
                    'company_name' => 'string',
                    'duration' => 'numeric',
                ]);
                break;
            case 'detail' :
                $validator = Validator::make($request->all(), [
                    'model_id' => 'required',
                    'text' => 'required|string|max:225',
                ]);
                break;
        }

        if ($validator->fails()) {

            $alerts = array();

            foreach ($validator->errors()->messages() as $input_name => $message)
            {
                $alert = new stdClass();
                $alert->type = 'warning';
                $alert->heading = str_replace('_', ' ', $input_name);
                $alert->message = $message[0];
                array_push($alerts, $alert);
            }

            return $alerts;
        }
        return null;
    }

    private function createNavigationCollection(array $nav_and_state)
    {
        $collection = collect();
        foreach ($nav_and_state as $nav => $state)
        {
            $navigation = new stdClass();
            $navigation->title = $nav;
            $navigation->is_active = $state;
            $collection->push($navigation);
        }
        return $collection;
    }
}
