<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Platillo;
use App\Models\Sucursales;
use App\Models\User;

class PlatilloTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_un_platillo()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $this->actingAs($user);

        // Crear una sucursal
        $sucursal = Sucursales::factory()->create();
        $image = UploadedFile::fake()->image('platillo.jpg');

        // Crear el platillo
        $response = $this->post('/platillos', [
            'nombre' => 'Ceviche',
            'descripcion' => 'Delicioso ceviche peruano',
            'precio' => 25.50,
            'categoria' => 'entrada',
            'sucursal_id' => $sucursal->id,
            'imagen' => $image,
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
        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $this->actingAs( $user);

        // Crear platillos de prueba
        Platillo::factory()->count(3)->create();

        // Realizar la petición GET
        $response = $this->get('/platillos');

        $response->assertStatus(200);  // Verifica que la página se carga correctamente
        $response->assertSee(Platillo::first()->nombre);  // Verifica que el primer platillo se muestra
    }

    /** @test */
    public function puede_actualizar_un_platillo()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $this->actingAs($user);

        // Crear un platillo
        $platillo = Platillo::factory()->create([
            'nombre' => 'Antiguo Nombre',
        ]);

        $image = UploadedFile::fake()->image('nuevo_platillo.jpg');

        // Actualizar el platillo
        $response = $this->put('/platillos/' . $platillo->id, [
            'nombre' => 'Nuevo Nombre',
            'descripcion' => $platillo->descripcion,
            'precio' => $platillo->precio,
            'categoria' => $platillo->categoria,
            'sucursal_id' => $platillo->sucursal_id,
            'imagen' => $image,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/platillos'); // Verifica la redirección correcta

        // Verifica que el nombre fue actualizado en la base de datos
        $this->assertDatabaseHas('platillos', ['nombre' => 'Nuevo Nombre']);
    }

    /** @test */
    public function puede_eliminar_un_platillo()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $this->actingAs($user);

        $platillo = Platillo::factory()->create([
            'imagen' => 'platillos/imagen.jpg' // Simular una imagen existente
        ]);

        // Eliminar el platillo
        $response = $this->delete('/platillos/' . $platillo->id);

        $response->assertStatus(302);  // Verifica la redirección
        $response->assertRedirect('/platillos');  // Verifica que redirige a la ruta correcta

        // Verifica que el platillo fue eliminado
        $this->assertDatabaseMissing('platillos', ['id' => $platillo->id]);
    }
}
