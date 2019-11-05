<?php

    use Illuminate\Foundation\Testing\DatabaseTransactions;
    use Tests\TestCase;
    use App\Models\User;
class RoleTest extends TestCase
{
    use DatabaseTransactions;
    public function testChange(): void
    {
        $user = factory(User::class)->create(['role' => User::ROLE_USER]);
        self::assertFalse($user->isAdmin());

        $user->changeRole(User::ROLE_ADMIN);
        self::assertTrue($user->isAdmin());
    }

    public function testAlready()
    {
        $user = factory(User::class)->create(['role' => User::ROLE_ADMIN]);

        $this->expectExceptionMessage('role is already assigned');

        $user->changeRole(User::ROLE_ADMIN);
    }

}