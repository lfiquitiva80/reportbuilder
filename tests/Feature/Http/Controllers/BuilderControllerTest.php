<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BuilderController
 */
class BuilderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $builders = Builder::factory()->count(3)->create();

        $response = $this->get(route('builder.index'));

        $response->assertOk();
        $response->assertViewIs('builder.index');
        $response->assertViewHas('builders');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('builder.create'));

        $response->assertOk();
        $response->assertViewIs('builder.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BuilderController::class,
            'store',
            \App\Http\Requests\BuilderStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('builder.store'));

        $response->assertRedirect(route('builder.index'));
        $response->assertSessionHas('builder.id', $builder->id);

        $this->assertDatabaseHas(builders, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $builder = Builder::factory()->create();

        $response = $this->get(route('builder.show', $builder));

        $response->assertOk();
        $response->assertViewIs('builder.show');
        $response->assertViewHas('builder');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $builder = Builder::factory()->create();

        $response = $this->get(route('builder.edit', $builder));

        $response->assertOk();
        $response->assertViewIs('builder.edit');
        $response->assertViewHas('builder');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BuilderController::class,
            'update',
            \App\Http\Requests\BuilderUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $builder = Builder::factory()->create();

        $response = $this->put(route('builder.update', $builder));

        $builder->refresh();

        $response->assertRedirect(route('builder.index'));
        $response->assertSessionHas('builder.id', $builder->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $builder = Builder::factory()->create();

        $response = $this->delete(route('builder.destroy', $builder));

        $response->assertRedirect(route('builder.index'));

        $this->assertDeleted($builder);
    }
}
