<?php

namespace Feihuangorg\Config;

use Illuminate\Config\LoaderInterface;
use Illuminate\Config\Repository as RepositoryBase;

class Writer {


    public function writer($item, $value, $environment, $group, $namespace = null,$path= null)
    {
        var_dump(func_get_args());
    }


}
