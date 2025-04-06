<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Chat;
use Livewire\Livewire;
use App\Livewire\Admin\AdminChatComponent;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminChatComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_see_chat_users()
    {
        // Создаем админа с ролью
        $admin = User::factory()->create(['role' => 'admin']);
        
        // Создаем обычного пользователя
        $user = User::factory()->create();
        
        // Создаем несколько сообщений
        Chat::factory()->create([
            'sender_id' => $user->id,
            'receiver_id' => $admin->id,
            'message' => 'Тестовое сообщение'
        ]);

        // Авторизуемся как админ
        $this->actingAs($admin);

        // Тестируем компонент
        Livewire::test(AdminChatComponent::class)
            ->assertSee($user->name)
            ->assertSet('senderId', $user->id);
    }

    public function test_admin_can_send_message()
    {
        $admin = User::factory()->create(['role' => 'admin', 'avatar' => 'admin/assets/img/avatar/avatar-1.png']);
        $user = User::factory()->create(['avatar' => 'admin/assets/img/avatar/avatar-2.png']);
        
        $this->actingAs($admin);

        Livewire::test(AdminChatComponent::class)
            ->set('senderId', $user->id)
            ->set('message', 'Привет, это тест!')
            ->call('sendMessage')
            ->assertHasNoErrors()
            ->assertSet('message', ''); // Проверяем, что поле очистилось

        // Проверяем, что сообщение сохранилось в БД
        $this->assertDatabaseHas('chats', [
            'sender_id' => $admin->id,
            'receiver_id' => $user->id,
            'message' => 'Привет, это тест!'
        ]);
    }
}

