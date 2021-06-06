<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Keydate;

use App\Models\Patient;
use App\Models\TestType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KeydateControllerTest extends TestCase
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
    public function it_displays_index_view_with_keydates()
    {
        $keydates = Keydate::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('keydates.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.keydates.index')
            ->assertViewHas('keydates');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_keydate()
    {
        $response = $this->get(route('keydates.create'));

        $response->assertOk()->assertViewIs('app.keydates.create');
    }

    /**
     * @test
     */
    public function it_stores_the_keydate()
    {
        $data = Keydate::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('keydates.store'), $data);

        $this->assertDatabaseHas('keydates', $data);

        $keydate = Keydate::latest('id')->first();

        $response->assertRedirect(route('keydates.edit', $keydate));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_keydate()
    {
        $keydate = Keydate::factory()->create();

        $response = $this->get(route('keydates.show', $keydate));

        $response
            ->assertOk()
            ->assertViewIs('app.keydates.show')
            ->assertViewHas('keydate');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_keydate()
    {
        $keydate = Keydate::factory()->create();

        $response = $this->get(route('keydates.edit', $keydate));

        $response
            ->assertOk()
            ->assertViewIs('app.keydates.edit')
            ->assertViewHas('keydate');
    }

    /**
     * @test
     */
    public function it_updates_the_keydate()
    {
        $keydate = Keydate::factory()->create();

        $patient = Patient::factory()->create();
        $testType = TestType::factory()->create();

        $data = [
            'type' => $this->faker->word,
            'test_order' => $this->faker->text(255),
            'next_test_order' => $this->faker->text(255),
            'lab_ref' => $this->faker->text(255),
            'next_appointment' => $this->faker->text(255),
            'apt_date' => $this->faker->dateTime,
            'campaign_num' => $this->faker->randomNumber(0),
            'result' => $this->faker->text(255),
            'patient_id' => $patient->id,
            'test_type_id' => $testType->id,
        ];

        $response = $this->put(route('keydates.update', $keydate), $data);

        $data['id'] = $keydate->id;

        $this->assertDatabaseHas('keydates', $data);

        $response->assertRedirect(route('keydates.edit', $keydate));
    }

    /**
     * @test
     */
    public function it_deletes_the_keydate()
    {
        $keydate = Keydate::factory()->create();

        $response = $this->delete(route('keydates.destroy', $keydate));

        $response->assertRedirect(route('keydates.index'));

        $this->assertDeleted($keydate);
    }
}
