<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Campaign;

use App\Models\Trust;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CampaignControllerTest extends TestCase
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
    public function it_displays_index_view_with_campaigns()
    {
        $campaigns = Campaign::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('campaigns.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.campaigns.index')
            ->assertViewHas('campaigns');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_campaign()
    {
        $response = $this->get(route('campaigns.create'));

        $response->assertOk()->assertViewIs('app.campaigns.create');
    }

    /**
     * @test
     */
    public function it_stores_the_campaign()
    {
        $data = Campaign::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('campaigns.store'), $data);

        $this->assertDatabaseHas('campaigns', $data);

        $campaign = Campaign::latest('id')->first();

        $response->assertRedirect(route('campaigns.edit', $campaign));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_campaign()
    {
        $campaign = Campaign::factory()->create();

        $response = $this->get(route('campaigns.show', $campaign));

        $response
            ->assertOk()
            ->assertViewIs('app.campaigns.show')
            ->assertViewHas('campaign');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_campaign()
    {
        $campaign = Campaign::factory()->create();

        $response = $this->get(route('campaigns.edit', $campaign));

        $response
            ->assertOk()
            ->assertViewIs('app.campaigns.edit')
            ->assertViewHas('campaign');
    }

    /**
     * @test
     */
    public function it_updates_the_campaign()
    {
        $campaign = Campaign::factory()->create();

        $trust = Trust::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'condition' => $this->faker->text(255),
            'subcondition' => $this->faker->text(255),
            'content' => $this->faker->text,
            'published' => $this->faker->boolean,
            'trust_id' => $trust->id,
        ];

        $response = $this->put(route('campaigns.update', $campaign), $data);

        $data['id'] = $campaign->id;

        $this->assertDatabaseHas('campaigns', $data);

        $response->assertRedirect(route('campaigns.edit', $campaign));
    }

    /**
     * @test
     */
    public function it_deletes_the_campaign()
    {
        $campaign = Campaign::factory()->create();

        $response = $this->delete(route('campaigns.destroy', $campaign));

        $response->assertRedirect(route('campaigns.index'));

        $this->assertDeleted($campaign);
    }
}
