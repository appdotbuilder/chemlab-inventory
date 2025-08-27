<?php

namespace Tests\Feature;

use App\Models\Equipment;
use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChemLabBasicTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_page_displays_correctly(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('welcome')
        );
    }

    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'student',
            'status' => 'active'
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('dashboard')
                ->has('user')
                ->has('stats')
        );
    }

    public function test_laboratory_model_relationships(): void
    {
        $laboratory = Laboratory::factory()->create();
        $equipment = Equipment::factory()->count(5)->create([
            'laboratory_id' => $laboratory->id
        ]);

        $this->assertCount(5, $laboratory->equipment);
        $this->assertEquals($laboratory->id, $equipment->first()->laboratory->id);
    }

    public function test_user_roles_and_permissions(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $student = User::factory()->create(['role' => 'student']);
        $lecturer = User::factory()->create(['role' => 'lecturer']);
        $labAssistant = User::factory()->create(['role' => 'lab_assistant']);
        $headOfLab = User::factory()->create(['role' => 'head_of_lab']);

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($admin->isStudent());

        $this->assertTrue($student->isStudent());
        $this->assertFalse($student->isAdmin());

        $this->assertTrue($lecturer->isLecturer());
        $this->assertTrue($labAssistant->isLabAssistant());
        $this->assertTrue($headOfLab->isHeadOfLab());
    }

    public function test_laboratory_factory_creates_valid_data(): void
    {
        $laboratory = Laboratory::factory()->create();

        $this->assertNotEmpty($laboratory->name);
        $this->assertNotEmpty($laboratory->code);
        $this->assertIsInt($laboratory->capacity);
        $this->assertIsArray($laboratory->operating_hours);
        $this->assertContains($laboratory->status, ['active', 'inactive', 'maintenance']);
    }

    public function test_equipment_factory_creates_valid_data(): void
    {
        $laboratory = Laboratory::factory()->create();
        $equipment = Equipment::factory()->create(['laboratory_id' => $laboratory->id]);

        $this->assertNotEmpty($equipment->name);
        $this->assertNotEmpty($equipment->code);
        $this->assertContains($equipment->risk_level, ['low', 'medium', 'high']);
        $this->assertContains($equipment->status, ['available', 'borrowed', 'maintenance', 'damaged', 'retired']);
        $this->assertEquals($laboratory->id, $equipment->laboratory_id);
    }

    public function test_laboratories_index_displays_correctly(): void
    {
        $user = User::factory()->create(['role' => 'admin', 'status' => 'active']);
        Laboratory::factory()->count(3)->create();

        $response = $this->actingAs($user)->get('/laboratories');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('laboratories/index')
                ->has('laboratories')
                ->has('laboratories.data', 3)
        );
    }
}