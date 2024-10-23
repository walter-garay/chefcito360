<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Platillo;
use App\Models\Sucursales;

class PlatilloTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_un_platillo()
    {
        $sucursal = Sucursales::factory()->create();

        $response = $this->post('/platillos', [
            'nombre' => 'Ceviche',
            'descripcion' => 'Delicioso ceviche peruano',
            'precio' => 25.50,
            'categoria' => 'entrada',
            'sucursal_id' => $sucursal->id,
        ]);

        $response->assertStatus(302);  // Verifica que se redirige correctamente
        $response->assertRedirect('/platillos'); // Verifica que redirige a la ruta correcta

        // Verifica que el platillo fue creado en la base de datos
        $this->assertDatabaseHas('platillos', [
            'nombre' => 'Ceviche',
            'sucursal_id' => $sucursal->id,
        ]);
    }

    /** @test */
    public function puede_listar_los_platillos()
    {
        Platillo::factory()->count(3)->create();

        $response = $this->get('/platillos');
        $response->assertStatus(200);  // Verifica que la página se carga correctamente
        $response->assertSee(Platillo::first()->nombre);  // Verifica que el primer platillo se muestra
    }

    /** @test */
    public function puede_actualizar_un_platillo()
    {
        $platillo = Platillo::factory()->create([
            'nombre' => 'Antiguo Nombre',
        ]);

        $response = $this->put('/platillos/' . $platillo->id, [
            'nombre' => 'Nuevo Nombre',
            'descripcion' => $platillo->descripcion,
            'precio' => $platillo->precio,
            'categoria' => $platillo->categoria,
            'sucursal_id' => $platillo->sucursal_id,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/platillos'); // Verifica la redirección correcta
        $this->assertDatabaseHas('platillos', ['nombre' => 'Nuevo Nombre']);
    }

    /** @test */
    public function puede_eliminar_un_platillo()
    {
        $platillo = Platillo::factory()->create();

        $response = $this->delete('/platillos/' . $platillo->id);

        $response->assertStatus(302);  // Verifica la redirección
        $response->assertRedirect('/platillos');  // Verifica que redirige a la ruta correcta

        // Verifica que el platillo fue eliminado
        $this->assertDatabaseMissing('platillos', ['id' => $platillo->id]);
    }
}
