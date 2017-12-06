<?php

use Illuminate\Support\Facades\Gate;
use App\Info;
use App\User;
use App\Option;
use App\Article;
use App\Page;
use App\Menu;
use App\Status;
use App\Mail\UserRegistration;
use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Display\DisplayTree;
use Illuminate\Support\Facades\Crypt;

AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
    $model->enableAccessCheck();
    $model->setTitle('users');

    // Display
    $model->onDisplay(function () {
        /*$display = AdminDisplay::table()->setColumns([
            AdminColumn::link('name')->setLabel('Name')->setWidth('400px'),
            AdminColumn::text('email')->setLabel('Email'),
        ]);*/
        $display = AdminDisplay::datatablesAsync()->setDisplaySearch(true)->paginate(20);

        $display->setColumns([
            AdminColumn::link('name')->setLabel('Name')->setWidth('400px'),
            AdminColumn::text('email')->setLabel('Email'),
        ]);

        return $display;
    });

    // Create And Edit
    $model->onCreate(function() {
        $pass = str_random(8);

        do {
            $number = mt_rand(10000000, 99999999);
        }
        while(User::where('id', $number)->first());

        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Name')->required()->unique(),
            AdminFormElement::hidden('info.id')->setDefaultValue($number),
            AdminFormElement::select('info.male', 'Male', ['man' => 'man', 'woman' => 'woman'])->required(),
            AdminFormElement::text('email', 'Email')->required()->unique(),
            AdminFormElement::hidden('password')->setDefaultValue($pass),
            AdminFormElement::select('role', 'Role', ['user' => 'user', 'redactor' => 'redactor', 'admin' => 'admin'])->required(),
            AdminFormElement::date('info.age', 'Birthday'),
            AdminFormElement::text('info.country', 'Country'),
            AdminFormElement::text('info.city', 'City'),
            AdminFormElement::number('info.weight', 'Weight'),
            AdminFormElement::number('info.height', 'Height'),
            AdminFormElement::select('info.zodiac', 'Zodiac', ['Pisces' => 'Pisces',
                                                                'Aquarius' => 'Aquarius',
                                                                'Aries' => 'Aries',
                                                                'Taurus' => 'Taurus',
                                                                'Gemini' => 'Gemini',
                                                                'Cancer' => 'Cancer',
                                                                'Leo' => 'Leo',
                                                                'Virgo' => 'Virgo',
                                                                'Libra' => 'Libra',
                                                                'Scorpio' => 'Scorpio',
                                                                'Sagittarius' => 'Sagittarius',
                                                                'Capricorn' => 'Capricorn'
                                                                ]),
            AdminFormElement::select('info.body_type', 'Body Type', ['Slim' => 'Slim',
                                                                        'Thin' => 'Thin',
                                                                        'Thick' => 'Thick',
                                                                        'Full' => 'Full'
                                                                    ]),
            AdminFormElement::select('info.hair_color', 'Hair Color', ['Brown-haired' => 'Brown-haired',
                                                                        'Blonde' => 'Blonde',
                                                                        'Red-haired' => 'Red-haired',
                                                                        'Brunette' => 'Brunette',
                                                                        'Dyed' => 'Dyed'
                                                                        ]),
            AdminFormElement::select('info.eyes_color', 'Eyes Color', ['Green' => 'Green',
                                                                            'Brown' => 'Brown',
                                                                            'Gray' => 'Gray',
                                                                            'Blue' => 'Blue',
                                                                            'Black' => 'Black',
                                                                            'Yellow' => 'Yellow'
                                                                        ]),
            AdminFormElement::select('info.skin_color', 'Skin Color', ['Green' => 'Green',
                                                                            'Brown' => 'Brown',
                                                                            'Gray' => 'Gray',
                                                                            'Blue' => 'Blue',
                                                                            'Black' => 'Black',
                                                                            'Yellow' => 'Yellow'
                                                                        ]),
            AdminFormElement::select('info.marital_status', 'Marital Status', ['Not married' => 'Not married',
                                                                                    'Married' => 'Married',
                                                                                    'Actively searching' => 'Actively searching',
                                                                                    'Divorced' => 'Divorced'
                                                                                ]),
            AdminFormElement::select('info.children', 'Children', ['Have' => 'Have',
                                                                        'Haven`t' => 'Haven`t'
                                                                    ]),
            AdminFormElement::select('info.attitude_to_alcohol', 'Attitude to Alcohol', ['Compromise' => 'Compromise',
                                                                                            'Negative' => 'Negative',
                                                                                            'Neutral' => 'Neutral',
                                                                                            'Positive' => 'Positive',
                                                                                        ]),
            AdminFormElement::select('info.attitude_to_smoking', 'Attitude to Smoking', ['Compromise' => 'Compromise',
                                                                                            'Negative' => 'Negative',
                                                                                            'Neutral' => 'Neutral',
                                                                                            'Positive' => 'Positive',
                                                                                        ]),
            AdminFormElement::select('info.religious_views', 'Religious Views', ['Catholicism' => 'Catholicism',
                                                                                    'Judaism' => 'Judaism',
                                                                                    'Orthodoxy' => 'Orthodoxy',
                                                                                    'Protestantism' => 'Protestantism',
                                                                                    'Islam' => 'Islam',
                                                                                    'Buddhism' => 'Buddhism',
                                                                                    'Confucianism' => 'Confucianism',
                                                                                ]),
            AdminFormElement::select('info.my_priorities', 'Priorities', ['Family and kids' => 'Family and kids',
                                                                                    'Communication' => 'Communication',
                                                                                    'Traveling' => 'Traveling',
                                                                                    'Friendship' => 'Friendship'
                                                                                ])
        )->setAction(route('sent'));

        return $form;
    });

    $model->onEdit(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Name')->required()->unique(),
            AdminFormElement::text('email', 'Email'),
            AdminFormElement::select('role', 'Role', ['user' => 'user', 'redactor' => 'redactor', 'admin' => 'admin']),
            AdminFormElement::select('status.banned', 'Status Banned', ['1' => 'Banned', '0' => 'Not Banned'])
        );

        return $form;
    });

    // Запрет на удаление
    $model->disableDeleting();
});

AdminSection::registerModel(Article::class, function (ModelConfiguration $model) {
    $model->setTitle('Blog');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()
            ->setModelClass(Article::class) // Обязательно необходимо указать класс модели в которой хранятся фотографии
            ->setApply(function($query) {
                $query->where('user_id', 0); // Фильтруем список фотографий по ID галереи
            })
            ->setColumns([
                AdminColumn::link('title')->setLabel('Title')->setWidth('400px'),
                AdminColumn::text('content')->setLabel('Content'),
            ]);
        $display->paginate(15);

        return $display;
    });

    // Create
    $model->onCreate(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::hidden('user_id', 'user_id')->setHtmlAttribute('value', '0'),
            AdminFormElement::text('title', 'Title')->required()->unique(),
            AdminFormElement::ckeditor('content', 'Content'),
            AdminFormElement::image('thumbnail', 'Thumbnail')
        );

        return $form;
    });

    //  Edit
    $model->onEdit(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('title', 'Title')->required()->unique(),
            AdminFormElement::ckeditor('content', 'Content'),
            AdminFormElement::image('thumbnail', 'Thumbnail')
        );

        return $form;
    });
})
    ->addMenuPage(Article::class, 0)
    ->setIcon('fa fa-bank');

AdminSection::registerModel(Option::class, function (ModelConfiguration $model) {
    $model->setTitle('Options');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('menu')->setLabel('Name')->setWidth('400px'),
            //setAttribute('class', 'text-muted')
//            AdminColumn::text('email')->setLabel('Email'),
        ]);
        $display->paginate(15);

        return $display;
    });
    // Create And Edit
    $model->onCreate(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('menu', 'Menu')->required()
        );

        return $form;
    });
})
    ->addMenuPage(Option::class, 0)
    ->setIcon('fa fa-bank');

AdminSection::registerModel(Page::class, function (ModelConfiguration $model) {
    $model->setTitle('Pages');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('title')->setLabel('Title')->setWidth('400px'),
            AdminColumn::text('created_at')->setLabel('Date'),
        ]);
        $display->paginate(15);

        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Url')->required(),
            AdminFormElement::text('title', 'Title'),
            AdminFormElement::ckeditor('content', 'Content')
        );

        return $form;
    });
})
    ->addMenuPage(Page::class, 0)
    ->setIcon('fa fa-bank');

AdminSection::registerModel(Menu::class, function (ModelConfiguration $model) {
    $model->setTitle('Menu');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::tree()->setValue('title');

        return $display;
    });

    // Create And Edit
    $model->onCreate(function() {
        $pages = Page::all();
        $item = [];

        foreach($pages as $page) {
            $item[$page->title] = $page->title;
        }

        print_r($item);

        $form = AdminForm::form()->setElements([
            AdminFormElement::select('title', 'Page', $item)
//                ->setModelForOptions(Page::class, 'title')
                ->setEnum($item)
        ]);

        return $form;
    });
})
    ->addMenuPage(Menu::class, 0)
    ->setIcon('fa fa-bank');