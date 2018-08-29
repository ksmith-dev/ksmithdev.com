<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use stdClass;
use App\FormFactory;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $navigations = $this->createNavigationCollection(array('skill', 'experience', 'contact'));
        $breadcrumbs = $this->createNavigationCollection(array('skill', 'experience', 'contact'));

        $skills = $user->skills()->get();
        $experiences = $user->experiences()->get();

        return view('dashboard', [
            'navigations' => $navigations,
            'breadcrumbs' => $breadcrumbs,
            'skills' => $skills,
            'experiences' => $experiences
        ]);
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
