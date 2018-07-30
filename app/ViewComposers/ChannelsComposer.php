<?php


namespace App\ViewComposers;


use App\Channel;
use Illuminate\View\View;

class ChannelsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('channels', Channel::all());
    }
}