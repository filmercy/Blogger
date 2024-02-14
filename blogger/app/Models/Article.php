<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    public static array $rules =[
        'title' => 'required|string|max:255',
        'extract' => 'required|string|max:255',
        'body' => 'required|string|max:65535',
        'cover' => [
            'required', // Remove this if the cover is not required for updates
            'file',
            'mimes:jpg,jpeg,png,webp', // Specify allowed file types
            'max:2048', // Maximum file size in kilobytes. 2048 KB = 2 MB
        ],
    ];

    protected $fillable=[
      'title',
        'extract',
        'body',
        'published',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publishedUntil' => 'datetime'
    ];

   public function user(): BelongsTo
   {
       return  $this->belongsTo(User::class);
   }
}
