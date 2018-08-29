<?php

namespace App\Http\Controllers;

use stdClass;

class LandingController extends Controller
{
    public function index()
    {
        $navigations = $this->createNavigationCollection(array('skill', 'experience', 'contact'));
        $breadcrumbs = $this->createNavigationCollection(array('skill', 'experience', 'contact'));

        return view('landing', [
            'navigations' => $navigations,
            'breadcrumbs' => $breadcrumbs
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
