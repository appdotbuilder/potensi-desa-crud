<?php

arch()->preset()->php()->ignoring(['dd', 'dump']);
arch()->preset()->security()->ignoring(['array_rand', 'parse_str', 'mt_rand', 'uniqid', 'sha1']);

arch('models should have proper documentation')
    ->expect('App\Models')
    ->toHavePropertiesDocumented();