<?php

namespace App\Models;


class PostLama
{
    static $blog_posts = [
        [
            "title" => "judul post pertama",
            "slug" => "judul-post-pertama",
            "author" => "Satrio Adi Prakoso",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rerum minima consectetur laborum omnis at modi ducimus porro, voluptatum, rem quasi nemo fugiat. Natus pariatur sapiente esse doloribus laborum? Veritatis, magni cupiditate, similique non vitae aut aspernatur minima, illo magnam quam aliquam aperiam eaque dicta fugit debitis! Totam vero veritatis ab magnam omnis ipsum rem quasi nulla, qui pariatur temporibus illo a unde ea? Ratione, suscipit. Ullam suscipit aspernatur iste expedita magni eos eveniet accusamus dolor? Recusandae deleniti aut velit, ipsam nesciunt commodi est quis distinctio sed explicabo porro. Quam, dicta.
"
        ],
        [
            "title" => "judul post kedua",
            "slug" => "judul-post-kedua",
            "author" => "Bang Awan",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime magnam alias excepturi blanditiis odio sequi voluptatum modi reiciendis consequuntur quidem quos repudiandae quisquam fugiat, culpa provident assumenda inventore in quasi porro! Deleniti voluptas rem magni perferendis molestiae. Temporibus aspernatur eveniet saepe accusamus consequuntur incidunt error animi voluptatem quae fugiat perferendis tempore provident amet, voluptate facere itaque, nulla officia dolores odio?"
        ]
    ];

    public static function all()
    {
        // self untuk property static
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        // static untk method static
        $post = static::all();
        return $post->firstWhere("slug", $slug);
    }
};
