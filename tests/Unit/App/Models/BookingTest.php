<?php

namespace Tests\Unit\App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTest extends ModelTestCase
{
    protected function model(): Model
    {
        return new Booking();
    }

    public function traits(): array
    {
        return [
            HasFactory::class,
        ];
    }

    public function fillables(): array
    {
        return [
            'id',
            'class_id',
            'name',
            'date'
        ];
    }

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }

    public function testIncrementingAttribute()
    {
        $this->assertFalse($this->model()->getIncrementing());
    }
}
