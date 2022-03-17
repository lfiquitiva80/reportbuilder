<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Query;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\QueryController
 */
class QueryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $queries = Query::factory()->count(3)->create();

        $response = $this->get(route('query.index'));

        $response->assertOk();
        $response->assertViewIs('query.index');
        $response->assertViewHas('queries');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('query.create'));

        $response->assertOk();
        $response->assertViewIs('query.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QueryController::class,
            'store',
            \App\Http\Requests\QueryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('query.store'));

        $response->assertRedirect(route('query.index'));
        $response->assertSessionHas('query.id', $query->id);

        $this->assertDatabaseHas(queries, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $query = Query::factory()->create();

        $response = $this->get(route('query.show', $query));

        $response->assertOk();
        $response->assertViewIs('query.show');
        $response->assertViewHas('query');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $query = Query::factory()->create();

        $response = $this->get(route('query.edit', $query));

        $response->assertOk();
        $response->assertViewIs('query.edit');
        $response->assertViewHas('query');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QueryController::class,
            'update',
            \App\Http\Requests\QueryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $query = Query::factory()->create();

        $response = $this->put(route('query.update', $query));

        $query->refresh();

        $response->assertRedirect(route('query.index'));
        $response->assertSessionHas('query.id', $query->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $query = Query::factory()->create();

        $response = $this->delete(route('query.destroy', $query));

        $response->assertRedirect(route('query.index'));

        $this->assertDeleted($query);
    }
}
