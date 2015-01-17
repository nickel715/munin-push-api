<?php

namespace MuninPushApi;

use MuninPushApi\Config;

/**
 *
 */
class Get extends Base {

    public function getRawValues() {

        $output = [];

        foreach ($this->getGraph()->label as $labelKey => $label) {

            $value = Redis::getRedis()->get($this->getRedisKey($labelKey));

            if (is_numeric($value)) {
                $output[] = $labelKey.'.value '.$value;
            }

        }

        return implode(PHP_EOL, $output);

    }

    public function getRawConfig() {

        $output = [];

        foreach ($this->getGraph()->config as $key => $value) {
            $output[] = $key.' '.$value;
        }

        foreach ($this->getGraph()->label as $labelKey => $label) {
            $output[] = $labelKey.'.label '.$label;
        }

        return implode(PHP_EOL, $output);

    }

}
