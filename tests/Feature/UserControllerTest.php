<?php

namespace Tests\Feature;  
  
use App\Models\User;  
use Illuminate\Foundation\Testing\RefreshDatabase;  
use Tests\TestCase;  
  
class UserControllerTest extends TestCase  
{  
    use RefreshDatabase;  
  
    public function test_can_create_mahasiswa()  
    {  
        $response = $this->postJson('/api/users', [  
            'name' => 'John Doe',  
            'email' => 'john@example.com',  
            'password' => 'password123',  
            'role' => 'mahasiswa',  
        ]);  
  
        $response->assertStatus(201)  
                 ->assertJson([  
                     'name' => 'John Doe',  
                     'email' => 'john@example.com',  
                     'role' => 'mahasiswa',  
                 ]);  
    }  
  
    public function test_can_create_dosen()  
    {  
        $response = $this->postJson('/api/users', [  
            'name' => 'Jane Smith',  
            'email' => 'jane@example.com',  
            'password' => 'password123',  
            'role' => 'dosen',  
        ]);  
  
        $response->assertStatus(201)  
                 ->assertJson([  
                     'name' => 'Jane Smith',  
                     'email' => 'jane@example.com',  
                     'role' => 'dosen',  
                 ]);  
    }  
  
    public function test_can_get_mahasiswa()  
    {  
        $mahasiswa = User::factory()->create(['role' => 'mahasiswa']);  
  
        $response = $this->getJson('/api/users/' . $mahasiswa->id);  
  
        $response->assertStatus(200)  
                 ->assertJson([  
                     'name' => $mahasiswa->name,  
                     'email' => $mahasiswa->email,  
                     'role' => 'mahasiswa',  
                 ]);  
    }  
  
    public function test_can_get_dosen()  
    {  
        $dosen = User::factory()->create(['role' => 'dosen']);  
  
        $response = $this->getJson('/api/users/' . $dosen->id);  
  
        $response->assertStatus(200)  
                 ->assertJson([  
                     'name' => $dosen->name,  
                     'email' => $dosen->email,  
                     'role' => 'dosen',  
                 ]);  
    }  
  
    public function test_can_update_mahasiswa()  
    {  
        $mahasiswa = User::factory()->create(['role' => 'mahasiswa']);  
  
        $response = $this->putJson('/api/users/' . $mahasiswa->id, [  
            'name' => 'John Updated',  
            'email' => 'john.updated@example.com',  
            'role' => 'mahasiswa',  
        ]);  
  
        $response->assertStatus(200)  
                 ->assertJson([  
                     'name' => 'John Updated',  
                     'email' => 'john.updated@example.com',  
                     'role' => 'mahasiswa',  
                 ]);  
    }  
  
    public function test_can_update_dosen()  
    {  
        $dosen = User::factory()->create(['role' => 'dosen']);  
  
        $response = $this->putJson('/api/users/' . $dosen->id, [  
            'name' => 'Jane Updated',  
            'email' => 'jane.updated@example.com',  
            'role' => 'dosen',  
        ]);  
  
        $response->assertStatus(200)  
                 ->assertJson([  
                     'name' => 'Jane Updated',  
                     'email' => 'jane.updated@example.com',  
                     'role' => 'dosen',  
                 ]);  
    }  
  
    public function test_can_delete_user()  
    {  
        $user = User::factory()->create(['role' => 'mahasiswa']);  
  
        $response = $this->deleteJson('/api/users/' . $user->id);  
  
        $response->assertStatus(204);  
        $this->assertDeleted($user);  
    }  
}  
