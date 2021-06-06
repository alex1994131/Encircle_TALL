<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Outbound;

use App\Models\Keydate;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OutboundControllerTest extends TestCase
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
    public function it_displays_index_view_with_outbounds()
    {
        $outbounds = Outbound::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('outbounds.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.outbounds.index')
            ->assertViewHas('outbounds');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_outbound()
    {
        $response = $this->get(route('outbounds.create'));

        $response->assertOk()->assertViewIs('app.outbounds.create');
    }

    /**
     * @test
     */
    public function it_stores_the_outbound()
    {
        $data = Outbound::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('outbounds.store'), $data);

        $this->assertDatabaseHas('outbounds', $data);

        $outbound = Outbound::latest('id')->first();

        $response->assertRedirect(route('outbounds.edit', $outbound));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_outbound()
    {
        $outbound = Outbound::factory()->create();

        $response = $this->get(route('outbounds.show', $outbound));

        $response
            ->assertOk()
            ->assertViewIs('app.outbounds.show')
            ->assertViewHas('outbound');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_outbound()
    {
        $outbound = Outbound::factory()->create();

        $response = $this->get(route('outbounds.edit', $outbound));

        $response
            ->assertOk()
            ->assertViewIs('app.outbounds.edit')
            ->assertViewHas('outbound');
    }

    /**
     * @test
     */
    public function it_updates_the_outbound()
    {
        $outbound = Outbound::factory()->create();

        $keydate = Keydate::factory()->create();

        $data = [
            'message' => $this->faker->text,
            'message_data' => $this->faker->text(255),
            'recipient' => $this->faker->text(255),
            'trust' => $this->faker->text(255),
            'trust_logo' => $this->faker->text(255),
            'keydate_id' => $keydate->id,
        ];

        $response = $this->put(route('outbounds.update', $outbound), $data);

        $data['id'] = $outbound->id;

        $this->assertDatabaseHas('outbounds', $data);

        $response->assertRedirect(route('outbounds.edit', $outbound));
    }

    /**
     * @test
     */
    public function it_deletes_the_outbound()
    {
        $outbound = Outbound::factory()->create();

        $response = $this->delete(route('outbounds.destroy', $outbound));

        $response->assertRedirect(route('outbounds.index'));

        $this->assertDeleted($outbound);
    }
}
