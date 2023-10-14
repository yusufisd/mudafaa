<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContentEmojiModel;
use App\Models\EmojiType;
use App\Models\PostType;
use Illuminate\Http\Request;

class EmojiController extends Controller
{
    public function index(Request $request){
        try {
            $ip = 0;
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            $post_type = "";
            switch ($request->post_type) {
                case "news":
                    $post_type = PostType::NEWS;
                    break;
                case "defense":
                    $post_type = PostType::DEFENSE_INDUSTRY;
                    break;
                case "interview":
                    $post_type = PostType::INTERVIEWS;
                    break;
                case "video":
                    $post_type = PostType::VIDEOS;
                    break;
            }

            $emoji_type = "";
            switch ($request->emoji_type) {
                case "love":
                    $emoji_type = EmojiType::LOVE;
                    break;
                case "clap":
                    $emoji_type = EmojiType::CLAP;
                    break;
                case "sad":
                    $emoji_type = EmojiType::SAD;
                    break;
                case "dislike":
                    $emoji_type = EmojiType::DISLIKE;
                    break;
                case "angry":
                    $emoji_type = EmojiType::ANGRY;
                    break;
                case "shocked":
                    $emoji_type = EmojiType::SHOCKED;
                    break;
            }

            $checkEmoji = ContentEmojiModel::where('ip_address', $ip)->where('post_id', $request->post_id)->orderBy('updated_at','asc')->get();
            if (count($checkEmoji) >= 3) {
                $proc = ContentEmojiModel::where('id', $checkEmoji[0]->id)->update([
                    "emoji_type" => $emoji_type
                ]);
            } else {
                $proc = ContentEmojiModel::create([
                    "emoji_type" => $emoji_type,
                    "post_id" => $request->post_id,
                    "post_type" => $post_type,
                    "ip_address" => $ip
                ]);
            }

            if ($proc) {
                return response()->json(["status" => "success"]);
            } else {
                return response()->json(["status" => "error", "message" => "Tepki gönderilemedi"]);
            }
        }catch (\Exception $exception){
            return response()->json(["status" => "error", "message" => $exception->getMessage()]);
        }

    }
}
