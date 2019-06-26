<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return  void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            'news.partials_page.sidebar', 'App\Http\ViewComposers\SidebarComposer'
        );
        View::composer(
            'news.partials_page.menu', 'App\Http\ViewComposers\MenuComposer'
        );
        View::composer(
            'news.partials_page.slide_post', 'App\Http\ViewComposers\Slide_PostComposer'
        );
        View::composer(
            'news.partials_page.tab_post', 'App\Http\ViewComposers\Tab_PostComposer'
        );
        View::composer(
            'news.partials_page.footer_post', 'App\Http\ViewComposers\Footer_PostComposer'
        );
        View::composer(
            'news.partials_page.tag', 'App\Http\ViewComposers\TagComposer'
        );
        View::composer(
            'news.partials_page.footer', 'App\Http\ViewComposers\FooterComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return  void
     */
    public function register()
    {
        //
    }
}