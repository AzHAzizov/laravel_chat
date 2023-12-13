<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PostImage extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'post_images';

    public function getUrlAttribute(){
        return url('storage/' . $this->path);
    }


    public static function clearStorage()
    {
        PostImage::where('user_id', auth()->id())->whereNull('post_id')->get()->each(function ($image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        });
    }

}
