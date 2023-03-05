<?php

namespace Brycedev\Peek\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class RequestRecord extends Model
{
    protected $appends = [
        'short_action',
    ];
    protected $guarded = [];
    protected $table = 'peek_request_records';

    protected function headers(): Attribute
    {
        $headers = isset($this->attributes['headers']) 
            ? json_decode($this->attributes['headers']) 
            : new stdClass();
        return Attribute::make(
            get: fn () => array_map(function($x){ return $x[0]; }, collect($headers)->toArray()),
        );
    }

    protected function payload(): Attribute
    {
        $payload = isset($this->attributes['payload']) 
            ? json_decode($this->attributes['payload']) 
            : [];
        return Attribute::make(
            get: fn () => $payload,
        );
    }

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
