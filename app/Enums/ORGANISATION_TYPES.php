<?php

namespace App\Enums;

use App\Traits\HasNameAsOptions;

enum ORGANISATION_TYPES: string
{
    use HasNameAsOptions;

    case SOLE_PROP = 'Sole Proprietorship';
    case PRIVATE = 'Private Company';
    case PUBLIC = 'Public Company';
    case STATE = 'State Owned Enterprise';
    case INC = 'Personal Liability Company';
    case CC = 'Close Corporation';
    case NPC = 'Non Profit Company';
    case TRUST = 'Trust';
    case OTHER = 'Other';
}
