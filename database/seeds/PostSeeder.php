<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

use App\Post;

use illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 4; $i++) {
            $newPost = new Post;
            $newPost->nome = $faker->name();
            $newPost->data_publicazione = $faker->date();
            $newPost->immagine_profilo = $faker->imageUrl(640, 480);
            $newPost->testo = $faker->text();
            $newPost->titolo = $faker->sentence();
            $newPost->slug = Str::slug($newPost->titolo, "-");
            $newPost->save();
        }
    }
}
