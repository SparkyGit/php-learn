<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/3/2018
 * Time: 4:29 PM
 */

namespace MyProject\Controllers;


use MyProject\Models\Articles\Article;
use MyProject\Models\Categories\Category;
use MyProject\Models\Tags\Tag;
use MyProject\Services\UsersAuthService;
use MyProject\View\View;

class AbstractController
{
    protected $view;
    protected $user;
    protected $popularArticles;
    protected $tagsAll;
    protected $categories;

    public function __construct()
    {
        $this->categories = Category::getAll();
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->popularArticles = Article::getPopularArticles();
        $this->tagsAll = Tag::getAll();

        $this->view->setExtraVars('title', $this->title);
        $this->view->setExtraVars('categories', $this->categories);
        $this->view->setExtraVars('user', $this->user);
        $this->view->setExtraVars('popularArticles', $this->popularArticles);
        $this->view->setExtraVars('tagsAll', $this->tagsAll);
    }
}