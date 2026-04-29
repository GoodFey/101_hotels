<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'admin@example.com',
                'text' => 'Это отличный комментарий! CodeIgniter 4 очень удобен для разработки.',
                'date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'user@example.com',
                'text' => 'Спасибо за информацию! Очень полезно для новичков.',
                'date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'dev@example.com',
                'text' => 'Отличный пример приложения с CodeIgniter и Laravel сравнением!',
                'date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'dev@example.com',
                'text' => 'Лучше чем Ларавель!',
                'date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'dev@example.com',
                'text' => 'Не ожидал такого поворота!',
                'date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'dev@example.com',
                'text' => 'Прекрасный фреймворк!',
                'date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('comments')->insertBatch($data);
    }
}

