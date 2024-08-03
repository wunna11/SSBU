<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class FileStatus extends Enum
{
    const Pending = 0;
    const Approved = 1;
    const Reject = 2;
}
