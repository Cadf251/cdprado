<?php

namespace App\Enums;

enum ProjectSyncStatus: string
{
    case SUCCESS = 'success';
    case FAILED = 'failed';
    case PENDING = 'pending';
}