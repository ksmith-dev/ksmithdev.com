<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use stdClass;
use App\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    const KEVIN_SMITH_ID = 1;

    public function experiences()
    {
        $user = User::where('id', self::KEVIN_SMITH_ID)->first();
        $inactive_experiences = Experience::where('user_id', $user->id)->where('end_date', '<', date('Y-m-d H:i:s', strtotime('-7 years')))->get();

        if ($inactive_experiences->count() > 0)
        {
            foreach ($inactive_experiences as $experience)
            {
                $experience->status = 'inactive';
                $experience->save();
            }
        }

        $experiences = Experience::where('user_id', $user->id)->where('end_date', '>', date('Y-m-d H:i:s', strtotime('-7 years')))->get();

        return $this->returnExperienceView($experiences);
    }

    public function inactive()
    {
        $user = User::where('id', self::KEVIN_SMITH_ID)->first();
        $inactive_experiences = Experience::where('user_id', $user->id)->where('status', 'inactive')->get();
        return $this->returnExperienceView($inactive_experiences);
    }

    /**
     * @param Collection $experiences
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function returnExperienceView(Collection $experiences)
    {
        $navigations = $this->createNavigationCollection(array('skill', 'experience', 'contact'));
        $breadcrumbs = $this->createNavigationCollection(array('/', 'skill', 'experience', 'contact'));

        if (isset($experiences)) {
            $experiences = $experiences->sortByDesc('end_date');
            $experiences->values()->all();

            foreach ($experiences as $experience)
            {
                $json = json_decode($experience->tasks);
                $experience->tasks = $json;
            }

            return view('experience', [
                'page_title' => 'EXPERIENCE',
                'navigations' => $navigations,
                'breadcrumbs' => $breadcrumbs,
                'experiences' => $experiences
            ]);
        } else {
            return view('experience', [
                'page_title' => 'EXPERIENCE',
                'navigations' => $navigations,
                'breadcrumbs' => $breadcrumbs
            ]);
        }

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
