<?php

namespace App\DTO;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class BlogDTO extends DataTransferObject
{
    public string $title;

    public string $body;

    public UploadedFile $image;

    public ?User $user;
}
