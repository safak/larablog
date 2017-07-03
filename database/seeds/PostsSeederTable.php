<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Category;
use App\Tag;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the posts table
        DB::table('posts')->truncate();
        DB::table('post_category')->truncate();
        DB::table('post_tag')->truncate();

        $faker = Factory::create();
        $date = Carbon::create(2017, 04, 10, 10);
        $post = [];

        for ($i=0; $i<10; $i++){

            $title = $faker->sentence(rand(4, 8));
            $date->addDays(1);
            $publishedDate = clone($date);
            $createdDate = clone($date);

            $post = [

                'author_id' => rand(1,3),
                'title' => $title,
                'excerpt' => $faker->text(rand(250, 300)),
                'body' => $faker->paragraphs(rand(10, 15), true),
                'slug' => str_slug($title,'-'),
                'img' => rand(1,2) == 1 ? NULL : "Post_Image_" . rand(1, 5) . ".jpg",
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
                'published_at' => $i <5 ? $publishedDate : (rand(0, 1) == 0 ? NULL : $publishedDate->addDays(4))


            ];

            DB::table('posts')->insert($post);

        }
        $ps=\App\Post::all();
        foreach ($ps as $p){

            $category=Category::find(rand(0, 7));
            $tag=Tag::find(rand(0,8));
            $p->categories()->attach($category);
            $p->tags()->attach($tag);

        }
    }
}
