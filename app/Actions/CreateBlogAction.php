<?php

namespace App\Actions;

use App\DTO\BlogDTO;
use App\Models\Blog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateBlogAction
{
    function __invoke(BlogDTO $dto): Blog
    {
        $user = $dto->user ?? Auth::user();

        return $user->blogs()
            ->create([
                'slug' => $this->createSlug($dto->title),
                'title' => $dto->title,
                'body' => $dto->body,
                'image' => $this->uploadImage($dto->image),
            ]);
    }

    private function createSlug(string $title): string
    {
        $slug = Str::slug($title);

        while (Blog::where('slug', $slug)->exists()) {
            $slug = Str::slug($title.'-'.Str::random(5));
        }

        return $slug;
    }

    private function uploadImage(UploadedFile $image): string
    {
        return Storage::disk('public')
            ->putFile('blogs', $image);
    }
}
