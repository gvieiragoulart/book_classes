<?php

namespace Tests\Unit\App\Models;

use App\Models\Classes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassesTest extends ModelTestCase
{
    protected function model(): Model
    {
        return new Classes();
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
            'name',
            'description',
            'start_date',
            'end_date',
            'capacity',
        ];
    }

    protected function casts(): array
    {
        return [
            'start_date'    => 'datetime',
            'end_date'     => 'datetime',
        ];
    }

    public function testIncrementingAttribute()
    {
        $this->assertFalse($this->model()->getIncrementing());
    }
}
