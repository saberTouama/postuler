<?php
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id; // Ensure the authenticated user is the one who has access
});

Broadcast::channel('my-channel', function () {
    return true;  // This channel is public, you can adjust permissions accordingly.
});
// routes/channels.php

Broadcast::channel('chat', function ($user) {
    return Auth::check();
  });
  