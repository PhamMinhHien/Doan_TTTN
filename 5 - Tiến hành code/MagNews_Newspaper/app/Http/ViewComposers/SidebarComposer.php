<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Tag;
use App\Models\Post;

class SidebarComposer
{
    /**
     * The user repository implementation.
     *
     * @var  UserRepository
     */

    /**
     * Create a new profile composer.
     *
     * @param    UserRepository  $users
     * @return  void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        //$this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param    View  $view
     * @return  void
     */
    public function compose(View $view)
    {
        $posts = new Post();
        $post = $posts->getPost_Popular();
        $view->with('post',$post);
    }
}