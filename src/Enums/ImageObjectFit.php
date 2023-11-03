<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Enums;

enum ImageObjectFit: string
{
    case COVER = 'cover';

    case CONTAIN = 'contain';

    case FILL = 'fill';

    case SCALE = 'scale';

    case NONE = 'none';
}
