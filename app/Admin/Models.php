<?php

use Illuminate\Support\Facades\Gate;
use App\User;
use App\Option;
use App\Article;
use App\Page;
use App\Menu;
use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Display\DisplayTree;

AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
    $model->enableAccessCheck();
    $model->setTitle('users');

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('name')->setLabel('Name')->setWidth('400px'),
            AdminColumn::text('email')->setLabel('Email'),
        ]);
        $display->paginate(15);

        return $display;
    });

    // Create And Edit
    $model->onCreate(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Name')->required()->unique(),
            AdminFormElement::text('email', 'Email'),
            AdminFormElement::password('password', 'Password')->allowEmptyValue()->hashWithBcrypt(),
            AdminFormElement::select('role', 'Role', ['user' => 'user', 'redactor' => 'redactor', 'admin' => 'admin'])
        );

        return $form;
    });

    $model->onEdit(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Name')->required()->unique(),
            AdminFormElement::text('email', 'Email'),
            AdminFormElement::select('role', 'Role', ['user' => 'user', 'redactor' => 'redactor', 'admin' => 'admin'])
        );

        return $form;
    });

    // Запрет на удаление
    $model->disableDeleting();

    $model->created(function(ModelConfiguration $model, User $user) {

    });
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
    // Create And Edit
    $model->onEdit(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('title', 'Title')->required()->unique(),
            AdminFormElement::ckeditor('content', 'Content')
        );

        return $form;
    });

    $model->created(function(ModelConfiguration $model, User $user) {

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
//            AdminFormElement::text('email', 'Email')
//            AdminFormElement::text('phone', 'Phone')
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
            AdminFormElement::text('name', 'Name')->required(),
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
    $model->onCreateAndEdit(function() {
        $pages = Page::all();

        foreach($pages as $page) {
            $item[$page->title] = $page->title;
        }

        $form = AdminForm::form()->setElements([
            AdminFormElement::select('title', 'Page', $item)
//                ->setModelForOptions(Page::class, 'title')
//                ->setEnum($item)
        ]);

        return $form;
    });
})
    ->addMenuPage(Menu::class, 0)
    ->setIcon('fa fa-bank');