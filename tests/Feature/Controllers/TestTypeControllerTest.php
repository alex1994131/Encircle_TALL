<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\TestType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestTypeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_test_types()
    {
        $testTypes = TestType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('test-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.test_types.index')
            ->assertViewHas('testTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_test_type()
    {
        $response = $this->get(route('test-types.create'));

        $response->assertOk()->assertViewIs('app.test_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_test_type()
    {
        $data = TestType::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('test-types.store'), $data);

        $this->assertDatabaseHas('test_types', $data);

        $testType = TestType::latest('id')->first();

        $response->assertRedirect(route('test-types.edit', $testType));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_test_type()
    {
        $testType = TestType::factory()->create();

        $response = $this->get(route('test-types.show', $testType));

        $response
            ->assertOk()
            ->assertViewIs('app.test_types.show')
            ->assertViewHas('testType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_test_type()
    {
        $testType = TestType::factory()->create();

        $response = $this->get(route('test-types.edit', $testType));

        $response
            ->assertOk()
            ->assertViewIs('app.test_types.edit')
            ->assertViewHas('testType');
    }

    /**
     * @test
     */
    public function it_updates_the_test_type()
    {
        $testType = TestType::factory()->create();

        $data = [
            'test_name' => $this->faker->name,
        ];

        $response = $this->put(route('test-types.update', $testType), $data);

        $data['id'] = $testType->id;

        $this->assertDatabaseHas('test_types', $data);

        $response->assertRedirect(route('test-types.edit', $testType));
    }

    /**
     * @test
     */
    public function it_deletes_the_test_type()
    {
        $testType = TestType::factory()->create();

        $response = $this->delete(route('test-types.destroy', $testType));

        $response->assertRedirect(route('test-types.index'));

        $this->assertDeleted($testType);
    }
}
