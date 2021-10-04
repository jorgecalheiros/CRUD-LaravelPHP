<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $model;

    public function setUp(): void
    {
        parent::setUp();

        $this->model = new User();
    }
    /**
     * test Fillable of model
     *
     * @return void
     */
    public function test_fillable_model()
    {
        $expected = [
            "name",
            "email",
            "password",
            "description"
        ];

        $this->assertEquals($expected,$this->model->getFillable());
    }
}
