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
                'client' => 'Trailer Park for Universal Pictures',
                'description' => 'I was tasked with creating the SPA-based javascript architecture for the Jurassic World Movie Trailer site. Part of a small team of 4 devs, we created a Backbone/Marionette based structure that drove off json files and served rich video and javascipt animations to create a dynamic simulation of what a real-world park website would look like.                             4 JurassicWorld.com has been visited by over 6 million people, including over 300,000 in a single day; with over 30 million pageviews to date.',
                'technologies' => ['Javascript', 'HTML5', 'CSS', 'Backbone/Marionette','Jasmine'],
                'image' => asset('storage/projects/jurassicworld.test.png'),
                'video' => asset('storage/projects/jurassic-world-reel.mp4'),
            ],
            [
                'id' => 2,
                'title' => 'Monk Magazine',
                'client' => 'Monk Media',
                'description' => 'Monk Magazine is a WordPress based magazine site that I built for Michael Lane and James Crotty - aka "The Mad Monks". It features a custom responsive theme, a WooCommerce store, and a WP-CLI based build system for automated local development.  Michael Lane and James Crotty - aka "The Mad Monks" trusted me with the important task of archiving their career-spanning magazine issues online. I created a dynamic, responsive layout o    n top of a headless Wordpress CMS and WOO-Commerce shopping cart to serve their loyal fan base. Utilizing the WP Cli to manage plugins in the process, I created a beautiful PDF Viewer fe    ature to allow customers to consume their historic magazines online should they choose to purchase the digital format. ',
                'technologies' => ['Javascript', 'Stylus', 'CSS3', 'PHP/MySQL','Wordpress', 'WooCommerce', 'WP Cli'],
                'image' => asset('storage/projects/monkmagazine.com.png'),
                'video' => asset('storage/projects/monk-magazine.mp4'),
                'live_demo' => 'https://monkmagazine.com',
            ],
            [
                'id' => 3,
                'title' => 'Age Of Adaline',
                'client' => 'Trigger Digital for Lionsgate',
                'description' => ' 13 The Age Of Adaline Tumblr theme was an interesting project for Trigger Digital. The idea was to create a scrolling-through-time effect, using historical images already posted to Tumblr,     in the promotion of the film by New Line Cinema starring Blake Lively. One of the unique technical challenges was vertically synching the images based on chronology, while providing a di    fferent scroll rate on the right side and the left side. They wanted an eerie out-of-sync effect to give the sense of time being elastic and relative. We made this radical Tumblr theme u    sing Javascript, BackboneJS, and css all while retaining basic Tumblr functionality. Users could click into posts, like them, comment, and even share them out to social media.',
                'technologies' => ['Javascript', 'HTML5', 'CSS', 'Backbone/Marionette'],
                'image' => asset('storage/projects/ageofadaline.test.png'),
                'video' => asset('storage/projects/age-of-adaline.mp4'),
            ],
            [
                'id' => 4,
                'title' => 'Homefront Map',
                'client' => 'Eyestorm Creative for THQ',
                'description' => 'Homefront Map was a rich online gameified experience created to promote the release of "Homefront: The Revolution". I was tasked with creating an online map of Philadelphia that was sect    ioned off into game zones that would be unlocked one at a time as the user progressed through decision trees to win prizes.  I used Open Street Maps and GDAL Scripts to generate map tile    s, and then overlaid polylines rendered as SVGs over the map. The functionality of the game was created using BackboneJS and a rich data model driven by a backend API written in Laravel.',
                'technologies' => ['Javascript', 'HTML5', 'GDAL/OGR', 'Python', 'OpenStreetMap', 'SVG', 'CSS', 'Backbone/Marionette','Laravel', 'PHP/MySQL'],
                'image' => asset('storage/projects/hftr-11.png'),
                'video' => 'https://www.youtube.com/watch?v=sTZHS2CIfTU',
            ],
        ];

        return Inertia::render('Portfolio/Index', [
            'projects' => $projects
        ]);
    }
} 