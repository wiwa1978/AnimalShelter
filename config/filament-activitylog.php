<?php

return [
    'resources' => [
        'label'                  => 'Activiteiten Log',
        'plural_label'           => 'Activiteiten Logs (Ramos)',
        'navigation_group'       => 'Logs',
        'navigation_icon'        => 'heroicon-o-shield-check',
        'navigation_sort'        => null,
        'navigation_count_badge' => false,
        'resource'               => \Rmsramos\Activitylog\Resources\ActivitylogResource::class,
    ],
    'datetime_format' => 'd/m/Y H:i:s',
];
