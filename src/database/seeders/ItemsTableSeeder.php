<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'id' => '1',
            'user_id' => '2',
            'category_id' => '1',
            'condition_id' => '1',
            'name' => 'ダメージジーンズ',
            'detail' => '未開封で新品同様です。',
            'price' => 10000,
            'photo' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEi0J45cIsAhQmUqo6HVpbyiLnHnhu3lI8EsGK-w0tzcMCwQSw0EY5DbpvEA_9K2q-hAvwbLZP1QTd93CL2iepTT2U6XA27m7Tkj7ffq3AnLTWnmD1mtAV-1h3m0SJinl86qWoZi1n62YN8/s800/fashion_jeans_damage.png',
        ]);

        Item::create([
            'id' => '2',
            'user_id' => '2',
            'category_id' => '2',
            'condition_id' => '3',
            'name' => 'キックボード',
            'detail' => '電動ではありません。',
            'price' => 3000,
            'photo' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjpNzpCcUhFeo9Nactfg0-o4HgEu285FpvtiURB3gjFrHJDiG_yTMuCNQD4SlONmMB_nE2HXTBa1RPmQnLdRhoy07yxp_WrxKfEPwG6vwcfO_pg3gjHZvkc16PKbZWp4lRwqh-tPLg75qEu/s1600/kickboard_girl.png',
        ]);

        Item::create([
            'id' => '3',
            'user_id' => '2',
            'category_id' => '3',
            'condition_id' => '5',
            'name' => '任天堂DS',
            'detail' => '画面に大きなひび割れがありますが、動作は問題ないです。',
            'price' => 500,
            'photo' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgowUBUApCIL1Zu42ERewRylezbeO4sTz-40Upi7BDQCKrDMwzGJq0ew9kphPzjo3XhYB4BfVy_k7iBUcJN0ulIA5q-FOLFHgPHOsA6XXtu_NWvnUOuSkhP66g9XDhUAdR17pGSF04GSBET/s800/game_keitai_broken.png',
        ]);

        Item::create([
            'id' => '4',
            'user_id' => '2',
            'category_id' => '4',
            'condition_id' => '4',
            'name' => 'ワンピース100巻',
            'detail' => '表紙に少し汚れがありますが、中身は綺麗です。',
            'price' => 100,
            'photo' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEimZKWYXPGBIUrmy6nko8Q8uDWcMOtAJPSP0Z-4q6Qr8HmGXSwJnrULk4G-AL4xQMdezvLMR6mPZQNkdKIn4Nlz-PgoxdGLaOklGaVwN-Yg-jZiR6txihsOi3yljJFAatD7yrMLVdBHqnY/s800/entertainment_comic.png',
        ]);

        Item::create([
            'id' => '5',
            'user_id' => '2',
            'category_id' => '5',
            'condition_id' => '2',
            'name' => '冷蔵庫',
            'detail' => '1年使用、外観・機能とも問題ない良品です。',
            'price' => 100000,
            'photo' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhZLl6CkKrORcUydNZ0PnH2GZ6jLfQjb8sYmUjfeNL3f4HUql94mblIGK36i9tg8Vr5O7J67Cw8w4kSR1sE-xfaHtLrk1_Unp0EOMVpnpm3LYj3GxG2nRUaDZq82NEkzIaHM5z_9jyk0PVb/s800/kaden_reizouko.png',
        ]);

        Item::create([
            'id' => '6',
            'user_id' => '2',
            'category_id' => '6',
            'condition_id' => '1',
            'name' => '大谷翔平 日米通算100本塁打記念バット',
            'detail' => '値下げ対応はお断りしています。',
            'price' => 1000000,
            'photo' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh1crmFPcc0FZC3eHpu3PamvUSYwXaiqLTeaMuxyupJUZeyV0TRsWW_mYVLLS7jbEjKIOMM52YWyZqSCOugDXIpua2WA3Zsid5cNho5JuIRam2jiisOc-nlXlKpGPDJqVXfFpLtoYmYBpdl/s800/sport_baseball_bat.png',
        ]);

        Item::create([
            'id' => '7',
            'user_id' => '2',
            'category_id' => '7',
            'condition_id' => '1',
            'name' => 'COACH 香水',
            'detail' => '新品未開封品です。50mLのタイプです。',
            'price' => 5000,
            'photo' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiVAege6WSi4vgRRCeQsb1EnbPqbC-GmBtKwVbWWeHmXwJfphOwuWn_CjgMOXTA_yf4cznU9xGPkxKx_w_gYMToQ1yuATbB9iwD1uWEk_dBXRy_itbjNYDIrUEk1QwUXJbg829f7A_5lHM/s800/kousui.png',
        ]);

        Item::create([
            'id' => '8',
            'user_id' => '2',
            'category_id' => '8',
            'condition_id' => '4',
            'name' => 'パイプ椅子',
            'detail' => 'クッションが一部破れていますが、耐久性には問題ございません。',
            'price' => 200,
            'photo' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhBumhWMkneFKwFBrMV9Qy4l_PubGY3a7CeJQV0YLBWsSKVsxewsTkzdX7bVm75Nf385H0N231A0f7KkvvfxIxl9zbrdGtZ_m2U8grUHrHfvxH0lH0tw5kxdDlZQ5vc_BkvUZyQxRXGPFA/s800/pipe_isu.png',
        ]);

        Item::create([
            'id' => '9',
            'user_id' => '2',
            'category_id' => '9',
            'condition_id' => '1',
            'name' => 'プロテイン',
            'detail' => 'バニラ味です。ダマになりにくく飲みやすい商品です。',
            'price' => 5000,
            'photo' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjJqkjLu-BLqX5-5fb0MbOF0HBEcshIzhJsdE4RpzmlyXFOMSrPgldZ0NWhcVtWaTAme1caOGwzzzsWzCv3maKsY6gDEbxgps0x7DhstDyIFvDQGY5AbvTNktVrie6tgEso0cC02qVoUPHu/s850/sports_protein.png',
        ]);

        Item::create([
            'id' => '10',
            'user_id' => '2',
            'category_id' => '10',
            'condition_id' => '3',
            'name' => 'GPS発信機能付き首輪',
            'detail' => '半年使用した中古品です。ワンちゃんのお散歩時などにお使いいただけます。',
            'price' => 7500,
            'photo' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgAH5u1-yUVOo8ZpatVE4u3jEZSir7nPfE3JRUdKRFlPgclRc2kYlToKPthxSNXOXUzR_NRAZurFFY_SgtFPQK3Jd2u-f2u5RfpzDigvgYWKH7P-zM_Fbi-R0NWzjw_GW-YBhpRB_YVxLEg/s800/pet_gps_dog.png',
        ]);
    }
}
