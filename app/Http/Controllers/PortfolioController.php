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
                'technologies' => ['Javascript', 'Stylus', 'CSS3', 'PHP/MySQL','Wordpress', 'WooCommerce', 'WP Cli'],
                'image' => asset('storage/projects/monkmagazine.com.png'),
                'video' => asset('storage/projects/monk-magazine.mp4'),
                'live_demo' => 'https://monkmagazine.com',
            ],
            [
                'id' => 2,
                'title' => 'Jurassic World',
                'client' => 'Trailer Park for Universal Pictures',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'technologies' => ['Javascript', 'HTML5', 'CSS', 'Backbone/Marionette','Jasmine'],
                'image' => asset('storage/projects/jurassicworld.test.png'),
                'video' => asset('storage/projects/jurassic-world-reel.mp4'),
            ],
            [
                'id' => 3,
                'title' => 'Age Of Adaline',
                'client' => 'Trigger Digital for Lionsgate',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'technologies' => ['Javascript', 'HTML5', 'CSS', 'Backbone/Marionette','Jasmine'],
                'image' => asset('storage/projects/ageofadaline.test.png'),
                'video' => asset('storage/projects/age-of-adaline.mp4'),
            ],
            [
                'id' => 4,
                'title' => 'Homefront Map',
                'client' => 'Eyestorm Creative for THQ',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'technologies' => ['Javascript', 'HTML5', 'GDAL/OGR', 'Python', 'OpenStreetMap', 'SVG', 'CSS', 'Backbone/Marionette','Jasmine'],
                'image' => asset('storage/projects/hftr-11.png'),
                'video' => 'https://www.youtube.com/watch?v=sTZHS2CIfTU',
            ],
        ];

        return Inertia::render('Portfolio/Index', [
            'projects' => $projects
        ]);
    }
} 