<?php
class UserRepository {
    private static array $cache = [];

    public static function getUser(int $id): array {
        if (isset(self::$cache[$id])) {
            return [
                'data' => self::$cache[$id],
                'source' => 'Кеш статичної властивості класу (миттєво)'
            ];
        }

        usleep(500000);

        $userData = [
            'id' => $id,
            'name' => "Користувач #" . $id,
            'role' => ($id === 1) ? 'Administrator' : 'User'
        ];

        self::$cache[$id] = $userData;

        return [
            'data' => $userData,
            'source' => 'Запит до БД (імітація затримки 0.5 сек)'
        ];
    }
}