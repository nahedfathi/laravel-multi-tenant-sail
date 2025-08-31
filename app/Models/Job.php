<?php 
namespace App\Models;

use App\Jobs\SyncJobToElasticsearch;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Job extends Model
{
    use  Searchable;

    protected $fillable = ['title', 'description', 'location'];

    public function toSearchableArray(): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'location'    => $this->location,
        ];
    }
    public function searchableAs(): string
    {
        return 'tenant_' . tenant('id') . '_jobs';
    }
}
