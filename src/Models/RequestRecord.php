<?php

namespace Brycedev\Peek\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class RequestRecord extends Model
{
    protected $appends = [
        'short_action',
    ];
    protected $guarded = [];
    protected $table = 'peek_request_records';

    protected function shortAction(): Attribute
    {
        $action = $this->attributes['action'];
        return Attribute::make(
            get: fn () => substr($action, strrpos($action, '\\') + 1),
        );
    }

    public function scopeStale($query)
    {
        return $query->where('created_at', '<', now()->subDays(config('peek.archival_period')));
    }
}
