<?php


    namespace Tests\Unit\Models\User;
    use App\Models\User;

    use Illuminate\Foundation\Testing\DatabaseTransactions;
    use Tests\TestCase;

    class CreateTest extends TestCase
    {
        use DatabaseTransactions;

        public function testNew(): void
        {
            $user = User::new(
                $name = 'name',
                $email = 'email'
            );

            self::assertNotEmpty($user);
            self::assertEquals($user,$user->name);
            self::assertEquals($email,$user->email);
            self::assertNotEmpty($user->password);
            self::assertFalse($user->isAdmin());

            self::assertTrue($user->isActive());
        }

    }