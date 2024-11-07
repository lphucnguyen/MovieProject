<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $actors = [
            [
                'id'   => str()->uuid(),
                'name' => 'Keanu Reeves',
                'dob' => '1964-09-02',
                'overview' => 'Keanu Charles Reeves là một diễn viên, đạo diễn, nhà sản xuất và nhạc sĩ người Canada',
                'biography' => 'Keanu là con của bà Patricia Taylor, một nhà thiết kế trang phục và người biểu diễn ở Essex, Vương quốc Anh và ông Samuel Nowlin Reeves Jr. - một nhà địa chất học.[3] Mẹ của anh là người Anh còn cha của anh là một người Hawaii gốc Hoa, có tổ tiên là người Anh, Ireland và Bồ Đào Nha. Trong người anh mang cả ba dòng máu Mỹ - Á - Âu.',
                'avatar' => 'actor_avatars/3C2B0cHnpk7zMycPCTbTaNdmka1Luw2mGycPBsjU.jpg',
                'background_cover' => 'actor_background_covers/cover.jpg',
            ],
            [
                'id'   => str()->uuid(),
                'name' => 'Tom Cruise',
                'dob' => '1998-12-07',
                'overview' => 'Thomas Cruise Mapother IV là một nam diễn viên và nhà sản xuất phim người Mỹ. Anh bắt đầu sự nghiệp của mình ở tuổi 19 với bộ phim Endless Love. ',
                'biography' => 'Cruise được sinh ra tại Syracuse, New York, là con trai của Mary Lee (họ gốc Pfeiffer), một giáo viên giáo dục đặc biệt, và Thomas Cruise Mapother III,[3] một kỹ sư điện, cả hai đều đến từ Louisville, Kentucky.[4][5] Anh có ba chị em ruột là Lee Anne, Marian và Cass. Họ đều mang dòng máu Anh, Đức và Ireland.[6][7] Một trong những kị bên họ nội của Cruise là Patrick Russell Cruise, người được sinh ra tại miền bắc Hạt Dublin vào năm 1799; ông cưới Teresa Johnson ở Hạt Meath vào năm 1825.',
                'avatar' => 'actor_avatars/Cy6oeHOe9RgFfWizCCuvCMpGcKUZtSdMdEtMLGma.jpg',
                'background_cover' => 'actor_background_covers/cover.jpg',
            ],
            [
                'id'   => str()->uuid(),
                'name' => 'Johny Depp',
                'dob' => '1999-06-15',
                'overview' => 'John Christopher Depp II là một nam diễn viên, nhà sản xuất điện ảnh và nhạc sĩ người Mỹ. ',
                'biography' => 'John Christopher Depp II là con út trong số bốn người con của nữ hầu bàn Betty Sue Palmer (nhũ danh Wells) và kỹ sư dân dụng John Christopher Depp. Gia đình Depp thường xuyên di chuyển trong thời thơ ấu của anh, cuối cùng định cư ở Miramar, Florida vào năm 1970. Cha mẹ anh ly hôn năm 1978 khi anh 15 tuổi, và mẹ anh sau đó kết hôn với Robert Palmer, người mà Depp đã gọi là "nguồn cảm hứng".',
                'avatar' => 'actor_avatars/mS7rJuOwqP3527cCai8uTZmOnYGN1aK2Mun4dyP3.jpg',
                'background_cover' => 'actor_background_covers/cover.jpg',
            ]
        ];

        foreach ($actors as $actor) {
            \App\Actor::create($actor);
        }
    }
}
