<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Menu;
use App\Models\Pay;
use App\Models\PreOrder;
use App\Models\Product;
use App\Models\SaleReport;
use App\Models\TypeState;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\State;
use App\Models\Category;
use App\Models\Size;
use App\Models\Transport;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);

        TypeState::create([
            'type_state' => '1',
            'name' => 'Activo',
        ]);
        TypeState::create([
            'type_state' => '2',
            'name' => 'No activo',
        ]);
        TypeState::create([
            'type_state' => '3',
            'name' => 'Pendiente',
        ]);


        State::create([
            'nombre_estado' => 'Disponible',
            'color' => '#000000',
            'type_state_id' => '1',
        ]);
        State::create([
            'nombre_estado' => 'No Disponible',
            'color' => '#000000',
            'type_state_id' => '2',
        ]);
        State::create([
            'nombre_estado' => 'Pendiente',
            'color' => '#000000',
            'type_state_id' => '3',
        ]);


        /*$faker = Faker::create();
        for ($i = 0; $i < 30; $i++) {
            $user = new User;
            $user->name = $faker->name;
            $user->lastname = $faker->name;
            $user->email = $faker->email;
            $user->password = Hash::make('test123');
            $user->identity_card = $faker->name;
            $user->estado_id = $faker->numberBetween($min = 1, $max = 2);
            $user->sso_user_id = '';
            $user->created_at = $faker->date($format = 'Y-m-d', $max = 'now') ;;
            $user->save();
        }*/

        User::create([
            'name' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admindre@uniandes.edu.co',
            'password' => Hash::make('VDEjsai2022*'),
            'identity_card' => '123456',
            'estado_id' => '1',
            'sso_user_id' => '',
        ])->assignRole('Admin');

        User::create([
            'name' => 'Aprendiz',
            'lastname' => 'Aprendiz',
            'email' => 'aprendiz@uniandes.edu.co',
            'password' => Hash::make('VDEjsai2022*'),
            'identity_card' => '123456',
            'estado_id' => '1',
            'sso_user_id' => '',
        ])->assignRole('Admin');

        User::create([
            'name' => 'Empresa',
            'lastname' => 'Empresa',
            'email' => 'empresa@gmail.com',
            'password' => Hash::make('empresa1'),
            'identity_card' => '123456',
            'estado_id' => '1',
            'sso_user_id' => '',
        ])->assignRole('Empresa');

        User::create([
            'name' => 'Usuario',
            'lastname' => 'Usuario',
            'email' => 'usuario@gmail.com',
            'password' => Hash::make('usuario1'),
            'identity_card' => '123456',
            'estado_id' => '1',
            'sso_user_id' => '',
        ])->assignRole('Usuario');

        /*
        $company = new Company;
        $company->imagen_company = '20230512172750.png';
        $company->nombre_empresa = 'El Corral';
        $company->usuario_id = '1';
        $company->estado_id = '1';
        $company->save();


        $category = new Category;
        $category->name_category = '5K';
        $category->maximum_age = '10';
        $category->minimum_age = '17';
        $category->save();

        $size = new Size;
        $size->name_size = 'XXL';
        $size->save();

        $transport = new Transport;
        $transport->name_transport = 'Esto es una prueba';
        $transport->observation_transport = 'Esto es una prueba';
        $transport->save();*/
    }
}
