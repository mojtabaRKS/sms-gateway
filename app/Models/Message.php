<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    public const INIT_STATUS = 'init';
    public const SUCCESS_STATUS = 'success';
    public const FAILURE_STATUS = 'failure';

    protected $fillable = [
        'message',
        'phone_number',
        'status',
        'response',
        'service'
    ];
}
