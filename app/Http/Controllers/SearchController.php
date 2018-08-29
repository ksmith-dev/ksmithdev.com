<?php

namespace App\Http\Controllers;

use stdClass;
use App\Skill;
use App\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SearchController extends Controller
{
    const KEVIN_SMITH_ID = 1;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $skills = Skill::where('user_id', self::KEVIN_SMITH_ID)->get();
        foreach ($skills as $key => $skill)
        {
            $search_term = '/' . strtolower($request->search) . '/';
            if ( preg_match($search_term, strtolower($skill->title)) == 0 &&  preg_match($search_term, strtolower($skill->tasks)) == 0)
            {
                $skills->forget($key);
            }
        }

        $skills = $skills->sortByDesc('updated_at');
        $skills->values()->all();
        $skill_columns = Schema::getColumnListing('skill');

        $experiences = Experience::where('user_id', self::KEVIN_SMITH_ID)->get();
        foreach ($experiences as $key => $experience)
        {
            $search_term = '/' . strtolower($request->search) . '/';
            if (preg_match($search_term, strtolower($experience->title)) == 0
                && preg_match($search_term, strtolower($experience->company_name)) == 0
                && preg_match($search_term, strtolower($experience->city)) == 0
            )
            {
                $experiences->forget($key);
            }
        }

        $experiences = $experiences->sortByDesc('updated_at');
        $experiences->values()->all();
        $experience_columns = Schema::getColumnListing('experience');
        foreach ($skills as $skill)
        {
            if (isset($skill->tasks))
            {
                $json = json_decode($skill->tasks);
                $skill->tasks = $json;
            }
        }

        foreach ($experiences as $experience)
        {
            if (isset($experience->tasks))
            {
                $json = json_decode($experience->tasks);
                $experience->tasks = $json;
            }
        }

        $protected = array('id', 'user_id', 'img_path', 'description', 'created_at','updated_at', 'start_date', 'duration', 'end_date', 'state');

        $navigations = $this->createNavigationCollection(array('skill', 'experience', 'contact'));
        $breadcrumbs = $this->createNavigationCollection(array('/', 'skill', 'experience', 'contact'));

        return view('search', [
            'page_title' => 'SEARCH',
            'navigations' => $navigations,
            'breadcrumbs' => $breadcrumbs,
            'skills' => $skills,
            'skill_columns' => $skill_columns,
            'experiences' => $experiences,
            'experience_columns' => $experience_columns,
            'protected' => $protected
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
