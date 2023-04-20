<?php

declare(strict_types=1);


return [
    'check_num' =>  2, // 默认检测数量
    'default'   =>   [
        'rule'  =>  [
            'normal_arr'    =>  [
                [0,9]
            ],
            'normal' => [

            ],
            'spectail_arr_char'    =>  [
                ['12800', '13055'],
                ['880', '1023'],
                ['3584;', '3711;'],
                ['1280;', '1327;'],
                ['12690;', '12693;'],
                ['8704;', '8959;'],
                ['384;', '591;'],
                ['9984;', '10175;'],
                ['127232;', '127487;'],
                ['9312;', '9371;'],
                ['9312;', '9471;'],
                ['8544;', '8555;'],
                ['119808;', '120831;'],
            ],
            'spectail_char'   =>  [
                '127328',
                '127360;',
                '63922;',
                '19968;',
                '20108;',
                '19977;',
                '22235;',
                '20116;',
                '20845;',
                '19971;',
                '20843;',
                '20061;',
                '21313;',
                '38646;',
                '22777;',
                '21441;',
                '36144;',
                '32902;',
                '20237;',
                '38470;',
                '26578;',
                '25420;',
                '29590;',
                '25342;',
                '128039;',
            ],
        ]
    ],
];