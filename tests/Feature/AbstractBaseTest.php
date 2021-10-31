<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Constants\VerificationStatus;
use Modules\Auth\Models\Verification;
use Modules\User\Models\User;
use Tests\TestCase;

abstract class AbstractBaseTest extends TestCase
{
    protected const DEFAULT_CODE = 1111;
    protected const DEFAULT_TOKEN = '111111111111111111111111111111';
    protected const DEFAULT_EMAIL = 'admin@test.ru';
    protected const DEFAULT_PASSWORD = '1111';

    protected function createVerification(): Model
    {
        return (new Verification())->newQuery()->create(
            [
                'code' => self::DEFAULT_CODE,
                'value' => self::DEFAULT_EMAIL,
                'type' => 'email',
                'token' => self::DEFAULT_TOKEN,
                'status' => VerificationStatus::STATUS_SENT
            ]
        );
    }
    
    protected function createUser(): Model
    {
        return (new User())->newQuery()->create(
            [
                'name' => 'FIO',
                'email' => self::DEFAULT_EMAIL,
                'password' => self::DEFAULT_PASSWORD
            ]
        );
    }
}