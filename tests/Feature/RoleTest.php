<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function AccessPageTest(){
        $this->get('admin/role')->assertSuccessful();
    }
}
