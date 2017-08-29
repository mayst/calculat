<?php

use SleepingOwl\Admin\Navigation\Page;

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
// 	   return auth()->user()->isSuperAdmin();
// });
//
// AdminNavigation::addPage(\App\User::class)->setTitle('asd')->setPages(function(Page $page) {
// 	  $page
//		  ->addPage()
//	  	  ->setTitle('ASD')
//		  ->setUrl(route('admin.asd'))
//		  ->setPriority(100);
//
//	  $page->addPage(\App\User::class);
// });
//
// // or
//
// AdminSection::addMenuPage(\App\User::class);

return [
    [
        'title' => 'Dashboard',
        'icon'  => 'fa fa-dashboard',
        'url'   => route('admin.dashboard'),
    ],

    [
        'title' => 'Information',
        'icon'  => 'fa fa-exclamation-circle',
        'url'   => route('admin.information'),
    ],

    /*[
        'title' => 'Users',
        'icon'  => 'fa fa-user-o',
        'url'   => route('admin.users'),
    ],*/

    [
        'title' => 'Users',
        'icon' => 'fa fa-group',
        'pages' => [
            (new Page(\App\User::class))
                ->setIcon('fa fa-user')
                ->setPriority(0),
            (new Page(Company::class))
                ->setIcon('fa fa-group')
                ->setPriority(100),
            (new Page(Company::class))
                ->setIcon('fa fa-group')
                ->setPriority(200)
        ]
    ],

    /*[
        'title' => 'Options',
        'icon' => 'fa fa-group',
        'page' => (new Page(\App\Option::class))
                    ->setIcon('fa fa-user')
                    ->setPriority(0),
    ]*/

    // Examples
    // [
    //    'title' => 'Content',
    //    'pages' => [
    //
    //        \App\User::class,
    //
    //        // or
    //
    //        (new Page(\App\User::class))
    //            ->setPriority(100)
    //            ->setIcon('fa fa-user')
    //            ->setUrl('users')
    //            ->setAccessLogic(function (Page $page) {
    //                return auth()->user()->isSuperAdmin();
    //            }),
    //
    //        // or
    //
    //        new Page([
    //            'title'    => 'News',
    //            'priority' => 200,
    //            'model'    => \App\News::class
    //        ]),
    //
    //        // or
    //        (new Page(/* ... */))->setPages(function (Page $page) {
    //            $page->addPage([
    //                'title'    => 'Blog',
    //                'priority' => 100,
    //                'model'    => \App\Blog::class
	//		      ));
    //
	//		      $page->addPage(\App\Blog::class);
    //	      }),
    //
    //        // or
    //
    //        [
    //            'title'       => 'News',
    //            'priority'    => 300,
    //            'accessLogic' => function ($page) {
    //                return $page->isActive();
    //		      },
    //            'pages'       => [
    //
    //                // ...
    //
    //            ]
    //        ]
    //    ]
    // ]
];