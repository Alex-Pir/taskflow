<?php

namespace Domain\Task\DTOs;

use Carbon\Carbon;
use Carbon\CarbonInterface;

trait FeasibleTask
{
    public static function make(array $data): self
    {
        if (!isset($data['dateEnd'])) {
            return new self(...$data);
        }

        if (!Carbon::canBeCreatedFromFormat($data['dateEnd'], self::DATE_FORMAT)) {
            $data['dateEnd'] = null;
        }

        if (!($data['dateEnd'] instanceof CarbonInterface) && !is_null($data['dateEnd'])) {
            $data['dateEnd'] = Carbon::createFromFormat(self::DATE_FORMAT, $data['dateEnd']);
        }

        return new self(...$data);
    }
}
