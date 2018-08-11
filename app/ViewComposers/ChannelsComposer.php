<?php


namespace App\ViewComposers;


use App\Channel;
use Illuminate\Support\Facades\Cache;
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
        $channels = Cache::rememberForever('users', function() {
            return Channel::all();
        });

        $view->with('channels', $channels);
    }
}