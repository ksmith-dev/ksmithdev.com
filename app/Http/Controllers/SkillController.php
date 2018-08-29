<?php

namespace App\Http\Controllers;

use App\User;
use stdClass;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    const KEVIN_SMITH_ID = 1;

    public function skills()
    {
        return $this->returnSkillsView('active');
    }

    public function inactive() {
        return $this->returnSkillsView('inactive');
    }

    private function returnSkillsView(String $status)
    {
        $navigations = $this->createNavigationCollection(
            array(
                'skill' => 'active',
                'experience' => 'inactive',
                'contact' => 'inactive'
            )
        );

        $breadcrumbs = $this->createNavigationCollection(
            array(
                '/' => 'inactive',
                'skill' => 'active',
                'experience' => 'inactive',
                'contact' => 'inactive'
            )
        );

        $user = User::where('id', self::KEVIN_SMITH_ID)->first();

        if (!empty($user)) {
            $skills = $user->skills()->where('status', $status)->get();

            $skills = $skills->sortByDesc('end_date');

            $skills->values()->all();

            foreach ($skills as $skill)
            {
                $json = json_decode($skill->tasks);
                $skill->tasks = $json;
            }


            return view('skill', [
                'page_title' => 'TECHNICAL SKILLS',
                'navigations' => $navigations,
                'breadcrumbs' => $breadcrumbs,
                'skills' => $skills
            ]);
        } else {
            return view('skill', [
                'page_title' => 'TECHNICAL SKILLS',
                'navigations' => $navigations,
                'breadcrumbs' => $breadcrumbs
            ]);
        }
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
