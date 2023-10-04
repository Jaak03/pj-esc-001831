<?php

namespace App\Enums;

use App\Traits\HasNameAsOptions;

enum BANK_ACCOUNT_TYPES
{
    use HasNameAsOptions;

    case CHEQUE;
    case SAVINGS;
    case TRANSMISSION;
    case BOND;
}
