<?php

use App\User;
use App\Option;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
    $model->setTitle('users');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('name')->setLabel('Name')->setWidth('400px'),
            //setAttribute('class', 'text-muted')
            AdminColumn::text('email')->setLabel('Email'),
        ]);
        $display->paginate(15);

        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Name')->required()->unique(),
            AdminFormElement::text('email', 'Email')
//            AdminFormElement::text('phone', 'Phone')
        );

        return $form;
    });

    $model->created(function(ModelConfiguration $model, User $user) {

    });
});
   /* ->addMenuPage(Company::class, 0)
    ->setIcon('fa fa-bank');*/

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