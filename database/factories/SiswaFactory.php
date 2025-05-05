<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID'); // gunakan lokal Indonesia

        return [
            'nis' => $faker->unique()->numberBetween(10000, 99999),
            'nama' => $faker->name(),
            'kelas' => $faker->randomElement(['10', '11', '12']),
            'jurusan' => $faker->randomElement(['br', 'dkv1', 'dkv2', 'rpl', 'mp', 'ak']),
            'jenis_kelamin' => $faker->randomElement(['laki-laki', 'perempuan']),
            'alamat' => $faker->address(),
        ];
    }
}
