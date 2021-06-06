<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Trust;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrustControllerTest extends TestCase
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
    public function it_displays_index_view_with_trusts()
    {
        $trusts = Trust::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('trusts.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.trusts.index')
            ->assertViewHas('trusts');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_trust()
    {
        $response = $this->get(route('trusts.create'));

        $response->assertOk()->assertViewIs('app.trusts.create');
    }

    /**
     * @test
     */
    public function it_stores_the_trust()
    {
        $data = Trust::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('trusts.store'), $data);

        $this->assertDatabaseHas('trusts', $data);

        $trust = Trust::latest('id')->first();

        $response->assertRedirect(route('trusts.edit', $trust));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_trust()
    {
        $trust = Trust::factory()->create();

        $response = $this->get(route('trusts.show', $trust));

        $response
            ->assertOk()
            ->assertViewIs('app.trusts.show')
            ->assertViewHas('trust');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_trust()
    {
        $trust = Trust::factory()->create();

        $response = $this->get(route('trusts.edit', $trust));

        $response
            ->assertOk()
            ->assertViewIs('app.trusts.edit')
            ->assertViewHas('trust');
    }

    /**
     * @test
     */
    public function it_updates_the_trust()
    {
        $trust = Trust::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'logo' => $this->faker->text(255),
        ];

        $response = $this->put(route('trusts.update', $trust), $data);

        $data['id'] = $trust->id;

        $this->assertDatabaseHas('trusts', $data);

        $response->assertRedirect(route('trusts.edit', $trust));
    }

    /**
     * @test
     */
    public function it_deletes_the_trust()
    {
        $trust = Trust::factory()->create();

        $response = $this->delete(route('trusts.destroy', $trust));

        $response->assertRedirect(route('trusts.index'));

        $this->assertDeleted($trust);
    }
}
