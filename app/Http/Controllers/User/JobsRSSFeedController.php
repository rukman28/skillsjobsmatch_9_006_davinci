<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Feeds;

class JobsRSSFeedController extends Controller
{
    public function showMedicineJobs(){
        $feed = Feeds::make('https://www.jobs.ac.uk/jobs/medicine-and-dentistry?format=rss');
        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );
        return view('user.rss.show_jobs', $data);
    }

    public function showAnatomyPhysiologyPathologyJobs(){
        $feed = Feeds::make('https://www.jobs.ac.uk/jobs/anatomy-physiology-and-pathology/?format=rss');
        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );
        return view('user.rss.show_jobs', $data);
    }

    public function showPharmacologyToxicologyPharmacyJobs(){
        $feed = Feeds::make('https://www.jobs.ac.uk/jobs/pharmacology-toxicology-and-pharmacy/?format=rss');
        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );
        return view('user.rss.show_jobs', $data);
    }

    public function showNutritionJobs(){
        $feed = Feeds::make('https://www.jobs.ac.uk/jobs/nutrition/?format=rss');
        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );
        return view('user.rss.show_jobs', $data);
    }

    public function showNursingJobs(){
        $feed = Feeds::make('https://www.jobs.ac.uk/jobs/nursing/?format=rss');
        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );
        return view('user.rss.show_jobs', $data);
    }

    public function showMedicalTechnology(){
        $feed = Feeds::make('https://www.jobs.ac.uk/jobs/biology/?format=rss');
        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );
        return view('user.rss.show_jobs', $data);
    }
}
