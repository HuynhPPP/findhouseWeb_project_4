<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChatMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = [13, 25, 36, 46, 52, 1, 8, 16, 55, 56, 62, 63, 64];

        $postMap = [
            102 => 1,
            103 => 1,
            105 => 1,
            117 => 1,
            109 => 55,
            110 => 55,
            111 => 55,
            112 => 16,
            113 => 16,
            114 => 16,
        ];

        $renterMessages = [
            'Phòng này còn trống không ạ?',
            'Giá thuê đã bao gồm điện nước chưa anh/chị?',
            'Cho em xin địa chỉ cụ thể để xem phòng được không?',
            'Phòng có cho nấu ăn không vậy ạ?',
            'Anh/chị có thể gửi thêm hình ảnh phòng không?',
            'Có chỗ để xe không ạ?',
            'Em có thể đặt cọc giữ phòng trước không?',
            'Em làm ca đêm, có giờ giấc đóng cửa không ạ?',
            'Phòng có gác lửng không vậy anh/chị?',
            'Giá thuê có thể thương lượng thêm không?',
        ];

        $posterReplies = [
            'Phòng vẫn còn em nhé.',
            'Giá chưa bao gồm điện nước em nha.',
            'Địa chỉ là 123 Lê Văn Việt, Thủ Đức.',
            'Phòng cho nấu ăn thoải mái em nha.',
            'Anh/chị sẽ gửi thêm hình ảnh sau nhé.',
            'Có chỗ để xe rộng rãi trong nhà.',
            'Em có thể đặt cọc 500k để giữ phòng.',
            'Không giới hạn giờ giấc đâu em.',
            'Phòng có gác lửng, phù hợp cho 2 người ở.',
            'Có thể thương lượng nhẹ nếu em ở lâu dài.',
        ];

        $data = [];

        foreach ($postMap as $postId => $posterId) {
            // Lọc người thuê hợp lệ
            $renters = array_values(array_filter($userIds, fn($id) => $id !== $posterId));

            // Chọn ngẫu nhiên 1–3 người thuê cho bài đăng
            shuffle($renters);
            $selectedRenters = array_slice($renters, 0, rand(1, 3));

            foreach ($selectedRenters as $renterId) {
                $startTime = Carbon::now()->subDays(rand(0, 5))->setTime(rand(8, 20), rand(0, 59));
                $messageCount = rand(4, 8);

                for ($i = 0; $i < $messageCount; $i++) {
                    $isRenterTurn = $i % 2 === 0;

                    $data[] = [
                        'sender_id' => $isRenterTurn ? $renterId : $posterId,
                        'receiver_id' => $isRenterTurn ? $posterId : $renterId,
                        'post_id' => $postId,
                        'message' => $isRenterTurn
                            ? $renterMessages[array_rand($renterMessages)]
                            : $posterReplies[array_rand($posterReplies)],
                        'created_at' => $startTime->copy()->addMinutes($i * rand(1, 4)),
                        'updated_at' => $startTime->copy()->addMinutes($i * rand(1, 4)),
                    ];
                }
            }
        }

        DB::table('chat_messages')->insert($data);
    }
}
