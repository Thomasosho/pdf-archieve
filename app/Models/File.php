<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    use Searchable;

    /**
     * Get the index name for the model
     */
    public function searchableAs()
    {
        return 'file_index';
    }
}
