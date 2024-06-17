<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // User::create([
        //     'name' => 'Satrio Adi Pakoso',
        //     'email' => 'satrioapra@gmail.com',
        //     'password' => bcrypt('123'),
        // ]);

        // User::create([
        //     'name' => 'Bang Gena',
        //     'email' => 'gena@phi.com',
        //     'password' => bcrypt('123'),
        // ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programing',
            'slug' => 'web-programing'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-Design'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Category::create([
            'name' => 'Story',
            'slug' => 'story'
        ]);

        Post::factory(27)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => Str::slug('Judul Pertama'),
        //     'excerpt' => 'The second son of a dynastic king, Viego was never intended to lead. Instead, he lived a life of comfort that made him complacent and selfish.',
        //     'body' => '<p>Few know of the kingdom to the east, far across the seas, whose name lies all but forgotten among the ruins that dot its shores. Fewer still know of its foolish young ruler, whose lovestruck heart was doomed to destroy it.</p><p>Now a grave threat to all, that man’s name was—and is—Viego.</p><p>The second son of a dynastic king, Viego was never intended to lead. Instead, he lived a life of comfort that made him complacent and selfish. Yet, when his older brother died unexpectedly, Viego, who possessed neither the inclination nor the aptitude for rulership, suddenly found himself crowned.</p><p>He showed little interest in his position until he met a poor seamstress, Isolde. So taken was he by her beauty that the young king offered her his hand in marriage, and thus, one of the most powerful rulers of the age was wed to a peasant girl.</p><p>Their romance was enchanting, and Viego, who’d rarely shown interest in anyone other than himself, devoted his life to her. The two were inseparable—he scarcely went anywhere without Isolde, always lavishing gifts upon his queen, and his attention could seldom be broken when she was present.</p><p>Viego’s allies fumed. Unable to interest him in governance, and with the nation beginning to unravel under his questionable rulership, some plotted in secret to end their new king’s reign before it had begun. His nation’s enemies, meanwhile, saw an opportunity to strike. And the vipers began to circle.</p><p>Thus did an assassin’s poisoned dagger one day come for Viego. But the king was well defended, and the dagger did not strike true—instead grazing Isolde.</p><p>The toxin worked quickly, and Isolde fell into a ruinous torpor, while Viego could only watch in horror as his wife’s condition grew ever more serious. Overwhelmed with fury and despair, he spent every last coin within his coffers trying to save her.</p>',
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Dua',
        //     'slug' => Str::slug('Judul Ke Dua'),
        //     'excerpt' => 'T Recusandae reiciendis, at corrupti illo tempora facere.',
        //     'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequatur dolores voluptas hic quos ad autem, adipisci voluptatem consequuntur, non modi harum. Recusandae reiciendis, at corrupti illo tempora facere. Recusandae commodi non fuga voluptates consequuntur nesciunt nemo, illum quibusdam nobis eum debitis odit voluptatum explicabo blanditiis eos, obcaecati molestiae unde a eveniet atque nam? Quaerat dolore perferendis officia? Odio repellendus a natus fuga laudantium facilis placeat iure aspernatur nihil unde ipsum enim alias repudiandae quaerat quod aliquid iusto aut esse, officia amet eveniet. Omnis autem exercitationem eligendi suscipit labore alias earum repellat itaque sint fuga facere optio voluptates, odio quis deserunt tempore adipisci et laboriosam quae tempora porro architecto vitae? Tempore optio aliquid omnis voluptate molestiae aliquam, quo perspiciatis necessitatibus blanditiis?',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Tiga',
        //     'slug' => Str::slug('Judul Ke Tiga'),
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, ipsum facere! Ea cum, odit porro asperiores facilis ullam autem, repellat rem voluptas eaque harum, illum explicabo! Doloremque earum numquam at ab molestias fugit vero nulla repudiandae maiores atque iste culpa, fuga porro aperiam illo animi labore deserunt aliquam, esse hic dolore nesciunt illum maxime ut! Molestiae doloremque esse quaerat deserunt.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Empat',
        //     'slug' => Str::slug('Judul Ke Empat'),
        //     'excerpt' => 'maxime aliquid, cumque dolor animi autem possimus ratione ex! Placeat vel culpa in deleniti reprehenderit voluptatem eveniet ullam earum excepturi odio.',
        //     'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat quos fugit quia sunt dolor veniam error nostrum consectetur ipsa, labore culpa velit est maiores laborum reiciendis recusandae qui sint pariatur laudantium nulla doloremque similique quo nam temporibus? Facilis corrupti rerum quo sed recusandae vero veniam, illo dolore cumque temporibus incidunt. Magni consequuntur pariatur numquam facilis quisquam at perspiciatis unde dolores? Incidunt ratione doloribus dolorem nisi nostrum error! Nisi quisquam vel quam sunt magni dicta saepe tenetur doloremque nihil modi mollitia alias enim voluptatibus autem, cupiditate aut exercitationem sequi blanditiis! Accusantium distinctio recusandae libero, perferendis esse voluptas iusto nam sunt nobis, maxime aliquid, cumque dolor animi autem possimus ratione ex! Placeat vel culpa in deleniti reprehenderit voluptatem eveniet ullam earum excepturi odio. Asperiores repellat eaque, expedita repellendus iusto culpa, ipsam quos minima sunt non beatae magnam ex. Sequi repellendus distinctio provident.',
        //     'category_id' => 1,
        //     'user_id' => 2
        // ]);
    }
}
