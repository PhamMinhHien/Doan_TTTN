<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Post;


class Footer_PostComposer
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
        $footer_post_new = $post->getFooter_PostNew();
        $view->with('footer_post_new',$footer_post_new);
    }
}