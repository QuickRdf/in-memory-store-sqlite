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

namespace Tests\unit\store;

use Tests\ARC2_TestCase;

class ARC2_StoreTest extends ARC2_TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->fixture = \ARC2::getStore($this->dbConfig);
        $this->fixture->createDBCon();

        // remove all tables
        $this->fixture->getDBObject()->deleteAllTables();

        // fresh setup of ARC2
        $this->fixture->setup();
    }

    protected function tearDown(): void
    {
        $this->fixture->closeDBCon();
    }

    public function testCacheEnabled()
    {
        $cacheEnabled = isset($this->dbConfig['cache_enabled'])
            && $this->dbConfig['cache_enabled']
            && 'pdo' == $this->dbConfig['db_adapter'];
        $this->assertEquals($cacheEnabled, $this->fixture->cacheEnabled());
    }
}
