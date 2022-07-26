<?php

namespace App\Listeners;

use App\Events\ShowCreated as EventsShowCreated;
use App\Mail\ShowCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class EmailUsersAboutShowCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EventsShowCreated $event)
    {
        $userList = User::all();
        foreach ($userList as $index => $user) {
            $email = new ShowCreated(
                $event->showName,
                $event->showId,
                $event->showSeasonsQty,
                $event->showEpisodesPerSeason,
            );
            $when = now()->addSeconds($index * 5);
            Mail::to($user)->later($when, $email);
        }
    }
}
