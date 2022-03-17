<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Dependence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DependenceController
 */
class DependenceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $dependences = Dependence::factory()->count(3)->create();

        $response = $this->get(route('dependence.index'));

        $response->assertOk();
        $response->assertViewIs('dependence.index');
        $response->assertViewHas('dependences');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('dependence.create'));

        $response->assertOk();
        $response->assertViewIs('dependence.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DependenceController::class,
            'store',
            \App\Http\Requests\DependenceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('dependence.store'));

        $response->assertRedirect(route('dependence.index'));
        $response->assertSessionHas('dependence.id', $dependence->id);

        $this->assertDatabaseHas(dependences, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $dependence = Dependence::factory()->create();

        $response = $this->get(route('dependence.show', $dependence));

        $response->assertOk();
        $response->assertViewIs('dependence.show');
        $response->assertViewHas('dependence');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $dependence = Dependence::factory()->create();

        $response = $this->get(route('dependence.edit', $dependence));

        $response->assertOk();
        $response->assertViewIs('dependence.edit');
        $response->assertViewHas('dependence');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DependenceController::class,
            'update',
            \App\Http\Requests\DependenceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $dependence = Dependence::factory()->create();

        $response = $this->put(route('dependence.update', $dependence));

        $dependence->refresh();

        $response->assertRedirect(route('dependence.index'));
        $response->assertSessionHas('dependence.id', $dependence->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $dependence = Dependence::factory()->create();

        $response = $this->delete(route('dependence.destroy', $dependence));

        $response->assertRedirect(route('dependence.index'));

        $this->assertDeleted($dependence);
    }
}
