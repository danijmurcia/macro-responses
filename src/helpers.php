<?php
if (!function_exists('getErrorMessagesByCode')) {

    /**
     * Get error|warning messages via configuration file codes
     *
     * @param array $warnings
     * @return object|array messages
     */
    function getErrorMessagesByCode(array $warnings = []): object|array
    {
        $config_codes = config('responses.codes');
        $messages = collect();

        foreach ($warnings as $warning) {
            if (array_key_exists($warning['code'], $config_codes)) {
                $messages->push(['code' => $warning['code'], 'message' => __($config_codes[$warning['code']], $warning['vars'] ?? [])]);
            }
        }

        return !empty($messages) ? $messages : [];
    }
}