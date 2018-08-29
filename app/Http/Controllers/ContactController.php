<?php

namespace App\Http\Controllers;

use stdClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function form(Request $request)
    {
        $navigations = $this->createNavigationCollection(array('skill', 'experience', 'contact'));
        $breadcrumbs = $this->createNavigationCollection(array('/', 'skill', 'experience', 'contact'));

        return view('contact', [
            'page_title' => 'CONTACT',
            'navigations' => $navigations,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function contact(Request $request)
    {
        $navigations = $this->createNavigationCollection(array('skill', 'experience', 'contact'));
        $breadcrumbs = $this->createNavigationCollection(array('/', 'skill', 'experience', 'contact'));

        $input_errors = $this->validator($request);

        if (isset($input_errors))
        {
            return view('contact', [
                'page_type' => 'CONTACT',
                'input_errors' => $input_errors,
                'navigations' => $navigations,
                'breadcrumbs' => $breadcrumbs
            ]);
        } else {

            // email
            $to = "webmaster@designks.com";
            $subject = "ksmithdev.com - contact message";
            $txt = "Hello," . "\r\n" . "Kevin Smith" . "\r\n" . $request->message . "\r\n" . "Thank you," . "\r\n" . $request->first_name . " " . $request->last_name . "\r\n" . "Email: " . $request->email;

            mail($to,$subject,$txt);

            //TODO - Create message page
            if(mail($to, $subject, $txt)) {
                //email sent
                $message['title'] = array('h1' => 'correspondence sent on ' . date("m/d/Y"));
                $message['header'] = array('h3' => 'ksmithdev.com - contact message');
                $message['date_time'] = array('p' => 'sent on ' . date("m/d/Y H:i:s"));
                $message['to'] = array('p' => 'Kevin Smith');
                $message['from'] = array('p' => $request->first_name . ' ' . $request->last_name);
            } else {
                //email failed to send
                $message['title'] = array('h1' => 'correspondence not sent');
                $message['header'] = array('h3' => 'ksmithdev.com - contact message');
                $message['date_time'] = array('p' => 'sent on ' . date("m/d/Y H:i:s"));
                $message['to'] = array('p' => 'Kevin Smith');
                $message['from'] = array('p' => $request->first_name . ' ' . $request->last_name);
            }

            return view('message', [
                'page_title' => 'MESSAGE SENT',
                'message' => $message,
                'navigations' => $navigations,
                'breadcrumbs' => $breadcrumbs
            ]);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param Request $request
     * @return array
     */
    private function validator(Request $request) : ?array
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'email|max:255',
            'message' => 'string|max:65535',
        ]);

        if ($validator->fails()) {

            $input_errors = array();

            foreach ($validator->errors()->messages() as $input_name => $message)
            {
                $error = new stdClass();
                $error->type = 'danger';
                $error->heading = str_replace('_', ' ', $input_name);
                $error->message = $message[0];
                $input_errors[$input_name] = $error;
            }
            return $input_errors;
        }
        return null;
    }

    private function createNavigationCollection(array $navigation_titles)
    {
        $navigations = array();

        foreach ($navigation_titles as $title)
        {
            $navigation = new stdClass();
            $navigation->title = $title;
            array_push($navigations, $navigation);
        }

        return $navigations;
    }
}
