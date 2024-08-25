<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $body
 *
 */
class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'body',
    ];

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        // Format dates as you need them
        $array['created_at'] = $this->created_at->format('Y-m-d H:i:s');
        $array['updated_at'] = $this->updated_at->format('Y-m-d H:i:s');

        return $array;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
