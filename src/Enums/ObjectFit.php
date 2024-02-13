<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Enums;

enum ObjectFit: string
{
    case COVER = 'cover';

    case CONTAIN = 'contain';

    case FILL = 'fill';

    case SCALE = 'scale';

    case NONE = 'none';
}
