<?php

use App\Menu;
use App\Page;

function menu() {
    $items = DB::table('menu')->orderBy('order')->get();

    view_cat($items, null);
}

//вывод каталога с помощью рекурсии
function view_cat($arr, $parent_id) {
    //Условия выхода из рекурсии
    if(my_count($arr, $parent_id) == 0) {
        return;
    }

    echo '<ul class="header-nav">';

    //перебираем в цикле массив и выводим на экран
    foreach($arr as $item) {
        if($item->parent_id == $parent_id) {
            echo '<li><a href="/' . Page::where('title', $item->title)->first()->name . '">' .
                $item->title . '</a>';
//        рекурсия - проверяем нет ли дочерних категорий
            view_cat($arr, $item->id);
            echo '</li>';
        }
    }

    echo '</ul>';
}

function my_count($arr, $parent) {
    $i = 0;

    foreach ($arr as $item) {
        if($item->parent_id == $parent) {
            $i++;
        }
    }

    return $i;
}