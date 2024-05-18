<?php

namespace App\Helpers;
use App\Models\User;

class CommentHelper
{
    public static function displayReplies($reply, $level = 0)
    {
        // Output the reply content
        echo "<div class=\"bg-gray-100 p-4 rounded-lg ml-8 " . ($level == '0' ? 'mb-4' : '') . "\">";
        echo "<div class=\"flex items-center\">";
        echo "<div>";
        $author = User::find($reply->user_id);
        if ($author){
            echo "<h4 class=\"text-sm text-gray-700 font-semibold\">{$author->username}</h4>";
        }
        echo "<p class=\"text-xs text-gray-500\">{$reply->created_at->diffForHumans()}</p>";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"mt-2\">";
        echo "<p class=\"text-black\">{$reply->content}</p>";
        echo "</div>";

        // Add Reply button
        echo "<div>";
        echo "<button class=\"reply-comment text-blue-500 hover:text-blue-700 font-bold focus:outline-none focus:shadow-outline\" data-reply-id=\"{$reply->id}\">
        REPLY
        </button>";
        

        // Recursively call the function for each sub-reply
        foreach ($reply->replies as $subReply) {
            self::displayReplies($subReply, $level + 1);
        }
        echo "</div>";
        echo "</div>";
    }
}
