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
            $newPost->data_publicazione = $faker->date();
            $newPost->immagine_profilo = $faker->imageUrl(640, 480);
            $newPost->testo = $faker->text();
            $newPost->titolo = $faker->sentence();

            $slug = Str::slug($newPost->titolo, "-");
            $slug_tmp = Post::where("slug", $slug)->first();
            $c = 1;
            while ($slug_tmp) {
                $slug = $slug . "-" . $c;
                $c++;
                $slug_tmp = Post::where("slug", $slug)->first();
            }
            $newPost->slug = $slug;
            
            $newPost->user_id = $faker->numberBetween(1, 3);
            $newPost->save();
        }
    }
}
