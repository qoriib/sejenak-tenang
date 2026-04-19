<?php

namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\User\ChatController as UserChatController;

class ChatController extends UserChatController
{
    // Inherit semua method dari UserChatController
    // karena logic chat sama untuk user dan psychologist
}
