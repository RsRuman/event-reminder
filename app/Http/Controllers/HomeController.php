<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Interfaces\HomeInterface;
use Illuminate\Contracts\View\View;

#[AllowDynamicProperties]
class HomeController extends Controller
{
    public function __construct(HomeInterface $home)
    {
        $this->home = $home;
    }

    /**
     * Dashboard or Home
     * @return View
     */
    public function index(): View
    {
        $completedEvent = $this->home->getCompletedEvent();
        $upcomingEvent  = $this->home->getUpcomingEvent();

        return view('index', compact('completedEvent', 'upcomingEvent'));
    }
}
