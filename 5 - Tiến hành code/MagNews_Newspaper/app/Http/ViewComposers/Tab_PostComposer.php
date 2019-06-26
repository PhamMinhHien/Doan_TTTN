<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Post;

class Tab_PostComposer
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
        $tab_post_hot = $post->getTab_Post_hot();
        $tab_post_time = $post->getTab_Post_time();
        $tab_post_view = $post->getTab_Post_view();
        $view->with('tab_post_hot',$tab_post_hot)->with('tab_post_time',$tab_post_time)->with('tab_post_view',$tab_post_view);
    }
}