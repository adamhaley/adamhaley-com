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
                'title' => 'Jurassic World',
                'client' => 'Universal Pictures',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'technologies' => ['Javascript', 'HTML5', 'CSS', 'Backbone/Marionette','Jasmine'],
                'image' => '/storage/projects/project1.jpg',
                'video' => '/storage/projects/project1.mp4',
                'live_demo' => 'https://project1-demo.com'
            ],
            [
                'id' => 2,
                'title' => 'Age Of Adaline',
                'client' => 'Lionsgate',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'technologies' => ['Vue.js', 'Laravel', 'Tailwind CSS'],
                'image' => '/storage/projects/project1.jpg',
                'video' => '/storage/projects/project1.mp4',
                // live_demo is optional - only include it if the project has a demo
                // 'live_demo' => 'https://project1-demo.com'
            ],
            [
                'id' => 3,
                'title' => 'Homefront Map',
                'client' => 'THQ',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'technologies' => ['Vue.js', 'Laravel', 'Tailwind CSS'],
                'image' => '/storage/projects/project1.jpg',
                'video' => '/storage/projects/project1.mp4',
                // live_demo is optional - only include it if the project has a demo
                // 'live_demo' => 'https://project1-demo.com'
            ],
            [
                'id' => 4,
                'title' => 'Monk Magazine',
                'client' => 'Monk Magazine',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'technologies' => ['Vue.js', 'Laravel', 'Tailwind CSS'],
                'image' => '/storage/projects/project1.jpg',
                'video' => '/storage/projects/project1.mp4',
            ],
            // Add more projects here
        ];

        return Inertia::render('Portfolio/Index', [
            'projects' => $projects
        ]);
    }
} 