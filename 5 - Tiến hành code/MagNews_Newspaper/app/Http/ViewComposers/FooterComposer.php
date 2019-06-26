<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Post;
use App\Models\Category;


class FooterComposer
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
        $post = new Post();
        $post_footer = $post->getFooter_Post();

        $category = new Category();
        $parents = $category->getParents();
        $parents = $category->getChilds($parents);
        $view->with('post_footer',$post_footer)->with('dataMenu', $parents);
    }
}