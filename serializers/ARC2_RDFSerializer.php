<?php

/*
 *  This file is part of the quickrdf/InMemoryStoreSqlite package and licensed under
 *  the terms of the GPL-3 license.
 *
 *  (c) Konrad Abicht <hi@inspirito.de>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

ARC2::inc('Class');

class ARC2_RDFSerializer extends ARC2_Class
{
    public function __construct($a, &$caller)
    {
        parent::__construct($a, $caller);
    }

    public function __init()
    {
        parent::__init();
        foreach ($this->ns as $k => $v) {
            $this->nsp[$v] = $k;
        }
    }

    public function xgetPName($v)
    {/* moved to merged getPName in ARC2_CLass */
        if (preg_match('/^([a-z0-9\_\-]+)\:([a-z\_][a-z0-9\_\-]*)$/i', $v, $m) && isset($this->ns[$m[1]])) {
            $this->used_ns = !in_array($this->ns[$m[1]], $this->used_ns) ? array_merge($this->used_ns, [$this->ns[$m[1]]]) : $this->used_ns;

            return $v;
        }
        if (preg_match('/^(.*[\/\#])([a-z\_][a-z0-9\-\_]*)$/i', $v, $m)) {
            return $this->getPrefix($m[1]).':'.$m[2];
        }

        return 0;
    }

    public function getSerializedTriples($triples, $raw = 0)
    {
        $index = ARC2::getSimpleIndex($triples, 0);

        return $this->getSerializedIndex($index, $raw);
    }

    public function getSerializedIndex($index, $raw = 0)
    {
        return '';
    }
}
