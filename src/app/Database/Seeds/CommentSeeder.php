<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $baseDate = strtotime(date('Y-m-d'));
        $data = [
            [
                'name' => 'admin@example.com',
                'text' => 'Это отличный комментарий! CodeIgniter 4 очень удобен для разработки.',
                'date' => date('Y-m-d', $baseDate - 5 * 86400),
                'created_at' => date('Y-m-d H:i:s', $baseDate - 5 * 86400),
            ],
            [
                'name' => 'user@example.com',
                'text' => 'Спасибо за информацию! Очень полезно для новичков.',
                'date' => date('Y-m-d', $baseDate - 4 * 86400),
                'created_at' => date('Y-m-d H:i:s', $baseDate - 4 * 86400),
            ],
            [
                'name' => 'dev@example.com',
                'text' => 'Отличный пример приложения с CodeIgniter и Laravel сравнением!',
                'date' => date('Y-m-d', $baseDate - 3 * 86400),
                'created_at' => date('Y-m-d H:i:s', $baseDate - 3 * 86400),
            ],
            [
                'name' => 'dev@example.com',
                'text' => 'Лучше чем Ларавель!',
                'date' => date('Y-m-d', $baseDate - 2 * 86400),
                'created_at' => date('Y-m-d H:i:s', $baseDate - 2 * 86400),
            ],
            [
                'name' => 'dev@example.com',
                'text' => 'Не ожидал такого поворота!',
                'date' => date('Y-m-d', $baseDate - 1 * 86400),
                'created_at' => date('Y-m-d H:i:s', $baseDate - 1 * 86400),
            ],
            [
                'name' => 'dev@example.com',
                'text' => 'Прекрасный фреймворк!',
                'date' => date('Y-m-d', $baseDate),
                'created_at' => date('Y-m-d H:i:s', $baseDate),
            ],
        ];

        $this->db->table('comments')->insertBatch($data);
    }
}

