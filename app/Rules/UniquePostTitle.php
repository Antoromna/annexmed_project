<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Post;
use Illuminate\Contracts\Validation\Rule;
class UniquePostTitle implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        return !Post::where('title', $value)->exists();
    }

    public function message()
    {
        return 'The post title must be unique.';
    }
}
