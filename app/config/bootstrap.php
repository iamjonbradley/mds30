<?php

// New York Timezone
date_default_timezone_set('America/New_York');

App::build(array(
    // 'models' => array(APP .'models'. DS, APP .'modules'. DS . 'manage'. DS .'models'. DS),
    'plugins' => array(
      ROOT . DS .'plugins'. DS, 
      APP .'modules'. DS
    ),
));