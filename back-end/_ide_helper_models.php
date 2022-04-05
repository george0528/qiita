<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\MonthPost
 *
 * @property int $id
 * @property string $post_id
 * @property string $post_url
 * @property string $title
 * @property string $user_image_url
 * @property string $user_name
 * @property int $likes_count
 * @property int $is_new
 * @property int $rank
 * @property string $created_at
 * @property mixed|null $tags
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost whereLikesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost wherePostUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost whereUserImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthPost whereUserName($value)
 */
	class MonthPost extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $post_id
 * @property string $post_url
 * @property string $title
 * @property string $user_image_url
 * @property string $user_name
 * @property int $likes_count
 * @property int $is_new
 * @property int $rank
 * @property string $created_at
 * @property mixed|null $tags
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereLikesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserName($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ThreePost
 *
 * @property int $id
 * @property string $post_id
 * @property string $post_url
 * @property string $title
 * @property string $user_image_url
 * @property string $user_name
 * @property int $likes_count
 * @property int $is_new
 * @property int $rank
 * @property string $created_at
 * @property mixed|null $tags
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost query()
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost whereLikesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost wherePostUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost whereUserImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThreePost whereUserName($value)
 */
	class ThreePost extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
	class User extends \Eloquent {}
}

