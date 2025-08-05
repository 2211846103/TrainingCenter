<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;
use Str;

class ImageService
{
    static string $placeholderId = 'placeholder';
    static int $width = 960, $height = 540;

    public static function generate(string $id = null, string $text = "Placeholder")
    {
        $image = ImageManager::gd()->create(static::$width, static::$height)->fill(substr(md5($text), 0, 6));
        $image->text(Str::upper($text), static::$width / 2, static::$height / 2, function (FontFactory $font) {
            $font->filename(public_path('fonts/Poppins-Medium.ttf'));
            $font->size(48);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('center');
        });

        $encoded = $image->encodeByExtension('jpg');
        $filename = 'misc/' . ($id ?: static::$placeholderId) . '.jpg';

        Storage::disk('public')->put($filename, $encoded);

        return $filename;
    }

    public static function storeCourseThumbnail(string $id, UploadedFile $file)
    {
        $image = ImageManager::gd()->read($file)
                                        ->resize(static::$width, static::$height)
                                        ->encodeByExtension('jpg');
        
        $filename = 'thumbnails/' . ($id ?: static::$placeholderId) . '.jpg';

        Storage::disk('public')->put($filename, $image);

        return $filename;
    }

    public function storeUserProfilePic(string $id, UploadedFile $file)
    {
        $image = ImageManager::gd()->read($file)
                                        ->resize(static::$width, static::$height)
                                        ->encodeByExtension('jpg');
        
        $filename = 'profile_images/' . ($id ?: static::$placeholderId) . '.jpg';

        Storage::disk('public')->put($filename, $image);

        return $filename;
    }
}