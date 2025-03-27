<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = [
            [
                'id' => 1,
                'title' => 'Monk Magazine',
                'client' => 'Monk Media',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'technologies' => ['Vue.js', 'Laravel', 'Tailwind CSS'],
                'image' => '/storage/projects/project1.jpg',
                'video' => '/storage/projects/project1.mp4',
            ],
            [
                'id' => 2,
                'title' => 'Jurassic World',
                'client' => 'Trailer Park for Universal Pictures',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'technologies' => ['Javascript', 'HTML5', 'CSS', 'Backbone/Marionette','Jasmine'],
                'image' => '/storage/projects/project1.jpg',
                'video' => '/storage/projects/project1.mp4',
                'live_demo' => 'https://project1-demo.com'
            ],
            [
                'id' => 3,
                'title' => 'Age Of Adaline',
                'client' => 'Trigger XR for Lionsgate',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'technologies' => ['Vue.js', 'Laravel', 'Tailwind CSS'],
                'image' => '/storage/projects/project1.jpg',
                'video' => '/storage/projects/project1.mp4',
            ],
            [
                'id' => 4,
                'title' => 'Homefront Map',
                'client' => 'Eyestorm Productions for THQ',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'technologies' => ['Vue.js', 'Laravel', 'Tailwind CSS'],
                'image' => '/storage/projects/project1.jpg',
                'video' => '/storage/projects/project1.mp4',
            ],
        ];

        return Inertia::render('Portfolio/Index', [
            'projects' => $projects
        ]);
    }
} 